<?php

//To Handle Session Variables on This Page
session_start();

//Including Database Connection From db.php file to avoid rewriting in all files
require_once("db.php");

//If user Actually clicked register button
if(isset($_POST)) {

	//Escape Special Characters In String First
	$email = mysqli_real_escape_string($conn, $_POST['email']);

	

	//sql query to check if email already exists or not
	$sql = "SELECT email FROM users WHERE email='$email'";
	$result = $conn->query($sql);

	if($result->num_rows > 0) {

		$newPass = rand(10000, 99999);

		//Encrypt Password
		$password = base64_encode(strrev(md5($newPass)));

		//sql new registration insert query
		$sql = "UPDATE users SET password='$password' WHERE email='$email'";

		if($conn->query($sql)===TRUE) {
			// Send Email

			// $to = $email;

			// $subject = "Job Portal - Password Reset";

			// $message = '
			
			// <html>
			// <head>
			// 	<title>Your Password Has Been Reset</title>
			// <body>
			// 	<p>Your New Password Is - '.$newPass.'</p>
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

			// 	//If data inserted successfully then Set some session variables for easy reference and redirect to login
			// 	$_SESSION['passwordChanged'] = true;
			// 	header("Location: login.php");
			// 	exit();

			// }

			// //If data inserted successfully then Set some session variables for easy reference and redirect to login
			$_SESSION['passwordChanged'] = $newPass;
			header("Location: forgot-password.php");
			exit();
		} else {
			//If data failed to insert then show that error. Note: This condition should not come unless we as a developer make mistake or someone tries to hack their way in and mess up :D
			echo "Error " . $sql . "<br>" . $conn->error;
		}
	} else {
		//if email found in database
		$_SESSION['emailNotFoundError'] = true;
		header("Location: forgot-password.php");
		exit();
	}

	//Close database connection. Not compulsory but good practice.
	$conn->close();

} else {
	//redirect them back to forgot-password.php page if they didn't click Forgot Password button
	header("Location: forgot-password.php");
	exit();
}