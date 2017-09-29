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
        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title">Class Information</h3>

                        <div class="box-tools">
                            <div class="input-group input-group-sm" style="width: 150px;">
                                <!--input type="text" name="table_search" class="form-control pull-right" placeholder="Search"-->

                                <div class="input-group-btn">
                                  <!--button type="submit" class="btn btn-default"><i class="fa fa-search"></i></button-->
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body table-responsive no-padding">
                        <table class="table table-striped">
                            <tr>
                                <th>ID</th>
                                <th>Class</th>
                                <th>Teacher One</th>
                                <th>Teacher Two</th>
                                <th>Tuition</th>

                            </tr>
                            <?php
                            while ($classData = mysqli_fetch_array($classQuery)) {
                                $phoneOne = $classData['teacherOne'];
                                $getName="SELECT fname, sname FROM users WHERE phoneNum = '$phoneOne'";
                                $fetchNames = mysqli_query($conString, $getName);
                                $teacherName = mysqli_fetch_array($fetchNames);
                                
                                
                                //teacherTwo
                                $phoneTwo = $classData['teacherTwo'];
                                $getName2="SELECT fname, sname FROM users WHERE phoneNum = '$phoneTwo'";
                                $fetchNames2 = mysqli_query($conString, $getName2);
                                $teacherName2 = mysqli_fetch_array($fetchNames2);
                                #$kidRegNum = $classData['realRegNum'];
                                
                                $fee = $classData['fees'] . ".00";

                                echo "<tr>";
                                echo "<td>" . $classData['id'] . "</td>";
                                echo "<td>" . $classData['grade'] . "</td>";
                                echo "<td>" . $teacherName['fname']." ".$teacherName['sname'] . "</td>";
                                echo "<td>" . $teacherName2['fname']." ".$teacherName2['sname'] . "</td>";
                                echo "<td><del>N</del>" . number_format($fee/100) . "</td>";
                                echo '</tr>';

                                //echo "$";
                            }
                            ?>

                        </table>
                    </div>
                    <!-- /.box-body -->
                </div>
                <!-- /.box -->
            </div>
        </div>

        <div class="box box-default">
            <div class="box-header with-border">
                <div class="box-header">
                        <h3 class="box-title">Assign teachers to classes</h3>
                </div>
                <div class="col-md-4">

                    <div class="form-group">
                        <label>Select Class</label>
                        <form method="POST" action="process/teacherToClass.php">
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
                    <h3 class="box-title"></h3>

                </div>

                <div class="col-md-4">

                    <div class="form-group">
                        <label>Select Teacher</label>
                        
                        <input list="teachers" class="form-control" placeholder="Type to search" name="teacherList">
                                <datalist id="teachers">
                            <?php
                            $getTeacherInfo = "SELECT * FROM users ORDER BY fname ASC";
                            $teacherQuery = mysqli_query($conString, $getTeacherInfo);


                           
                                while ($getTeachers = mysqli_fetch_assoc($teacherQuery)) {
                                    echo "<option value = '" . $getTeachers['phonenum'] ."'>" . $getTeachers['fname'] . " " . $getTeachers['sname'] . "</option>";
                                }
                                ?>
                         </datalist>

                    </div>
                    <h3 class="box-title"></h3>

                </div>

                <div class="col-md-4">

                    <div class="form-group">
                        <label>Set Term</label>
                        <select name="role" class="form-control">
                            <option value="1">Teacher One</option>
                            <option value="2">Teacher Two</option>
                        </select>
                        <br>
                        <input type="submit" name="submit" class="btn btn-success pull-right" value="Set Term">
                        </form>
                    </div>
                    <h3 class="box-title"></h3>

                </div>

            </div>
        </div>

        
        <!---Add classes--->
        
        
         <div class="box box-default">
            <div class="box-header with-border">
                <div class="box-header">
                        <h3 class="box-title">Create New Class</h3>
                </div>
               
               
                <div class="col-md-6">

                    <div class="form-group">
                        <form action="process/addClass.php" method="POST">
                        <label>Class name</label>
                        <input type="text" name="className" class="form-control" required="required">
                        <br>
                        <input type="submit" name="submit" class="btn btn-success pull-right" value="Add Class">
                        </form>
                    </div>
                    <h3 class="box-title"></h3>

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