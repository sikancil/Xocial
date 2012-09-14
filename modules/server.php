<?php

ob_implicit_flush();
set_time_limit(0);

require_once "../core/classes/core.class.php";
require_once "../core/classes/mysql.class.php";
$mysql = new mysql("mysql0.db.koding.com", "creaturemyst_fea", "postal", "creaturemyst_fea");

function checkNewMsg($mysql, $last_id = 0) {
    $count = $mysql->getFromQuery("SELECT COUNT(id) FROM msg");
    $count = $count[0]['COUNT(id)'];
    if($last_id == 0) $q = $mysql->getFromQuery("SELECT * FROM msg WHERE ready=0");
    
    elseif($last_id >= $count) die();
    else {
        $q = $mysql->getFromQuery("SELECT * FROM msg ORDER BY id LIMIT $last_id, $count");
    }
    
    
    return $q;
}

switch($_SERVER['REQUEST_METHOD']) {
    case "GET":
        $n=0;
        $last_id = (int)$_GET['last_id'];
        //$token = rand(0, 999999);
        //die($last_id.":".$last_id."|debug|".$last_id."|".$token);

        $msg = checkNewMsg($mysql, $last_id);
        if(count($msg) <= 0) die();
        while($n < count($msg)) {
            if(count($msg) == 0) continue;
            $id = $msg[$n]['id'];
            $name = $msg[$n]['name'];
            $message = $msg[$n]['msg'];
            $token = rand(0, 999999);
            echo $n."~".$id.';'.$name.";".$message.";".$token;
            $mysql->setFromQuery("UPDATE msg SET ready=1 WHERE id='$id'");
            
            $n++;
        }
        break;

    case "POST":
        $name = mysql_real_escape_string($_POST['name']);
        $mssg = mysql_real_escape_string($_POST['msg']);
        $mssg = strip_tags($mssg);
        $name = strip_tags($name);
        
        
        if($mysql->setFromQuery("INSERT INTO msg VALUES(NULL, '$name', '$mssg', 0)")) die("Success!");
        //print_r($msg);
        break;
}