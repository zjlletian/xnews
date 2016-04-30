<?php
require_once(dirname(dirname(__FILE__)) . '/autoload.php');

var_dump(UrlAnalyzer::getInfo($argv[1],$argv[2],$argv[3],$argv[4]));
