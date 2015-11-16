<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);
$host = 'localhost';
$user = 'root';
$pwd = ''; 

$database = 'miniproject';
$table ='baby';
$conn = @mysql_connect($host, $user, $pwd) or
die("cant select database ");

if (!mysql_select_db($database))
die("cant select database");
?>
