<?php
require('inc/header.php');
require 'inc/sidebar.php';

if(!isset($_GET['id'])){
    ?>
<script>window.alert('Message identifier missing. Please try again');window.history.back();</script>
<?php
die();
}else{
    $messageID = $_GET['id'];
    $messageQuery = "SELECT * FROM messages WHERE id = '$messageID'";
    $queryMessage = mysqli_query($conString, $messageQuery);
    $messageData = mysqli_fetch_assoc($queryMessage);
}

?>

<!-- Left side column. contains the logo and sidebar -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Mailbox
           
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Mailbox</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-md-3">
                <a href="<?php echo $baseURL . '/mailbox.php' ?>" class="btn btn-primary btn-block margin-bottom">Back to Inbox</a>

                <div class="box box-solid">
                    <div class="box-header with-border">
                        <h3 class="box-title">Folders</h3>

                        <div class="box-tools">
                            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                            </button>
                        </div>
                    </div>
                    <div class="box-body no-padding">
                        <ul class="nav nav-pills nav-stacked">
                            <li class="active"><a href="<?php echo $baseURL . '/mailbox.php'; ?>"><i class="fa fa-inbox"></i> Inbox

                                    <li><a href="<?php echo $baseURL . '/sentMessages.php'; ?>"><i class="fa fa-envelope-o"></i> Sent</a></li>

                        </ul>
                    </div>
                    <!-- /.box-body -->
                </div>
                <!-- /. box -->

            </div>  <!-- /.col -->
            <div class="col-md-9">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">Inbox</h3>

                        <div class="box-tools pull-right">
                            <div class="has-feedback">
                                <input type="text" class="form-control input-sm" placeholder="Search Mail">
                                <span class="glyphicon glyphicon-search form-control-feedback"></span>
                            </div>
                        </div>
                        <!-- /.box-tools -->
                    </div>
                    <!-- /.box-header -->
                     <div class="box-body no-padding">
              <div class="mailbox-read-info">
                <h3><?php echo $messageData['subject'] ?></h3>
                <h5>From: <?php echo $messageData['senderName'] ?></h5>
                  <span class="mailbox-read-time pull-right"><?php echo $messageData['timestamp'] ?></span></h5>
              </div>
              <!-- /.mailbox-read-info -->
              <!--div class="mailbox-controls with-border text-center">
                <div class="btn-group">
                  <button type="button" class="btn btn-default btn-sm" data-toggle="tooltip" data-container="body" title="Delete">
                    <i class="fa fa-trash-o"></i></button>
                  <button type="button" class="btn btn-default btn-sm" data-toggle="tooltip" data-container="body" title="Reply">
                    <i class="fa fa-reply"></i></button>
                  <button type="button" class="btn btn-default btn-sm" data-toggle="tooltip" data-container="body" title="Forward">
                    <i class="fa fa-share"></i></button>
                </div>
             
                <button type="button" class="btn btn-default btn-sm" data-toggle="tooltip" title="Print">
                  <i class="fa fa-print"></i></button>
              </div-->
              <!-- /.mailbox-controls -->
              <div class="mailbox-read-message">
               <?php echo $messageData['body'] ?>

             
              </div>
              <!-- /.mailbox-read-message -->
            </div> <!-- /.box-body -->
                    <div class="box-footer no-padding">
                        
                            <!-- /.pull-right -->
                        </div>
                    </div>
                </div>
                <!-- /. box -->
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->

<?php
require 'inc/footer.php';
?>