<?php 

 $conn = mysqli_connect("localhost","username","password","dbname",3306);
 if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
 } 
 error_reporting(E_ALL ^ E_NOTICE);
 error_reporting(E_ALL ^ E_DEPRECATED);
?>
