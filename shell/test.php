<?php
require_once(dirname(dirname(__FILE__)) . '/autoload.php');

echo UrlAnalyzer::getHtml($argv[1])."\n";
