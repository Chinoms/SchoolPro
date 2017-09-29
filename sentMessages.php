<?php
require('inc/header.php');
require 'inc/sidebar.php';
;
?>

<!-- Left side column. contains the logo and sidebar -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Sent
            
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Sent Messages</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-md-3">
                <a href="<?php echo $baseURL.'/newMessage.php' ?>" class="btn btn-primary btn-block margin-bottom">Compose</a>

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
                            <li class="active"><a href="<?php echo $baseURL.'/mailbox.php'; ?>"><i class="fa fa-inbox"></i> Inbox
                                    
                            <li><a href="<?php echo $baseURL.'/sentMessages.php'; ?>"><i class="fa fa-envelope-o"></i> Sent</a></li>
                            
                        </ul>
                    </div>
                    <!-- /.box-body -->
                </div>
                <!-- /. box -->
               
            </div>
            <!-- /.col -->
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
                       
                        <div class="table-responsive mailbox-messages">
                            <table class="table table-hover table-striped">
                                <tbody>
                                    <?php
                                   if (isset($_GET["page"])) { $page  = $_GET["page"]; } else { $page=1; };
				$startFrom = ($page-1) * 5;
			
                                    
                                    




                                    //fetch messgage info
                                    $checkMessage = "SELECT * FROM messages WHERE sender = '$userID' ORDER BY timestamp DESC LIMIT $startFrom, 5";
                                    $messageQuery = mysqli_query($conString, $checkMessage) or die('errant query');
                                    //$messageData = mysqli_fetch_array($messageQuery);
                                    //$senderName = $messageData['sender'];


                                    while ($messageData = mysqli_fetch_array($messageQuery)) {
                                        if(empty($messageData)){
                                        echo 'No messages here.';
                                    }
                                    echo ' <tr style="width">
                                        <td class="">' . $messageData['senderName'] . '</td>
                                        <td class=""><b><a href="' . $baseURL . '/' . 'readMessage.php?id=' . $messageData['id'] . '">' . $messageData['subject'] . '</a></b>
                                        </td>
                                        <td class="">' . substr($messageData['body'], 0, 15) . ' ...
                                        </td>
                                        <td class="">' . $messageData['timestamp'] . '</td>
                                    </tr>';
                                    }
                                    
                             
                                    ?>
                                    

                                </tbody>
                            </table>
                          
                            <!-- /.table -->
                        </div>
                        <!-- /.mail-box-messages -->
                    </div>
                    <!-- /.box-body -->
                    <div class="box-footer no-padding">
                        <div class="mailbox-controls">
                        <?php
                                    $countMessages = "SELECT COUNT(id) FROM messages WHERE sender = '$userID'";
                                    $countQuery = mysqli_query($conString, $countMessages);
                                    $messageCountRows = mysqli_fetch_row($countQuery);
                                    $totalRecords = $messageCountRows[0];
                                    $totalPages = ceil($totalRecords / 5);
                                    echo '<ul class="pagination pull-right">';
                                    for ($i = 1; $i <= $totalPages; $i++) {
                                        echo "<li class='paginate_button'><a href='sentMessages.php?page=" . $i . "' >" . $i . "</a> </li>";
                                    };
                                       echo "</ul>";


                                    if ($_SERVER['PHP_SELF'] = $totalPages) {
                                        echo "<a href='sentMessages.php?page=$totalPages'></a> "; // Goto last page
                                    } else {
                                        //echo "LAST";
                                    }
                                    ?>
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