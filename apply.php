<?php

//To Handle Session Variables on This Page
session_start();

if(empty($_SESSION['id_user'])) {
	header("Location: index.php");
	exit();
}

//Including Database Connection From db.php file to avoid rewriting in all files
require_once("db.php");

//If user Actually clicked apply button
if(isset($_GET)) {

	$sql = "SELECT * FROM job_post WHERE id_jobpost='$_GET[id]'";
	  $result = $conn->query($sql);
	  if($result->num_rows > 0) 
	  {
	    	$row = $result->fetch_assoc();
	    	$id_company = $row['id_company'];
	   }

	//Check if user has applied to job post or not. If not then add his details to apply_job_post table.
	$sql1 = "SELECT * FROM apply_job_post WHERE id_user='$_SESSION[id_user]' AND id_jobpost='$row[id_jobpost]'";
    $result1 = $conn->query($sql1);
    if($result1->num_rows == 0) {  
    	
    	$sql = "INSERT INTO apply_job_post(id_jobpost, id_company, id_user) VALUES ('$_GET[id]', '$id_company', '$_SESSION[id_user]')";

		if($conn->query($sql)===TRUE) {
			$_SESSION['jobApplySuccess'] = true;
			header("Location: user/index.php");
			exit();
		} else {
			echo "Error " . $sql . "<br>" . $conn->error;
		}

		$conn->close();

    }  else {
		header("Location: jobs.php");
		exit();
	}
	

} else {
	header("Location: jobs.php");
	exit();
}