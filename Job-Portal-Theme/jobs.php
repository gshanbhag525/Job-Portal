<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Job Portal</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="css/AdminLTE.min.css">
  <link rel="stylesheet" href="css/_all-skins.min.css">
  <!-- Custom -->
  <link rel="stylesheet" href="css/custom.css">
  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

  <!-- Google Font -->
  <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>
<body class="hold-transition skin-green sidebar-mini">
<div class="wrapper">

  <header class="main-header">

    <!-- Logo -->
    <a href="index.php" class="logo logo-bg">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini"><b>J</b>P</span>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg"><b>Job</b> Portal</span>
    </a>

    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
      <!-- Navbar Right Menu -->
      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
          <li>
            <a href="login.php">Login</a>
          </li>
          <li>
            <a href="sign-up.php">Sign Up</a>
          </li>          
        </ul>
      </div>
    </nav>
  </header>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper" style="margin-left: 0px;">

    <section class="content-header">
      <div class="container">
        <div class="row">
          <div class="col-md-12 latest-job margin-top-50 margin-bottom-20">
          <h1 class="text-center">Latest Jobs</h1>  
            <div class="input-group input-group-lg">
                <input type="text" class="form-control" placeholder="Search job, location or company">
                <span class="input-group-btn">
                  <button type="button" class="btn btn-info btn-flat">Go!</button>
                </span>
            </div>
          </div>
        </div>
      </div>
    </section>

    <section id="candidates" class="content-header">
      <div class="container">
        <div class="row">
          <div class="col-md-3">
            <div class="box box-solid">
              <div class="box-header with-border">
                <h3 class="box-title">Filters</h3>
              </div>
              <div class="box-body no-padding">
                <ul class="nav nav-pills nav-stacked">
                  <li class="treeview menu-open"><a href="#"><i class="fa fa-circle-o text-red"></i> Type</a></li>
                  <li><a href="#"><i class="fa fa-circle-o text-yellow"></i> Location</a></li>
                  <li><a href="#"><i class="fa fa-circle-o text-light-blue"></i> Category</a></li>
                </ul>
              </div>
            </div>
          </div>
          <div class="col-md-9">
            <div class="attachment-block clearfix">
              <img class="attachment-img" src="img/photo1.png" alt="Attachment Image">
              <div class="attachment-pushed">
                <h4 class="attachment-heading"><a href="http://www.lipsum.com/">PHP Developer</a> <span class="attachment-heading pull-right">$10,000/Month</span></h4>
                <div class="attachment-text">
                    <div><strong>Company Name | Location | Experience</strong></div>
                    Lorem ipsum dolor sit amet, consectetur adipisicing elit. Totam laudantium doloremque veniam nam magni quia, similique sapiente minus et molestias.
                </div>
              </div>
            </div>

            <div class="attachment-block clearfix">
              <img class="attachment-img" src="img/photo1.png" alt="Attachment Image">
              <div class="attachment-pushed">
                <h4 class="attachment-heading"><a href="http://www.lipsum.com/">PHP Developer</a> <span class="attachment-heading pull-right">$10,000/Month</span></h4>
                <div class="attachment-text">
                    <div><strong>Company Name | Location | Experience</strong></div>
                    Lorem ipsum dolor sit amet, consectetur adipisicing elit. Totam laudantium doloremque veniam nam magni quia, similique sapiente minus et molestias.
                </div>
              </div>
            </div>

            <div class="attachment-block clearfix">
              <img class="attachment-img" src="img/photo1.png" alt="Attachment Image">
              <div class="attachment-pushed">
                <h4 class="attachment-heading"><a href="http://www.lipsum.com/">PHP Developer</a> <span class="attachment-heading pull-right">$10,000/Month</span></h4>
                <div class="attachment-text">
                    <div><strong>Company Name | Location | Experience</strong></div>
                    Lorem ipsum dolor sit amet, consectetur adipisicing elit. Totam laudantium doloremque veniam nam magni quia, similique sapiente minus et molestias.
                </div>
              </div>
            </div>

            <div class="attachment-block clearfix">
              <img class="attachment-img" src="img/photo1.png" alt="Attachment Image">
              <div class="attachment-pushed">
                <h4 class="attachment-heading"><a href="http://www.lipsum.com/">PHP Developer</a> <span class="attachment-heading pull-right">$10,000/Month</span></h4>
                <div class="attachment-text">
                    <div><strong>Company Name | Location | Experience</strong></div>
                    Lorem ipsum dolor sit amet, consectetur adipisicing elit. Totam laudantium doloremque veniam nam magni quia, similique sapiente minus et molestias.
                </div>
              </div>
            </div>

            <div class="attachment-block clearfix">
              <img class="attachment-img" src="img/photo1.png" alt="Attachment Image">
              <div class="attachment-pushed">
                <h4 class="attachment-heading"><a href="http://www.lipsum.com/">PHP Developer</a> <span class="attachment-heading pull-right">$10,000/Month</span></h4>
                <div class="attachment-text">
                    <div><strong>Company Name | Location | Experience</strong></div>
                    Lorem ipsum dolor sit amet, consectetur adipisicing elit. Totam laudantium doloremque veniam nam magni quia, similique sapiente minus et molestias.
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>

    

  </div>
  <!-- /.content-wrapper -->

  <footer class="main-footer" style="margin-left: 0px;">
    <div class="text-center">
      <strong>Copyright &copy; 2016-2017 <a href="learningfromscratch.online">Job Portal</a>.</strong> All rights
    reserved.
    </div>
  </footer>

  <!-- /.control-sidebar -->
  <!-- Add the sidebar's background. This div must be placed
       immediately after the control sidebar -->
  <div class="control-sidebar-bg"></div>

</div>
<!-- ./wrapper -->

<!-- jQuery 3 -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<!-- Bootstrap 3.3.7 -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/js/bootstrap.min.js"></script>
<!-- AdminLTE App -->
<script src="js/adminlte.min.js"></script>
</body>
</html>
