<!-- /.box-header --><?php
require 'inc/header.php';
require 'inc/sidebar.php';
require 'inc/functions.php';
denyAccess();
?>


<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
           Add new users
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
                        <h3 class="box-title">Teachers/Parents</h3>

                        <div class="box-tools pull-right">
                            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                            <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-remove"></i></button>
                        </div>
                    </div>
                    <div class="box-body">
                        <div class="row">
                            <div class="col-md-6">
                                <form name="newUser" action="process/newUser.php" enctype="multipart/form-data" method ="POST">
                                <div class="form-group">
                                    <label>First name</label>
                                    <input type="text" class="form-control" name="fname">
                                </div>
                                <!-- /.form-group -->
                                <div class="form-group">
                                    <label>Surname</label>
                                    <input type="text" name="sname" class="form-control">
                                </div>
                                <!-- /.form-group -->
                                
                                 <div class="form-group">
                                    <label>Phone number</label>
                                    <input type="text" name="phonenum" class="form-control">
                                </div>
                                <!-- /.form-group -->
                                 <div class="form-group">
                                    <label>Email address</label>
                                    <input type="text" name="email" class="form-control">
                                </div>
                                <!-- /.form-group -->
                                 <div class="form-group">
                                    <label>Password</label>
                                    <input type="text" name="pword" class="form-control">
                                </div>
                                <!-- /.form-group -->
                                 <div class="form-group">
                                    <label>Privilege</label>
                                    <select type="select" name="priv" class="form-control">
                                        <option value="1">Parent</option>
                                        <option value="2">Teacher</option>
                                        <option value="3">Admin</option>
                                    </select>
                                </div>
                                <!-- /.form-group -->
                                <div class="form-group">
                                    <label>Profile photo</label>
                                    <input type="file" name="passp" class="form-control" required="required">
                                </div>
                                  <div class="form-group">
                                    <label>Gender</label>
                                    <select name="gender" class="form-control">
                                        <option value="Male">Male</option>
                                        <option value="Female">Female</option>
                                    </select>
                                </div>
                                <!-- /.form-group -->
                                
                            </div>
                            
                            <!-- /.col -->
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Address line 1</label>
                                    <input type="text" name="addyOne" class="form-control">
                                </div>
                                <!-- /.form-group -->
                                 <div class="form-group">
                                    <label>Address line 2</label>
                                    <input type="text" name="addyTwo" class="form-control">
                                </div>
                                <!-- /.form-group -->
                                 <div class="form-group">
                                    <label>Address line 3</label>
                                    <input type="text" name="addyThree" class="form-control">
                                </div>
                                <!-- /.form-group -->
                                 <div class="form-group">
                                    <label>Qualification</label>
                                    <input type="text" name="qual" class="form-control">
                                </div>
                                <!-- /.form-group -->
                               
                                 <div class="form-group">
                                    <label>Date of birth (dd)</label>
                                    <input type="number" name="ddob" class="form-control" style="width:" maxlength="2" max="31">
                                   
                                </div>
                                <!-- /.form-group -->
                                
                                 <div class="form-group">
                                    <label>Date of birth (mm)</label>
                                    <input type="number" name="mmob" class="form-control" style="width:" maxlength="2" max="12">
                                </div>
                                <!-- /.form-group -->
                                 <div class="form-group">
                                    <label>Date of birth (yy)</label>
                                    <input type="text" name="yyob" class="form-control" style="width:" maxlength="4">
                                </div>
                                    <input type="submit" name="addUser" class="btn btn-success btn-lg pull-right"> 
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