<?php
require_once('functions.php');
$con=mysql_connect('localhost', 'worldofc_deni', 'tests1234system' );
if(!$con){
	die('Could not connect: '.mysql_error());
}

mysql_select_db('worldofc_deni');
mysql_set_charset('utf8');


function secure($var) {

    if(is_array($var))
        return array_map('secure', $var);
    elseif ( (int)($var) )
        return (int)$var;
    else
        {
        	
            $var = strip_tags($var);
            $var = addslashes($var);
            $var = htmlspecialchars($var, ENT_NOQUOTES);
            $var = mysql_real_escape_string($var);
            return $var;
        }
} 

$_POST = array_map("secure", $_POST);
$_GET = array_map("secure",$_GET);
$_COOKIE = array_map("secure",$_COOKIE);
error_reporting(E_ALL);
ini_set('display_errors','on');
?>