<?php


session_start();

if(empty($_SESSION['id_company'])) {
  header("Location: ../index.php");
  exit();
}

require_once("../db.php");

if(isset($_POST)) {
	
	$sql = "UPDATE company SET active='3' WHERE id_company='$_SESSION[id_company]'";

	if($conn->query($sql) == TRUE) {
		header("Location: ../logout.php");
		exit();
	} else {
		echo $conn->error;
	}
} else {
	header("Location: settings.php");
	exit();
}