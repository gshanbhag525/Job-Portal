<?php

//To Handle Session Variables on This Page
session_start();

//Including Database Connection From db.php file to avoid rewriting in all files
require_once("db.php");

//If user Actually clicked register button
if(isset($_POST)) {

	//Escape Special Characters In String First
	$firstname = mysqli_real_escape_string($conn, $_POST['fname']);
	$lastname = mysqli_real_escape_string($conn, $_POST['lname']);
	$address = mysqli_real_escape_string($conn, $_POST['address']);
	$city = mysqli_real_escape_string($conn, $_POST['city']);
	$state = mysqli_real_escape_string($conn, $_POST['state']);
	$contactno = mysqli_real_escape_string($conn, $_POST['contactno']);
	$qualification = mysqli_real_escape_string($conn, $_POST['qualification']);
	$stream = mysqli_real_escape_string($conn, $_POST['stream']);
	$passingyear = mysqli_real_escape_string($conn, $_POST['passingyear']);
	$dob = mysqli_real_escape_string($conn, $_POST['dob']);
	$age = mysqli_real_escape_string($conn, $_POST['age']);
	$designation = mysqli_real_escape_string($conn, $_POST['designation']);
	$aboutme = mysqli_real_escape_string($conn, $_POST['aboutme']);
	$skills = mysqli_real_escape_string($conn, $_POST['skills']);
	$email = mysqli_real_escape_string($conn, $_POST['email']);
	$password = mysqli_real_escape_string($conn, $_POST['password']);
	//Encrypt Password
	$password = base64_encode(strrev(md5($password)));

	//sql query to check if email already exists or not
	$sql = "SELECT email FROM users WHERE email='$email'";
	$result = $conn->query($sql);

	//if email not found then we can insert new data
	if($result->num_rows == 0) {

			//This variable is used to catch errors doing upload process. False means there is some error and we need to notify that user.
	$uploadOk = true;

	//Folder where you want to save your resume. THIS FOLDER MUST BE CREATED BEFORE TRYING
	$folder_dir = "uploads/resume/";

	//Getting Basename of file. So if your file location is Documents/New Folder/myResume.pdf then base name will return myResume.pdf
	$base = basename($_FILES['resume']['name']); 

	//This will get us extension of your file. So myResume.pdf will return pdf. If it was resume.doc then this will return doc.
	$resumeFileType = pathinfo($base, PATHINFO_EXTENSION); 

	//Setting a random non repeatable file name. Uniqid will create a unique name based on current timestamp. We are using this because no two files can be of same name as it will overwrite.
	$file = uniqid() . "." . $resumeFileType;   

	//This is where your files will be saved so in this case it will be uploads/resume/newfilename
	$filename = $folder_dir .$file;  

	//We check if file is saved to our temp location or not.
	if(file_exists($_FILES['resume']['tmp_name'])) { 

		//Next we need to check if file type is of our allowed extention or not. I have only allowed pdf. You can allow doc, jpg etc. 
		if($resumeFileType == "pdf")  {

			//Next we need to check file size with our limit size. I have set the limit size to 5MB. Note if you set higher than 2MB then you must change your php.ini configuration and change upload_max_filesize and restart your server
			if($_FILES['resume']['size'] < 500000) { // File size is less than 5MB

				//If all above condition are met then copy file from server temp location to uploads folder.
				move_uploaded_file($_FILES["resume"]["tmp_name"], $filename);

			} else {
				//Size Error
				$_SESSION['uploadError'] = "Wrong Size. Max Size Allowed : 5MB";
				$uploadOk = false;
			}
		} else {
			//Format Error
			$_SESSION['uploadError'] = "Wrong Format. Only PDF Allowed";
			$uploadOk = false;
		}
	} else {
			//File not copied to temp location error.
			$_SESSION['uploadError'] = "Something Went Wrong. File Not Uploaded. Try Again.";
			$uploadOk = false;
		}

	//If there is any error then redirect back.
	if($uploadOk == false) {
		header("Location: register-candidates.php");
		exit();
	}

		$hash = md5(uniqid());


		//sql new registration insert query
		$sql = "INSERT INTO users(firstname, lastname, email, password, address, city, state, contactno, qualification, stream, passingyear, dob, age, designation, resume, hash, aboutme, skills) VALUES ('$firstname', '$lastname', '$email', '$password', '$address', '$city', '$state', '$contactno', '$qualification', '$stream', '$passingyear', '$dob', '$age', '$designation', '$file', '$hash', '$aboutme', '$skills')";

		if($conn->query($sql)===TRUE) {
			// Send Email

			// $to = $email;

			// $subject = "Job Portal - Confirm Your Email Address";

			// $message = '
			
			// <html>
			// <head>
			// 	<title>Confirm Your Email</title>
			// <body>
			// 	<p>Click Link To Confirm</p>
			// 	<a href="yourdomain.com/verify.php?token='.$hash.'&email='.$email.'">Verify Email</a>
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
			// 	$_SESSION['registerCompleted'] = true;
			// 	header("Location: login.php");
			// 	exit();

			// }

			// //If data inserted successfully then Set some session variables for easy reference and redirect to login
			$_SESSION['registerCompleted'] = true;
			header("Location: login-candidates.php");
			exit();
		} else {
			//If data failed to insert then show that error. Note: This condition should not come unless we as a developer make mistake or someone tries to hack their way in and mess up :D
			echo "Error " . $sql . "<br>" . $conn->error;
		}
	} else {
		//if email found in database then show email already exists error.
		$_SESSION['registerError'] = true;
		header("Location: register-candidates.php");
		exit();
	}

	//Close database connection. Not compulsory but good practice.
	$conn->close();

} else {
	//redirect them back to register page if they didn't click register button
	header("Location: register-candidates.php");
	exit();
}