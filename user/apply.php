<?php

//To Handle Session Variables on This Page
session_start();

//Including Database Connection From db.php file to avoid rewriting in all files
require_once("../db.php");

//If user Actually clicked apply button
//Todo: Fix This. Use Post For Safety.
if(isset($_POST)) {

	$sql = "SELECT * FROM job_post WHERE id_jobpost='$_GET[id]'";
	  $result = $conn->query($sql);
	  if($result->num_rows > 0) 
	  {
	    	$row = $result->fetch_assoc();
	    	$id_company = $row['id_company'];
	   }

	$sql1 = "SELECT * FROM apply_job_post WHERE id_user='$_SESSION[id_user]' AND id_jobpost='$row[id_jobpost]'";
    $result1 = $conn->query($sql1);
    if($result1->num_rows == 0) {  
    	
    	$sql = "INSERT INTO apply_job_post(id_jobpost, id_company, id_user) VALUES ('$_GET[id]', '$id_company', '$_SESSION[id_user]')";

		if($conn->query($sql)===TRUE) {
			$_SESSION['jobApplySuccess'] = true;
			header("Location: dashboard.php");
			exit();
		} else {
			echo "Error " . $sql . "<br>" . $conn->error;
		}

		$conn->close();

    }  else {
		header("Location: dashboard.php");
		exit();
	}
	

} else {
	header("Location: dashboard.php");
	exit();
}