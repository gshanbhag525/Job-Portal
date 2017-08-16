<?php

//To Handle Session Variables on This Page
session_start();

//Including Database Connection From db.php file to avoid rewriting in all files
require_once("../db.php");

//If user Actually clicked Delete button
if(isset($_POST)) {

	//Sql Query to delete selected jobpost. 
	//Note: We are using GET id which normally not considered safe as anyone can put any id in url and delete but I am using sess
	$sql = "DELETE FROM job_post WHERE id_jobpost='$_GET[id]' AND id_company='$_SESSION[id_user]'";

	if($conn->query($sql)===TRUE) {
		//If data Deleted successfully then redirect to dashboard
		$_SESSION['jobPostDeleteSuccess'] = true;
		header("Location: dashboard.php");
		exit();
	} else {
		//If data failed to delete then show that error. Note: This condition should not come unless we as a developer make mistake or someone tries to hack their way in and mess up :D
		echo "Error " . $sql . "<br>" . $conn->error;
	}

	//Close database connection. Not compulsory but good practice.
	$conn->close();

} else {
	//redirect them back to dashboard page if they didn't click delete button
	header("Location: dashboard.php");
	exit();
}