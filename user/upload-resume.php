<?php

session_start();

if(empty($_SESSION['id_user'])) {
	header("Location: ../index.php");
	exit();
}

require_once("../db.php");

if(isset($_POST)) {

	//This variable is used to catch errors doing upload process. False means there is some error and we need to notify that user.
	$uploadOk = true;

	//Folder where you want to save your resume. THIS FOLDER MUST BE CREATED BEFORE TRYING
	$folder_dir = "../uploads/resume/";

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
		header("Location: resume-upload.php");
		exit();
	}

	//If no errors then check if user uploaded resume before or not. If uploaded then delete old file from server and update database with new file name.
	$sql = "SELECT * FROM users WHERE id_user='$_SESSION[id_user]'";
	$result = $conn->query($sql);
	if($result->num_rows > 0) {
		$row = $result->fetch_assoc();
		if($row['resume'] != "") {
			unlink("../uploads/resume/".$row['resume']);
		}
	}

	$sql = "UPDATE users set resume='$file' WHERE id_user='$_SESSION[id_user]'";
	if($conn->query($sql)) {
		header("Location: resume.php");
		exit();
	} else {
		echo "Error: " . $sql . "<br>" . $conn->error;
	}

	$conn->close();
}