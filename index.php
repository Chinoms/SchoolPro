<?php
require('inc/header.php');
require('inc/sidebar.php');
require ('inc/functions.php');

denyAccess();
?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Dashboard
            <small>Control panel</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Dashboard</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <!-- Small boxes (Stat box) -->
        <div class="row">
            <div class="col-lg-3 col-xs-6">
                <!-- small box -->
                <div class="small-box bg-aqua">
                    <div class="inner">
                        <h3><?php totalStudents(); ?></h3>

                        <p>Total students</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-person-add"></i>
                    </div>
                    <a href="<?php echo $baseURL . '/parentDashboard.php?cmd=allStudents'; ?>" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-3 col-xs-6">
                <!-- small box -->
                <div class="small-box bg-orange">
                    <div class="inner">
                        <h3><?php totalMales(); ?></h3>

                        <p>Total Male Students</p>
                    </div>
                    <div class="icon">
                        <i class="fa fa-male"></i>
                    </div>
<a href="<?php echo $baseURL . '/parentDashboard.php?cmd=allMales'; ?>" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-3 col-xs-6">
                <!-- small box -->
                <div class="small-box bg-purple">
                    <div class="inner">
                        <h3><?php totalFeMales(); ?></h3>

                        <p>Total Female Students</p>
                    </div>
                    <div class="icon">
                        <i class="fa fa-female"></i>
                    </div>
<a href="<?php echo $baseURL . '/parentDashboard.php?cmd=allFemales'; ?>" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-3 col-xs-6">
                <!-- small box -->
                <div class="small-box bg-red">
                    <div class="inner">
                        <h3><?php totalParents(); ?></h3>

                        <p>Parents</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-pie-graph"></i>
                    </div>
                    <a href="<?php echo $baseURL . '/parentDashboard.php?cmd=allParents'; ?>" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <!-- ./col -->
            
             <div class="col-lg-6 col-xs-6">
                <!-- small box -->
               
            </div>
            <!-- ./col -->
            
            
        </div>
        <!-- /.row -->
        <!-- Main row -->
        <div class="row">
            <!-- Left col -->
            <section class="col-lg-7 connectedSortable">
                <!-- Custom tabs (Charts with tabs)-->
                <div class="nav-tabs-custom">
                    <!-- Tabs within a box -->

                    <!-- Calendar --> <div class="small-box bg-fuchsia">
                    <div class="inner">
                        <h3><?php totalTeachers(); ?></h3>

                        <p>Total Teachers</p>
                    </div>
                    <div class="icon">
                        <i class="fa fa-mortar-board"></i>
                    </div>
                    <a href="<?php echo $baseURL . '/parentDashboard.php?cmd=allTeachers'; ?>" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
                </div>
                    <div class="box box-solid bg-green-gradient">
                        <div class="box-header">
                            <i class="fa fa-calendar"></i>

                            <h3 class="box-title">Calendar</h3>
                            <!-- tools box -->

                            <!-- /. tools -->
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body no-padding">
                            <!--The calendar -->
                            <div id="calendar" style="width: 100%"></div>
                        </div>
                        <!-- /.box-body -->
                        <div class="box-footer text-black">
                            <div class="row">

                                <!-- /.col -->

                                <!-- /.col -->
                            </div>
                            <!-- /.row -->
                        </div>
                    </div>

                </div>
                <!-- /.nav-tabs-custom -->

                <!-- Chat box -->


                <!-- quick email widget -->

            </section>
            <!-- /.Left col -->
            <!-- right col (We are only adding the ID to make the widgets sortable)-->
            <section class="col-lg-5 connectedSortable">

                <!-- Map box -->
                <div class="box box-solid">
                    <div class="box-header">
                        <!-- tools box -->

                        <!-- /. tools -->


                    </div>
                    <div class="box-body">
                        <img src="<?php echo $baseURL . '/uploads/images/pmslogo.jpg'; ?>" class="img img-responsive">
                    </div>
                    <!-- /.box-body-->

                </div>
                <!-- /.box -->

                <!-- Calendar -->

                <!-- /.box -->

            </section>
            <!-- right col -->
        </div>
        <!-- /.row (main row) -->

    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->
<?php
require 'inc/footer.php';
?>