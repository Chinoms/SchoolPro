 <?php
          
            ?>
  <!-- Left side column. contains the logo and sidebar -->
  <aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->
      <div class="user-panel">
        <div class="pull-left image">
          <img src="<?php echo $baseURL."/".$imgLink; ?>" class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">
          <p><?php echo $profileData['fname'] ." ".$profileData['sname']; ?></p>
          <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
        </div>
      </div>
      <!-- search form -->
      
      <?php checkPrivilege(); ?>
      <!-- /.search form -->
      <!-- sidebar menu: : style can be found in sidebar.less -->
   
    </section>
    <!-- /.sidebar -->
  </aside>
