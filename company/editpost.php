<?php

//To Handle Session Variables on This Page
session_start();

//Including Database Connection From db.php file to avoid rewriting in all files  
require_once("../db.php");

//If user clicked Edit Post button
if(isset($_POST)) {

	//Escape Special Characters In String First
	$jobtitle = mysqli_real_escape_string($conn, $_POST['jobtitle']);
	$description = mysqli_real_escape_string($conn, $_POST['description']);
	$minimumsalary = mysqli_real_escape_string($conn, $_POST['minimumsalary']);
	$maximumsalary = mysqli_real_escape_string($conn, $_POST['maximumsalary']);
	$experience = mysqli_real_escape_string($conn, $_POST['experience']);
	$qualification = mysqli_real_escape_string($conn, $_POST['qualification']);

	//Sql Query for updating job post.
	$sql = "UPDATE job_post SET jobtitle='$jobtitle', description='$description', minimumsalary='$minimumsalary', maximumsalary='$maximumsalary', experience='$experience', qualification='$qualification' WHERE id_jobpost='$_POST[target_id]' AND id_company='$_SESSION[id_user]'";

	if($conn->query($sql)===TRUE) {
		//If data Updated successfully then redirect to dashboard
		$_SESSION['jobPostUpdateSuccess'] = true;
		header("Location: dashboard.php");
		exit();
	} else {
		//If data failed to insert then show that error. Note: This condition should not come unless we as a developer make mistake or someone tries to hack their way in and mess up :D
		echo "Error " . $sql . "<br>" . $conn->error;
	}

	//Close database connection. Not compulsory but good practice.
	$conn->close();

} else {
	//redirect them back to dashboard page if they didn't click Edit Post button
	header("Location: dashboard.php");
	exit();
}