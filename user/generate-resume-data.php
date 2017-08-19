<?php

//To Handle Session Variables on This Page
session_start();

//If user Not logged in then redirect them back to homepage. 
//This is required if user tries to manually enter dashboard.php in URL.
if(empty($_SESSION['id_user'])) {
  header("Location: ../index.php");
  exit();
}

if(isset($_POST)) {

    require_once '../vendor/autoload.php';

    $templateLocation = 'resources/resume_template/resume_template_1.docx';
    $filename = 'MyResume.docx';

    $templateProcessor = new \PhpOffice\PhpWord\TemplateProcessor($templateLocation);

    $templateProcessor->setValue('Name', $_POST['name']);
    $templateProcessor->setValue('Address', $_POST['address']);
    $templateProcessor->setValue('Phone', $_POST['phone']);
    $templateProcessor->setValue('Email', $_POST['email']);

    $countExperience = count($_POST['experience']);

    if( $countExperience > 0 ){

      $templateProcessor->cloneRow('companyName', $countExperience);

      for($i=1; $i<=$countExperience; $i++)
      {
        $selector = "companyName#".$i;
        $value = $_POST['companyname'][$i-1];
        $templateProcessor->setValue($selector, $value);

        $selector = "location#".$i;
        $value = $_POST['location'][$i-1];
        $templateProcessor->setValue($selector, $value);

        $selector = "position#".$i;
        $value = $_POST['position'][$i-1];
        $templateProcessor->setValue($selector, $value);

        $selector = "timePeriod#".$i;
        $value = $_POST['timeperiod'][$i-1];
        $templateProcessor->setValue($selector, $value);

        $selector = "experience#".$i;
        $value = $_POST['experience'][$i-1];
        $templateProcessor->setValue($selector, $value);
      }     
    }
    
    $templateProcessor->saveAs($filename);
    header('Content-Description: File Transfer');
    header('Content-Type: application/octet-stream');
    header('Content-Disposition: attachment; filename='.$filename);
    header('Content-Transfer-Encoding: binary');
    header('Expires: 0');
    header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
    header('Pragma: public');
    header('Content-Length: ' . filesize($filename));
    flush();
    readfile($filename);
    unlink($filename); // deletes the temporary file
}   