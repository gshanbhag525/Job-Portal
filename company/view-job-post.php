<?php

//To Handle Session Variables on This Page
session_start();

//If user Not logged in then redirect them back to homepage. 
//This is required if user tries to manually enter view-job-post.php in URL.
if(empty($_SESSION['id_user'])) {
	header("Location: ../index.php");
	exit();
}

//Including Database Connection From db.php file to avoid rewriting in all files  
require_once("../db.php");
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>Job Portal</title>

    <!-- Bootstrap -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  <body>
    
    <!-- NAVIGATION BAR -->
    <header>
      <nav class="navbar navbar-default">
        <div class="container-fluid">
          <!-- Brand and toggle get grouped for better mobile display -->
          <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
              <span class="sr-only">Toggle navigation</span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="../index.php">Job Portal</a>
          </div>

          <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">     
            <ul class="nav navbar-nav navbar-right">
              <li><a href="dashboard.php">Dashboard</a></li>
              <li><a href="../logout.php">Logout</a></li>
            </ul>
          </div><!-- /.navbar-collapse -->
        </div><!-- /.container-fluid -->
      </nav>
    </header>

    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <div class="table-responsive">
            <h2 class="text-center">All Job Posts</h2>
            <table class="table table-striped">
              <thead>
                <th>Job Name</th>
                <th>Job Description</th>
                <th>Minimum Salary</th>
                <th>Maximum Salary</th>
                <th>Experience</th>
                <th>Qualification</th>
                <th>Created At</th>
                <th>Action</th>
              </thead>
              <tbody>
                <?php 

                $stmt = $conn->prepare("SELECT * FROM job_post WHERE id_company=?");

                $stmt->bind_param("i", $_SESSION['id_user']);

                $stmt->execute();

                $result = $stmt->get_result();

                if($result->num_rows > 0) {
                  while($row = $result->fetch_assoc()) 
                  {
                   ?>
                    <tr>
                      <td><?php echo $row['jobtitle']; ?></td>
                      <td><?php echo $row['description']; ?></td>
                      <td><?php echo $row['minimumsalary']; ?></td>
                      <td><?php echo $row['maximumsalary']; ?></td>
                      <td><?php echo $row['experience']; ?></td>
                      <td><?php echo $row['qualification']; ?></td>
                      <td><?php echo date("d-M-Y", strtotime($row['createdat'])); ?></td>
                      <td><a href="edit-job-post.php?id=<?php echo $row['id_jobpost']; ?>">Edit</a> <a href="delete-job-post.php?id=<?php echo $row['id_jobpost']; ?>">Delete</a></td>
                    </tr>
                   <?php
                 }
               }

               $stmt->close();


                //Sql Query to show all job_post created by logged in company
                  // $sql = "SELECT * FROM job_post WHERE id_company='$_SESSION[id_user]'";
                  // $result = $conn->query($sql);

                  // //If Job Post exists then display details of post
                  // if($result->num_rows > 0) {
                  //   while($row = $result->fetch_assoc()) 
                  //   {
                     ?>
                   <!--    <tr>
                        <td><?php echo $row['jobtitle']; ?></td>
                        <td><?php echo $row['description']; ?></td>
                        <td><?php echo $row['minimumsalary']; ?></td>
                        <td><?php echo $row['maximumsalary']; ?></td>
                        <td><?php echo $row['experience']; ?></td>
                        <td><?php echo $row['qualification']; ?></td>
                        <td><?php echo date("d-M-Y", strtotime($row['createdat'])); ?></td>
                        <td><a href="edit-job-post.php?id=<?php echo $row['id_jobpost']; ?>">Edit</a> <a href="delete-job-post.php?id=<?php echo $row['id_jobpost']; ?>">Delete</a></td>
                      </tr> -->
                     <?php
                  //   }
                  // }
                  //Close database connection. Not compulsory but good practice.
                  $conn->close();
                ?>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>

    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
  </body>
</html>