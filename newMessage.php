<?php
require 'inc/header.php';
require 'inc/sidebar.php';
require 'inc/functions.php';
?>

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Inbox

        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Sent Messages</li>
        </ol>
    </section>
    <div class="content">
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

            </div>


            <div class="col-md-9">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">Compose New Message</h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">  
                        <form name="newMessage" method="POST" action="process/sendMessage.php">
                        <div class="form-group">
                         
                                <!--input class="form-control" placeholder="To:"-->
                                <?php getRecipients(); ?>
                        </div>
                        <div class="form-group">
                            <input class="form-control" placeholder="Subject:" type="text" name="subject">
                        </div>
                        <div class="form-group">
                            <textarea id="compose-textarea" class="form-control" style="height: 250px" name="msgBody">
                     
                            </textarea>
                            <input type="hidden" value="<?php echo $profileData['phonenum']; ?>" name="userID">
                            <input type="hidden" value="NULL" name="teacherTwo">
                            <input type="hidden" value="<?php echo $profileData['fname']; ?>" name="fname">
                            <input type="hidden" value="<?php echo $profileData['sname']; ?>" name="sname">
                        </div>

                    </div>
                    <!-- /.box-body -->
                    <div class="box-footer">
                        <div class="pull-right">

                            <input type="submit" class="btn btn-primary" value="Send Message" name="submit">
                        </div>
                        <input type="button" class="btn btn-default" onclick="document.newMessage.reset();" value="Discard">
                        </form>
                    </div>
                    <!-- /.box-footer -->
                </div>
                <!-- /. box -->
            </div>
        </div>
    </div>
</div>


<?php
require 'inc/footer.php';
?>