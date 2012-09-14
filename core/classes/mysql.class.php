<?php
class mysql extends core
{
    public function __construct($host, $user, $pass, $db)
    {
        // Starting procedure
        
        mysql_connect($host, $user, $pass) or die(mysql_error());
        mysql_select_db($db) or die(mysql_error());
        mysql_query("SET NAMES UTF8") or die(mysql_error());
    }
    
    public function getFromQuery($query)
    {
        // Get array from MySQL query.
        // Return 2d array
        
        $q = mysql_query($query);
        $n=0;
        while($res = mysql_fetch_assoc($q)) {
            $out[$n] = $res;
            $n++;
        }
        
        return $out;
    }
    
    public function setFromQuery($query)
    {
        // Execute MySQL query
        // Return true or false
        
        if(mysql_query($query)) return true;
        return false;
    }
}