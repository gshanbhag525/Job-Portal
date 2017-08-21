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

    //We are including PHPWord 
    require_once '../vendor/autoload.php';

    //Location to your template file so it can read and create new file
    $templateLocation = 'resources/resume_template/resume_template_1.docx';

    //Name of your new file which users will see when downloading
    $filename = 'MyResume.docx';

    //Create a new instance of Template Processor class
    $templateProcessor = new \PhpOffice\PhpWord\TemplateProcessor($templateLocation);

    //Setting Value of ${Name} field in template file to $_POST['name']
    $templateProcessor->setValue('Name', $_POST['name']);

    //Setting Value of ${Address} field in template file to $_POST['naaddressme']
    $templateProcessor->setValue('Address', $_POST['address']);

    //Setting Value of ${Phone} field in template file to $_POST['phone']
    $templateProcessor->setValue('Phone', $_POST['phone']);

    //Setting Value of ${Email} field in template file to $_POST['email']
    $templateProcessor->setValue('Email', $_POST['email']);


    //Counting how many experience has be created by user. So total number of items in experience[] array.
    $countExperience = count($_POST['experience']);

    if( $countExperience > 0 ){

      //We are cloning whole row ${companyName}. So everything next to and uder ${companyName} will also be cloned. Note I have added invisible table around this with no borders. cloneRow only works with tables.
      $templateProcessor->cloneRow('companyName', $countExperience);

      for($i=1; $i<=$countExperience; $i++)
      {

        //Same as above we are getting selector ${companyName} and setting value from our POST array $_POST['companyname'][$i-1]. Since we are cloning so we have to use #.$i to reference to correct selector in this for loop.
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
    
    //After all data has be replaced with user form data then save file as with new name
    $templateProcessor->saveAs($filename);

    //Following headers are required so user can download file and page is not redirected to here on form submit.
    header('Content-Description: File Transfer');
    header('Content-Type: application/octet-stream');
    header('Content-Disposition: attachment; filename='.$filename);
    header('Content-Transfer-Encoding: binary');
    header('Expires: 0');
    header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
    header('Pragma: public');
    header('Content-Length: ' . filesize($filename));

    //flush all data
    flush();
    // Read and delete file from temporary location.
    readfile($filename);
    unlink($filename); 
}   