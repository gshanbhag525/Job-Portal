<?php

//To Handle Session Variables on This Page
session_start();

//Including Database Connection From db.php file to avoid rewriting in all files
require_once("db.php");

if(isset($_GET)) {

	//Escape Special Characters In String First
	$hash =  mysqli_real_escape_string($conn, $_GET['token']);
	$email = mysqli_real_escape_string($conn, $_GET['email']);

	//sql query to check if email already exists or not
	$sql = "SELECT * FROM users WHERE email='$email' AND hash='$hash'";
	$result = $conn->query($sql);

	//if email not found then we can insert new data
	if($result->num_rows > 0) {

		$row = $result->fetch_assoc();

		if($row['active'] == '1') {
			echo 'You Have Already Activated Your Account';
		} else {
			$sql1 = "UPDATE users SET active='1' WHERE email='$email' AND hash='$hash'";
			if($conn->query($sql1)) {
				$_SESSION['userActivated'] = true;
				header("Location: login.php");
				exit();
			}
		}

	} else {
		echo  "Token Mismatch";
		//you can redirect them to homepage also.
	}
}