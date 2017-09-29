<!-- /.box-header --><?php
require 'inc/header.php';
require 'inc/sidebar.php';
require 'inc/functions.php';
denyAccess();

//fetch list of terms to prepopulate dropdown when setting terms
$allTerms = "SELECT * FROM terms";
$fetchTerms = mysqli_query($conString, $allTerms);


//fetch list of years to prepopulate dropdown when setting terms
$allYears = "SELECT * FROM sessions";
$fetchYears = mysqli_query($conString, $allYears);
?>


<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Set academic sessions and years
            <!--small>Preview</small-->
        </h1>
        <!--ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="#">Add Users</a></li>
            <li class="active">Teachers and Parents</li>
        </ol-->
    </section>

    <!-- Main content -->
    <section class="content">
        <section class="content">
            <div class="row">

                <div class="box box-default">
                    <div class="box-header with-border">
                        <h3 class="box-title"></h3>

                        <div class="box-tools pull-right">
                            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                           
                        </div>
                    </div>
                    <div class="box-body">
                        <div class="row">
                            
                                <form action="process/setTermYear.php" method ="POST">
                                    <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Set Term</label>
                                        <select name="term" class="form-control">
                                            <?php
                                            while ($getTerms = mysqli_fetch_assoc($fetchTerms)) {
                                                echo '<option value = "' . $getTerms['term'] . '" >' . $getTerms['term'] . '</option>';
                                            }
                                            ?>
                                        </select>
                                        <br>
                                        <input type="submit" name="setTerm" class="btn btn-success pull-right" value="Set Term">
                                        
                                    </div>
                                    <!-- /.form-group -->
                                   
                                   
                                    <!-- /.form-group -->
                                   
                                    <!-- /.form-group -->

                            </div>
</form>
                            <!-- /.col -->
                            <form method="POST" action="process/setTermYear.php">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Set Year</label>
                                    <select name="year" class="form-control">
                                        <?php
                                        while ($getYears = mysqli_fetch_assoc($fetchYears)) {
                                            echo '<option value = "' . $getYears['year'] . '" >' . $getYears['year'] . '</option>';
                                        }
                                        ?>
                                    </select>
                                    <br>
                                    <input type="submit" name="setYear" class="btn btn-success pull-right" value="Set Year">
                                </div>
                                <!-- /.form-group -->
                                
                              
                                </form>
                                <!-- /.form-group -->
                            </div>
                            <!-- /.col -->
                        </div>


                        <!-- /.row -->
                    </div>
                    <!-- /.box-body -->
                    <div class="box-footer">

                    </div>
                </div>
            </div>

        </section>
</div>

<?php
require 'inc/footer.php';
?>