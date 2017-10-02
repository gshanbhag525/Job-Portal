<?php

//To Handle Session Variables on This Page
session_start();

//Including Database Connection From db.php file to avoid rewriting in all files
require_once("../db.php");

//If user Actually clicked login button 
if(isset($_POST)) {

	//Escape Special Characters in String
	$username = mysqli_real_escape_string($conn, $_POST['username']);
	$password = mysqli_real_escape_string($conn, $_POST['password']);

	//Encrypt Password
	// $password = base64_encode(strrev(md5($password)));

	//sql query to check user login
	$sql = "SELECT * FROM admin WHERE username='$username' AND password='$password'";
	$result = $conn->query($sql);

	//if user table has this this login details
	if($result->num_rows > 0) {
		//output data
		while($row = $result->fetch_assoc()) {
			
			//Set some session variables for easy reference
			$_SESSION['id_admin'] = $row['id_admin'];
			header("Location: dashboard.php");
			exit();
		}
 	} else {
 		$_SESSION['loginError'] = true;
 		header("Location: index.php");
		exit();
 	}

 	$conn->close();

} else {
	header("Location: index.php");
	exit();
}