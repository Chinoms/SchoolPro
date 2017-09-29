<?php
/*
 * @Author: Chinoms Ugwuanya
 * @Twitter: https://twitter.com/chynomz
 */

require'inc/header.php';
require 'inc/sidebar.php';
require 'inc/functions.php';
denyAccess();

//fetch parents' info to pre-populate dropdown list when adding student
$checkParents = "SELECT * FROM users";
$parents = mysqli_query($conString, $checkParents);

//fetch all classes in database to pre-polutae dropdown list when adding student
$checkClasses = "SELECT * FROM grade ORDER BY id DESC";
$classes = mysqli_query($conString, $checkClasses);


?>
<!-- =============================================== -->

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Admissions 

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
                <h3 class="box-title">Add Students</h3> &nbsp; &nbsp; 

                <div class="box-tools pull-right">
                    <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
                        <i class="fa fa-minus"></i></button>
                    <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
                        <i class="fa fa-times"></i></button>
                </div>
            </div>




            <div class="box-body">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <form name="addstud" method="POST" enctype="multipart/form-data" action="process/enrollStudents.php">
                            <label>First Name</label>
                            <input type="text" class="form-control select2" style="width: 100%;" name="fname" required="required">

                            <label>Middle Name</label>
                            <input type="text" class="form-control select2" style="width: 100%;" name="mname" required="required">

                            <label>Surname</label>
                            <input type="text" class="form-control select2" style="width: 100%;" name="sname" required="required">


                            <label>Gender</label>
                            <input list="gend" style="width: 100%;"name="gender">
                            <datalist id="gend">
                                <option value="Male">Male</option>
                                <option value="Female">Female</option>
                            </datalist>

                            <label>Blood Group</label>
                            <input type="text" style="width: 100%;" name="bgroup" required="required">

                            <label>Nationality</label>
                            <input type="text" style="width: 100%;" name="nationality" required="required">

                            <label>Religion</label>
                            <input type="text" style="width: 100%;" name="religion" required="required">
                            <label>Passport Photo</label>
                            <input type="file" name="passp" required="required" style="width: 100%;" class="form-control">

                        </div>
                        <!-- /.form-group -->

                        <!-- /.form-group -->
                    </div>
                    <!-- /.col -->
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Parent</label>
                            <input list="par" style="width: 100%;" name="parent">
                            <datalist id="par">

                                <?php
                                while ($getParents = mysqli_fetch_assoc($parents)) {
                                    echo "<option value = " . $getParents['phonenum'] . " >" . $getParents['fname'] . " " . $getParents['sname'] . "</option>";
                                }
                                ?>

                            </datalist>
                            <label>Date of birth</label>
                            <input type="text" class="" style="width: 100%;" name="ddob" required="required">
                            <label>Month of Birth</label>
                            <input type="text" class="" style="width: 100%;" name="mmob" required="required">
                            <label>Year of Birth</label>
                            <input type="text" class="" style="width: 100%;" name="yyob" required="required">

                            <label>Weight</label>
                            <input type="text" class="" style="width: 100%;" name="weight" required="required" placeholder="Be sure to add the 'kg' suffix ">
                            
                            <label>Height</label>
                            <input type="text" class="" style="width: 100%;" name="height" required="required" placeholder="Must be in ft/in. Eg.: 3.8ft or 4 ft.">
                            
                            <label>Class</label>
                            <select name="classes" style="width: 100%">
                                <option value="">----------Select One----------</option>
                                 <?php
                                while ($getClasses = mysqli_fetch_assoc($classes)) {
                                $grade=$getClasses['grade'];
                                    echo "<option value ='" . $grade . "' >" . $getClasses['grade'] .  "</option>";
                                }
                                ?>
                            </select>
                            
                            <label>Home Language</label>
                            <input type="text" class="" style="width: 100%;" name="homelang" required="required" placeholder="Eg.: Hausa, Ikwerre, Tiv, etc">

                            
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

          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
              <i class="fa fa-minus"></i></button>
            <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
              <i class="fa fa-times"></i></button>
          </div>
        </div>
       
      
          
        
          
          
          
          
         <div class="box-body">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            
                              <div class="form-group">
                                   <p><b>1st Choice</b></p>
         <label>Full Name</label>
         <input type="text" maxlength="25" class="form-control select2" style="width: 100%;" name="icename" required="required">
 
         <label>Relationship</label>
         <input type="text" maxlength="15" class="form-control select2" style="width: 100%;" name="icerel" required="required">
 
          <label>Phone Number</label>
          <input type="text" maxlength="12" class="form-control select2" style="width: 100%;" name="icephone" required="required">
         
     
 
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
         <input type="text" maxlength="25" class="form-control select2" style="width: 100%;" name="icename2" required="required">
 
         <label>Relationship</label>
         <input type="text" maxlength="15" class="form-control select2" style="width: 100%;" name="icerel2" required="required">
 
          <label>Phone Number</label>
         <input type="text" maxlength="12" class="form-control select2" style="width: 100%;" name="icephone2" required="required">
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