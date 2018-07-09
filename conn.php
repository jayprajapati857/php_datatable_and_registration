<?php 

 //$con=mysql_connect('localhost','root','FaNG4cY') or die (mysql_error()); 
 //$db=mysql_select_db('jatinsfoundation') or die(mysql_error());

 $conn = mysqli_connect("sql12.freemysqlhosting.net","sql12246700","9mfK1RdJXl","sql12246700",3306);
 if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
 } 
 error_reporting(E_ALL ^ E_NOTICE);
 error_reporting(E_ALL ^ E_DEPRECATED);
?>