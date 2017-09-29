<?php
/*
 * @Author: Chinoms Ugwuanya
 * This file fetches data for any student referenced
 * by the 'GET' value in the URL 
 */

require'inc/header.php';
require 'inc/sidebar.php';
require 'inc/functions.php';
denyAccess();
$regNum = strip_tags($_GET['regNum']);
//fetch parents' info to pre-populate dropdown list when adding student
$checkStudent = "SELECT * FROM students WHERE realRegNum = '$regNum'";
$studentQuery = mysqli_query($conString, $checkStudent) or die(mysqli_error($conString));
$studentData = mysqli_fetch_assoc($studentQuery);


/*********Select all details of the child's parent using the child's details***/
$parentID = $studentData['parentID'];
$findParent = "SELECT * FROM users WHERE phonenum = '$parentID'";
$queryParent = mysqli_query($conString, $findParent);
$parentInfo = mysqli_fetch_array($queryParent);


//fetch all classes in database to pre-polutae dropdown list when adding student
$checkClasses = "SELECT * FROM grade ORDER BY id DESC";
$classes = mysqli_query($conString, $checkClasses);
//$studentData = mysqli_fetch_array($studentQuery);
?>
<!-- =============================================== -->

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Edit Student Details - 
<?php
echo $studentData['fname'] . " " . $studentData['lname'];
?>

        </h1>

        <ol class="breadcrumb">
            <li class="active"><span class="alert alert-danger">Please note: All fields are required. If there's nothing to put in a field. just type "NA"</span></li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">

        <!-- Default box -->
        <div class="box">
            <div class="box-header with-border">
                <h3 class="box-title">Update </h3> &nbsp; &nbsp; 

              
            </div>




            <div class="box-body">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <form name="addstud" method="POST" enctype="multipart/form-data" action="process/updateStudent.php">
                                <label>First Name</label>
                                <input type="text" class="form-control select2" style="width: 100%;" name="fname" value ="<?php echo $studentData['fname']; ?>" required="required">

                                <label>Middle Name</label>
                                <input type="text" class="form-control select2" style="width: 100%;" name="mname" value ="<?php echo $studentData['mname']; ?>" required="required">

                                <label>Surname</label>
                                <input type="text" class="form-control select2" style="width: 100%;" name="sname" value ="<?php echo $studentData['lname']; ?>" required="required">


                               
                                <label>Student ID</label>
                                <input type="text" readonly="readonly" class="form-control select2" style="width: 100%;" name="regNum" required="required" value ="<?php echo $studentData['realRegNum']; ?>" >
                                </div>
                                <!-- /.form-group -->

                                <!-- /.form-group -->
                                </div>
                                <!-- /.col -->
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Parent</label>
                                        <input type="text" readonly="readonly" class="form-control select2" style="width: 100%;" name="parent" value ="<?php echo $studentData['parentID']; ?>" >

                                      
                                        <label>Weight</label>
                                        <input type="text" value ="<?php echo $studentData['weight']; ?>" class="form-control select2" style="width: 100%;" name="weight" required="required" placeholder="Be sure to add the 'kg' suffix ">

                                        <label>Height</label>
                                        <input type="text" value ="<?php echo $studentData['height']; ?>" class="form-control select2" style="width: 100%;" name="height" required="required" placeholder="Must be in ft/in. Eg.: 3.8ft or 4 ft.">

                                        
                                         <label>Current Class</label>
                                         <input type="readonly" readonly="readonly" value ="<?php echo $studentData['grade']; ?>" class="form-control select2" style="width: 100%;" name="height" required="required" placeholder="Must be in ft/in. Eg.: 3.8ft or 4 ft.">

                                        
                                        
                                        <label>Class</label>
                                        <select name="classes" style="width: 100%" class="form-control select2">
                                            <option value="">----------Select One----------</option>
<?php
while ($getClasses = mysqli_fetch_assoc($classes)) {
    echo "<option value = '" . $getClasses['grade'] . "' value='".$getClasses['grade']."' >" . $getClasses['grade'] .  "</option>";
}
?>
                                        </select>

                                    </div>
                                    <!-- /.form-group -->

                                    <!-- /.form-group -->
                                </div>
                                <!-- /.col -->
                        </div>
                        <!-- /.row -->
                    </div>







                    <div class="box-footer">

                    </div>
                    <!-- /.box-footer-->
                </div>
                <!-- /.box -->

                </section>







                <section class="content">

                    <!-- Default box -->
                    <div class="box">
                        <div class="box-header with-border">
                            <h3 class="box-title">In Case of Emergency</h3>&nbsp;<small> Who to contact when parent/guardian is unavailable</small>
                        </div>








                        <div class="box-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">

                                        <div class="form-group">
                                            <p><b>1st Choice</b></p>
                                            <label>Full Name</label>
                                            <input type="text" value ="<?php echo $studentData['icename']; ?>" maxlength="25" class="form-control select2" style="width: 100%;" name="icename" required="required">

                                            <label>Relationship</label>
                                            <input type="text" value ="<?php echo $studentData['icerel']; ?>" maxlength="15" class="form-control select2" style="width: 100%;" name="icerel" required="required">

                                            <label>Phone Number</label>
                                            <input type="text" value ="<?php echo $studentData['icephone']; ?>" maxlength="12" class="form-control select2" style="width: 100%;" name="icephone" required="required">



                                        </div>





                                    </div>
                                    <!-- /.form-group -->

                                    <!-- /.form-group -->
                                </div>
                                <!-- /.col -->
                                <p style="margin-left: 20px"><b>2nd Choice</b></p>
                                <div class="col-md-6">
                                    <div class="form-group">


                                        <label>Full Name</label>
                                        <input type="text" value ="<?php echo $studentData['icename2']; ?>" maxlength="25" class="form-control select2" style="width: 100%;" name="icename2" required="required">

                                        <label>Relationship</label>
                                        <input type="text" value ="<?php echo $studentData['icerel2']; ?>" maxlength="15" class="form-control select2" style="width: 100%;" name="icerel2" required="required">

                                        <label>Phone Number</label>
                                        <input type="text" value ="<?php echo $studentData['icephone2']; ?>" maxlength="12" class="form-control select2" style="width: 100%;" name="icephone2" required="required">
                                        <br>
                                        <input type="submit" name="submit" value="Save" class="btn btn-lg btn-success">
                                        </form>





                                    </div>
                                    <!-- /.form-group -->

                                    <!-- /.form-group -->
                                </div>
                                <!-- /.col -->
                            </div>
                            <!-- /.row -->
                        </div>



                    </div>
            </div>
        </div>
</div>








<?php
require 'inc/footer.php';
?>