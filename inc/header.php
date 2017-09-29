<?php
require 'inc/session.php';
if($priv < 2 && $_SERVER['PHP_SELF']=='index.php'){
       header('location:parentDashboard.php');
   }
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Sukulu | Dashboard</title>
        <!-- Tell the browser to be responsive to screen width -->
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
        <!-- Bootstrap 3.3.6 -->
        <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
        <!-- Font Awesome -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
        <!-- Ionicons -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
        <!-- Theme style -->
        <link rel="stylesheet" href="dist/css/AdminLTE.min.css">
        <!-- AdminLTE Skins. Choose a skin from the css/skins
             folder instead of downloading all of them to reduce the load. -->
        <link rel="stylesheet" href="dist/css/skins/_all-skins.min.css">
        <!-- iCheck -->
        <link rel="stylesheet" href="plugins/iCheck/flat/blue.css">
        <!-- Morris chart -->
        <link rel="stylesheet" href="plugins/morris/morris.css">
        <!-- jvectormap -->
        <link rel="stylesheet" href="plugins/jvectormap/jquery-jvectormap-1.2.2.css">
        <!-- Date Picker -->
        <link rel="stylesheet" href="plugins/datepicker/datepicker3.css">
        <!-- Daterange picker -->
        <link rel="stylesheet" href="plugins/daterangepicker/daterangepicker.css">
        <!-- bootstrap wysihtml5 - text editor -->
        <link rel="stylesheet" href="plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css">
        <script src="plugins/tinymce/tinymce.min.js"></script>
  <script>tinymce.init({ selector:'textarea' });</script>

        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->
    </head>
    <body class="hold-transition skin-blue sidebar-mini">
        <div class="wrapper">

            <header class="main-header">
                <!-- Logo -->
                <a href="#" class="logo">
                    <!-- mini logo for sidebar mini 50x50 pixels -->
                    <span class="logo-mini"><img src="uploads/minilogo.png" width="30"></span>
                    <!-- logo for regular state and mobile devices -->
                    <span class="logo-lg"><img src="uploads/logo.png" width="150"></span>
                </a>
                <!-- Header Navbar: style can be found in header.less -->
                <nav class="navbar navbar-static-top">
                    <!-- Sidebar toggle button-->
                    <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
                        <span class="sr-only">Toggle navigation</span>
                    </a>

                    <div class="navbar-custom-menu">
                        <ul class="nav navbar-nav">
                            <!-- Messages: style can be found in dropdown.less-->
                           
                            <!-- Notifications: style can be found in dropdown.less -->
                            <!-- Tasks: style can be found in dropdown.less -->
                           <!-- User Account: style can be found in dropdown.less -->
                            <li class="dropdown user user-menu">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                    <?php $imgLink = str_replace("..", "", $profileData['passport']) ?>
                                    <img src="<?php echo $baseURL."/".$imgLink; ?>" class="user-image" alt="User Image">
                                    <span class="hidden-xs"><?php echo $profileData['fname'] ." ".$profileData['sname']; ?></span>
                                </a>
                                <ul class="dropdown-menu">
                                    <!-- User image -->
                                    <li class="user-header">
                                        <img src="<?php echo $baseURL."/".$imgLink; ?>" class="img-circle" alt="User Image">

                                        <p>
                                            <?php
                                            echo $profileData['fname'] . " " . $profileData['sname'];
                                            ?>
                                            
                                        </p>
                                    </li>
                                    <!-- Menu Body -->
                                    <li class="user-body">
                                       
                                        <!-- /.row -->
                                    </li>
                                    <!-- Menu Footer-->
                                    <li class="user-footer">
                                        <!--div class="pull-left">
                                            <a href="#" class="btn btn-default btn-flat">Profile</a>
                                        </div-->
                                        <div class="pull-right">
                                            <a href="logout.php" class="btn btn-default btn-flat">Log out</a>
                                        </div>
                                    </li>
                                </ul>
                            </li>
                            <!-- Control Sidebar Toggle Button -->
                            
                        </ul>
                    </div>
                </nav>
            </header>
            
            <?php
            $userPrivilege = $profileData['priv'];

            function checkPrivilege() {
                global $userPrivilege;
                
                if ($userPrivilege == 1) {
                    require 'inc/parentSidebar.php';
                }
                if ($userPrivilege == 2){
                    require 'inc/teacherSidebar.php';
                }
                 if ($userPrivilege == 3){
                    require 'inc/adminSidebar.php';
                }
            }
            ?>