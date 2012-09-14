<?php
define(ROOT_DIR, getcwd());           // Root dir

function requireAll($array)
{
    foreach($array as $val) {
        require_once ROOT_DIR.$val;
    }
}

###

requireAll(array("/core/config.php", "/core/classes/core.class.php", "/core/classes/mysql.class.php"));

$core = new core;
//$mysql = new mysql($cMysql['host'], $cMysql['user'], $cMysql['pass'], $cMysql['db']);