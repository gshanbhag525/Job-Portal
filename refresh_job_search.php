<?php

//To Handle Session Variables on This Page
session_start();

//Including Database Connection From db.php file to avoid rewriting in all files
require_once("db.php");

$sql = "SELECT * FROM job_post";

if(!empty($_GET['experience'])) { 
	//Add this line to sql query if experience drop down is not empty.
	$sql = $sql . " WHERE experience='$_GET[experience]'";
}

if(!empty($_GET['qualification']) && !empty($_GET['experience'])) {
	//Add this line if experience and qualification are not empty
	$sql = $sql . " AND qualification='$_GET[qualification]'"; 
} else if(!empty($_GET['qualification'])) {
	//Add this line if qualification is not empty.
	$sql = $sql . " WHERE qualification='$_GET[qualification]'";
}
/**
	So you can get 3 format of sql query:
	1. SELECT * FROM job_post WHERE experience='$_GET[experience]'
	2. SELECT * FROM job_post WHERE experience='$_GET[experience]' AND qualification='$_GET[qualification]'
	3. SELECT * FROM job_post WHERE qualification='$_GET[qualification]'
**/
$result = $conn->query($sql);
if($result->num_rows > 0) 
{
	while($row = $result->fetch_assoc()) {

		if(isset($_SESSION['id_user'])) {
			//Check if user already applied to jobpost or not. If applied then don't show apply link.
			$sql1 = "SELECT * FROM apply_job_post WHERE id_user='$_SESSION[id_user]' AND id_jobpost='$row[id_jobpost]'";
			$result1 = $conn->query($sql1);
			if($result1->num_rows > 0) 
			{
				$apply = "<strong>Applied<strong>";
			} else {
				$apply = "<a href='apply-job-post.php?id=".$row['id_jobpost']."'>Apply</a>";
			}
		} else {
				$apply = "<a href='apply-job-post.php?id=".$row['id_jobpost']."'>Apply</a>";
		}

		
		$json[] = array(
			0 => $row['jobtitle'],
			1 => $row['description'],
			2 => $row['minimumsalary'],
			3 => $row['maximumsalary'],
			4 => $row['experience'],
			5 => $row['qualification'],
			6 => $apply,
			);
	}
	//you need to format and send data as json object as datatables will only accept that.
	echo json_encode($json);
	
}


