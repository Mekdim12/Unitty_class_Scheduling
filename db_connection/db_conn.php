<?php 

$host="127.0.0.1:3306"; // Host name 
$username="root"; // Mysql username 
$password=""; // Mysql password 
$db_name="unity_class_scheduling"; // Database name 

// Connect to server and select databse.
$conn=mysqli_connect("$host", "$username", "$password")or die("cannot connect"); 

mysqli_select_db($conn,"$db_name")or die("cannot select DB");

?>