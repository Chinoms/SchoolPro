<?php  global $baseURL; ?>
      <!-- /.search form -->
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu">
        <li class="header">MAIN NAVIGATION</li>
        <li class="active treeview">
          <a href="#">
            <i class="fa fa-dashboard"></i> <span>Dashboard</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
            
          <ul class="treeview-menu">
            <li class="active"><a href="parentDashboard.php"><i class="fa fa-circle-o"></i> My Children</a></li>
            <li><a href="changePassword.php"><i class="fa fa-circle-o"></i> Change Password</a></li>
          </ul>
        </li>
        
        
        <li class="treeview">
        <a href="#">
            <i class="fa fa-envelope"></i> <span>Messaging</span>
            <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
            </span>
        </a>
        <ul class="treeview-menu">
            <li><a href="<?php echo $baseURL . '/mailbox.php'; ?>"><i class="fa fa-circle-o"></i> Inbox</a></li>
            <li class=""><a href="<?php echo $baseURL . '/sentMessages.php'; ?>"><i class="fa fa-circle-o"></i> Sent Messages</a></li>
            <li><a href="<?php echo $baseURL . '/newMessage.php'; ?>"><i class="fa fa-circle-o"></i> Compose</a></li>
        </ul>
    </li> 
            
            
            <li class="treeview">
        <a href="#">
            <i class="fa fa-bullhorn"></i> <span>Newsletters</span>
            <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
            </span>
        </a>
        <ul class="treeview-menu">
            <li><a href="<?php echo $baseURL . '/inboxNewsletter.php'; ?>"><i class="fa fa-circle-o"></i> Inbox</a></li>
           
            
        </ul>
    </li>
            
          <ul class="treeview-menu">
              <li><a href="<?php echo $baseURL.'/mailbox.php'; ?>"><i class="fa fa-circle-o"></i> Inbox</a></li>
            <li class=""><a href="<?php echo $baseURL.'/sentMessages.php'; ?>"><i class="fa fa-circle-o"></i> Sent Messages</a></li>
            <li><a href="<?php echo $baseURL.'/newMessage.php'; ?>"><i class="fa fa-circle-o"></i> Compose</a></li>
          </ul>
        </li>
             </ul>
 