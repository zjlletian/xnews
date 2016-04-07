<?php
require_once(dirname(dirname(__FILE__)) . '/autoload.php');

abstract class Model{

    private $tname;

    //构造函数，初始化表名
    function __construct($tname){
        $this->tname=$tname;
    }

    //插入一条数据
    function insert($data){
        $ks=array();
        $vs=array();
        foreach ($data as $k=>$v){
            $ks[]="`{$k}`";
            $vs[]="'".DB::escape($v)."'";
        }
        $ks=implode(",",$ks);
        $vs=implode(",",$vs);
        return DB::query("INSERT INTO `{$this->tname}` ({$ks}) VALUES ($vs)");
    }

    //根据ID查找
    function find($id){
        $result=DB::query("SELECT * FROM `{$this->tname}` WHERE id={$id}");
        if(count($result)<1){
            return null;
        }
        else{
            return $result[0];
        }
    }

    //根据ID更新
    function update($id,$data){
        $kvs=array();
        foreach ($data as $k=>$v){
            $kvs[]="`{$k}` = '".DB::escape($v)."'";
        }
        $kvs=implode(",",$kvs);
        return DB::query("UPDATE {$this->tname} SET {$kvs} WHERE id={$id}");
    }

    //根据ID删除
    function delete($id){
        return DB::query("DELETE FROM `{$this->tname}` WHERE id={$id} ");
    }

    //where查找
    function getlist($where=null){
        $sql="SELECT * FROM `{$this->tname}` ";
        if($where!=null){
            $sql.=$where;
        }
        return DB::query($sql);
    }
}
