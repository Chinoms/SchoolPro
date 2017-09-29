<?php
    require 'inc/header.php';
    require 'inc/sidebar.php';
    ?>

   <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Your Profile
        <small></small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> </a></li>
        <li><a href="#"></a></li>
        <li class="active"></li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">

      <!-- Default box -->
      <div class="box">
        <div class="box-header with-border">
          <h3 class="box-title">Change Password</h3>

          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
              <i class="fa fa-minus"></i></button>
            <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
              <i class="fa fa-times"></i></button>
          </div>
        </div>
        <div class="box-body">
         <div class="login-box-body">
                <p class="login-box-msg"></p>

                <form action="process/passwordChange.php" method="post">
                    <div class="form-group has-feedback">
                        <input type="password" name="passOne" class="form-control" placeholder="New Password" >
                        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                       <?php $userID = $profileData['phonenum']; ?>
                        <input type="hidden" value="<?php echo $userID; ?>" name="userID"> 
                    </div>
                    <div class="form-group has-feedback">
                        <input type="password" name="passTwo" class="form-control" placeholder="Repeat New Password" required>
                        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                    </div>
                    <div class="row">
                       
                        <!-- /.col -->
                        <div class="col-xs-4">
                            <input type="submit" name="submit" class="btn btn-primary btn-block btn-flat pull-right" value="Change password">
                        </div>
                        <!-- /.col -->
                    </div>

        </div>
        <!-- /.box-body -->
        <div class="box-footer">
          
        </div>
        <!-- /.box-footer-->
      </div>
      <!-- /.box -->

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
 
<?php
            require 'inc/footer.php';
            
  ?>