<?php
require_once(dirname(dirname(__FILE__)).'/autoload.php');
require_once(APPROOT.'/lib/phpQuery/phpQuery.php');

class UrlAnalyzer{

	//从url获取html
	static function getHtml($url){
		//设置curl
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
	    curl_setopt($ch, CURLOPT_MAXREDIRS, 5);
		curl_setopt($ch, CURLOPT_URL, $url);
	 	curl_setopt($ch, CURLOPT_CONNECTTIMEOUT_MS, 5000);//设置连接超时时间
	 	curl_setopt($ch, CURLOPT_TIMEOUT_MS, 5000);//设置超时时间
	    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);//1将结果返回，0直接stdout
	    curl_setopt($ch, CURLOPT_ENCODING, "gzip");//支持gzip
	    //处理request header
		$header = array();
		$header[] = "Accept: text/html;q=0.8";
		$header[] = "User-Agent: Mozilla/5.0 (Windows NT 10.0; WOW64)";
		curl_setopt($ch, CURLOPT_HTTPHEADER,$header);

		try{
			$htmltext = curl_exec($ch);
			$responseheader = curl_getinfo($ch);
			//判断是否访问成功
			if(intval($responseheader['http_code'])/100==2) {
				//判断网页是否为空
				if (strlen($htmltext) == 0) {
					throw new Exception("empty html");
				}
				//根据contentType判断文档类型是否为text/html
				$contentType = strtr(strtoupper($responseheader['content_type']), array(' ' => '', '\t' => '', '@' => ''));
				if (strpos($contentType, 'TEXT/HTML') === false) {
					throw new Exception("doctype is not html.");
				}
				//如果能够从HtmlHead中的meta标签获取charset则直接交给pq处理，否则使用header或函数检测charset并转换为utf-8
				$autodetect = self::contentTypeFromMeta($htmltext)[1];
				if ($autodetect == null) {
					$charset = '';
					//使用HttpHeader中的ContentType获取chaeset
					foreach (explode(";", $contentType) as $ct) {
						$ctkv = explode("=", $ct);
						if (count($ctkv) == 2 && $ctkv[0] == 'CHARSET') {
							$charset = $ctkv[1];
							break;
						}
					}
					//使用函数检测charset
					$validcharsets = array("UTF-8", "GB2312", "GBK", "ISO-8859-1");
					if (!in_array($charset, $validcharsets)) {
						$charset = mb_detect_encoding($htmltext, $validcharsets);
					}
					//如果未检测出字符编码则返回错误，否则字符集转换为UTF-8
					if ($charset == '') {
						throw new Exception("unknown charset.");
					} elseif ($charset != "UTF-8") {
						$htmltext = mb_convert_encoding($htmltext, 'UTF-8', $charset);
					}
				}
				else{
					$htmltext = preg_replace('@<meta[^>]+http-equiv\\s*=\\s*(["|\'])Content-Type\\1([^>]+?)>@i','', $htmltext);
					$htmltext = mb_convert_encoding($htmltext, 'UTF-8', $autodetect);
				}
			}
			//过滤js与css
			$reg=array("'<script[^>]*?>.*?</script>'si", "'<style[^>]*?>.*?</style>'si" , '@style=\".*\"@','@style=\\\'.*\\\'@');
			$htmltext = preg_replace($reg,'', $htmltext);
		}
		catch(Exception $e) {
			$htmltext=null;
		}
		finally{
			curl_close($ch);
			unset($ch);
			return $htmltext;
		}
	}

	//从meta中获取contentType数组：[ doctype , charset ]（从phpquery中提取）
	static function contentTypeFromMeta($markup) {
		$matches = array();
		preg_match('@<meta[^>]+http-equiv\\s*=\\s*(["|\'])Content-Type\\1([^>]+?)>@i',$markup, $matches);
		if (!isset($matches[0])){
			return array(null, null);
		}
		preg_match('@content\\s*=\\s*(["|\'])(.+?)\\1@', $matches[0], $matches);
		if (!isset($matches[0])){
			return array(null, null);
		}
		$matches = explode(';', trim(strtolower(($matches[2]))));
		if (isset($matches[1])) {
			$matches[1] = explode('=', $matches[1]);
			$matches[1] = isset($matches[1][1]) && trim($matches[1][1])?$matches[1][1]:$matches[1][0];
		}
		else{
			$matches[1] = null;
		}
		return $matches;
	}

	//从html提取内容
	static function getInfo($url, $titleRule, $contentRule, $imgRules){

		//获取html,尝试四次
		$htmltext=self::getHtml($url);
		$count=0;
		while($htmltext == null && $count<3) {
			$htmltext=self::getHtml($url);
			$count++;
		}
		if($htmltext==null){
			return null;
		}

		$urlinfo=array();
		$htmldom= phpQuery::newDocument($htmltext);

		//获取标题
		$title=$htmldom[$titleRule];
		if($title!=null){
			$urlinfo['title']=trim($title->text());
		}
		else{
			$urlinfo['title']=null;
		}

		//提取正文
		$content=$htmldom[$contentRule]->htmlOuter();

		//去除多余的html标签，保留<p><strong><img>标签
		$content=strip_tags($content, "<p><strong><img>");

		//合并多个空格与空段落
		$content=strtr($content, array("\t"=>"", "\n"=>""," "=>""));
		$content=preg_replace("/<p><\/p>/","",$content);
		$content=preg_replace("/[\s]+/","",$content);
		$urlinfo['content']=$content;

		//提取图片
		$imgs=array();
		$baseurl=self::urlSplit($url);
		foreach ($htmldom[$imgRules] as $img){
			$href=$img->getAttribute('src');
			$link=self::transformHref($href, $baseurl);
			if($link!=false && !in_array($link,$imgs)){
				$imgs[]=$link;
			}
		}
		$urlinfo['images'] = implode("\r\n",$imgs);

		//清理phpquery
		phpQuery::$documents = array();
		return $urlinfo;
	}

	//从html中获取url
	static function getUrls($url, $urlRule){
		//获取html,尝试四次
		$htmltext=self::getHtml($url);
		$count=0;
		while($htmltext == null && $count<3) {
			$htmltext=self::getHtml($url);
			$count++;
		}
		if($htmltext==null){
			return null;
		}

		$links=array();
		$htmldom= phpQuery::newDocument($htmltext);
		$baseurl=self::urlSplit($url);
		foreach ($htmldom['a'] as $a){
			$href=$a->getAttribute('href');
			$link=self::transformHref($href, $baseurl);
			if($link!=false && !in_array($link,$links)){
				$links[]=$link;
			}
		}
		$result=array();
		foreach ($links as $link){
			if(preg_match_all($urlRule,$link,$matche)){
				$result[]=$link;
			}
		}
		return $result;
	}

	//将url拆分,返回：协议，主机地址，路径，文档名，参数
	static function urlSplit($baseurl){
		//去除url后面的#
		$sharppos=strpos($baseurl,"#");
		if($sharppos!==false){
			$baseurl=substr($baseurl,0,$sharppos);
		}

		//获取协议 $protocol
		if(Util::strStartWith($baseurl,'http://')){
			$info['protocol']='http://';
		}
		else if(Util::strStartWith($baseurl,'https://')){
			$info['protocol']='https://';
		}
		else{
			return false;
		}
		$baseurl=substr($baseurl,strlen($info['protocol']));

		//获取url中的参数
		$argpos=strpos($baseurl,"?");
		if($argpos!==false){
			$info['args']=substr($baseurl,$argpos);
			$baseurl=substr($baseurl,0,$argpos);
		}
		else{
			$info['args']='';
		}
		$info['args']=trim($info['args']);

		//获取文档名
		$filepos=strrpos($baseurl,"/");
		if($filepos!==false){
			$info['file']= substr($baseurl,$filepos+1)==false? "":substr($baseurl,$filepos+1);
			$baseurl=substr($baseurl,0,$filepos+1);
		}
		else{
			$info['file']='';
		}
		$info['file']=trim($info['file']);

		//获取主机名与路径
		$pathpos=strpos($baseurl,"/");
		if($pathpos!==false){
			$info['path']=substr($baseurl,$pathpos);
			$info['host']=substr($baseurl,0,$pathpos);
		}
		else{
			$info['path']='/';
			$info['host']=$baseurl;
		}
		$info['path']=trim($info['path']);
		$info['host']=trim($info['host']);

		return $info;
	}

	//修正url路径
	private static function transformHref($href, $baseurl){
		//去除url中的空格以及控制字符
		$href=trim($href);
		$href=strtr($href, array('&nbsp;'=>'','&nbsp'=>''));

		//去除href后面的#
		$sharppos=strpos($href,"#");
		if($sharppos!==false){
			$href=substr($href,0,$sharppos);
		}

		//检查href
		if(empty($href)){
			return false;
		}
		foreach ($GLOBALS['BANWORD'] as $ban){
			if(strstr($href,$ban)){
				return false;
			}
		}

		//以协议开头的直接使用，以'//'开头的继承父链接协议，以'/'开头的使用绝对路径，其他情况使用相对路径
		if(Util::strStartWith($href,'http://') || Util::strStartWith($href,'https://')) {
			$url=self::urlSplit($href);
			if($url==false){
				return false;
			}
			return $url['protocol'].$url['host'].$url['path'].$url['file'].$url['args'];
		}
		elseif(Util::strStartWith($href,'//')) {
			$href=ltrim($href,'//');
			return $baseurl['protocol'].$href;
		}
		elseif(Util::strStartWith($href,'/')) {
			return $baseurl['protocol'].$baseurl['host'].$href;
		}
		else{
			if(Util::strStartWith($href,'./')) {
				$href=ltrim($href,'./');
			}
			return $baseurl['protocol'].$baseurl['host'].$baseurl['path'].$href;
		}
	}
}
