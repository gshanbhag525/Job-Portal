<?php

session_start();

require_once("../db.php");

//Status 0 means show user and Status 1 means don't show user details for this job post.
$sql = "UPDATE apply_job_post SET status='1' WHERE id_jobpost='$_GET[id_jobpost]' AND id_user='$_GET[id_user]'";

if($conn->query($sql) === TRUE) {

	$sql1 = "SELECT * FROM job_post WHERE id_jobpost='$_GET[id_jobpost]'";
  $result1 = $conn->query($sql1);

  if($result1->num_rows > 0) {
    while($row = $result1->fetch_assoc()) 
    {

		// $to = $_GET['email'];

		// $subject = "Job Portal - Application Rejected!";

		// $message = '
		
		// <html>
		// <head>
		// 	<title>Job Portal - Application Rejected!</title>
		// <body>
		// 	<p>Sorry To Inform You But Your Application For '.$row['jobtitle'].' Has Been Rejected!</p>
		// </body>
		// </html>
		// ';

		// $headers[] = 'MIME-VERSION: 1.0';
		// $headers[] = 'Content-type: text/html; charset=iso-8859-1';
		// $headers[] = 'To: '.$to;
		// $headers[] = 'From: hello@yourdomain.com';
		// //you add more headers like Cc, Bcc;

		// $result = mail($to, $subject, $message, implode("\r\n", $headers)); // \r\n will return new line. 

		// if($result === TRUE) {

		// 	header("Location: view-job-application.php");
		// 	exit();

		// }
		header("Location: view-job-application.php");
		exit();
	}
	}
	
} else {
	echo "Error!";
}

$conn->close();