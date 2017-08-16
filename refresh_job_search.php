<?php

//To Handle Session Variables on This Page
session_start();

//Including Database Connection From db.php file to avoid rewriting in all files
require_once("db.php");

$sql = "SELECT * FROM job_post";

if(!empty($_GET['experience'])) {
	$sql = $sql . " WHERE experience='$_GET[experience]'";
}

if(!empty($_GET['qualification']) && !empty($_GET['experience'])) {
	$sql = $sql . " AND qualification='$_GET[qualification]'";
} else if(!empty($_GET['qualification'])) {
	$sql = $sql . " WHERE qualification='$_GET[qualification]'";
}
$result = $conn->query($sql);
if($result->num_rows > 0) 
{
	while($row = $result->fetch_assoc()) {
		$json[] = array(
			0 => $row['jobtitle'],
			1 => $row['description'],
			2 => $row['minimumsalary'],
			3 => $row['maximumsalary'],
			4 => $row['experience'],
			5 => $row['qualification'],
			);
	}

	echo json_encode($json);
	
}


