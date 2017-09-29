<?php
require 'inc/header.php';
require 'inc/sidebar.php';
require 'inc/functions.php';
denyAccess();
$userID = $profileData['phonenum'];

$getClassInfo = "SELECT * FROM grade ORDER BY grade ASC";
$classQuery = mysqli_query($conString, $getClassInfo);
?>

<div class="content-wrapper">
    <!-- Content Header (Page header) -->


    <!-- Main content -->
    <section class="content">

        <!-- /.row -->
       
         <div class="box box-default">
            <div class="box-header with-border">
                <div class="box-header">
                        <h3 class="box-title">Set tuition for individual classes</h3>
                </div>
               
               
                <div class="col-md-6">

                    <div class="form-group">
                        <label>Select Class</label>
                        <form method="POST" action="process/setTermYear.php">
                        <select name="grade" class="form-control">
                            <?php
                            $getClassInfo = "SELECT * FROM grade ORDER BY grade ASC";
                            $classQuery = mysqli_query($conString, $getClassInfo);


                            while ($classInfo = mysqli_fetch_array($classQuery)) {
                                echo '<option value = "' . $classInfo['grade'] . '" >' . $classInfo['grade'] . '</option>';
                            }
                            ?>
                        </select>
                        <br>

                    </div>
             

                </div>
                
                <div class="col-md-6">
                     <div class="form-group">
                        
                        <label>Tuition</label>
                        <input type="number" name="fee" class="form-control" placeholder="Type the value without any punctuation of any sort.">
                        <br>
                        <input type="submit" name="submit" class="btn btn-success pull-right" value="Set Tuition">
                        </form>
                    </div>
                </div>

            </div>
        </div>
    </section>
    <!-- /.content -->



</div>
<!-- /.content-wrapper -->


<!-- Control Sidebar -->

<!-- ./wrapper -->




<?php
require 'inc/footer.php';
?>