<?php 

function mysqlexec($sql){
	$host="127.0.0.1:3306"; // Host name 
    $username="root"; // Mysql username 
    $password=""; // Mysql password 
    $db_name="unity_class_scheduling"; // Database name 

	// Connect to server and select databse.
	$conn=mysqli_connect("$host", "$username", "$password")or die("cannot connect");

	mysqli_select_db($conn,"$db_name")or die("cannot select DB");

	if($result = mysqli_query($conn, $sql)){
		return $result;
	}
	else{
		echo mysqli_error($conn);
	}


}


function isloggedin(){
	if(!isset($_SESSION['user_name'])){
	 	return false;
	}
	else{
		return true;
	}

}


?>