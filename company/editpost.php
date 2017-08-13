<?php
session_start();
require_once("../db.php");

//If user clicked register button
if(isset($_POST)) {

	//Escape Special Characters In String First
	$jobtitle = mysqli_real_escape_string($conn, $_POST['jobtitle']);
	$description = mysqli_real_escape_string($conn, $_POST['description']);
	$minimumsalary = mysqli_real_escape_string($conn, $_POST['minimumsalary']);
	$maximumsalary = mysqli_real_escape_string($conn, $_POST['maximumsalary']);
	$experience = mysqli_real_escape_string($conn, $_POST['experience']);
	$qualification = mysqli_real_escape_string($conn, $_POST['qualification']);

	$sql = "UPDATE job_post SET jobtitle='$jobtitle', description='$description', minimumsalary='$minimumsalary', maximumsalary='$maximumsalary', experience='$experience', qualification='$qualification' WHERE id_jobpost='$_POST[target_id]' AND id_company='$_SESSION[id_user]'";

	if($conn->query($sql)===TRUE) {
		$_SESSION['jobPostUpdateSuccess'] = true;
		header("Location: dashboard.php");
		exit();
	} else {
		echo "Error " . $sql . "<br>" . $conn->error;
	}

	$conn->close();

} else {
	header("Location: dashboard.php");
	exit();
}