<?php
require 'inc/header.php';
require 'inc/sidebar.php';
#$userID = $profileData['phonenum'];
//Fetch student info

if (empty($_GET['regNum'])) {
    ?>
    <script>window.alert('Student ID not provided. Try again.'); window.history.back();</script>  
    <?php
    die();
}
$regNum = strip_tags($_GET['regNum']);

$checkStudent = "SELECT * FROM students WHERE realRegNum = '$regNum'";
$studentQuery = mysqli_query($conString, $checkStudent);
$studentData = mysqli_fetch_assoc($studentQuery);
$regNum = $studentData['realRegNum'];

##Check if child being viewed is owned by the parent or in the teacher's class.
if ($login_session != $studentData['parentID'] && $profileData['priv'] < 2) {
    ?>
    <script>window.alert('The child whose profile you\'re trying to view seems not to be yours.'); window.history.back();</script>    
    <?php
    die();
}

$studentData['passport'] = str_replace('..', "", $studentData['passport']);
$studentAge = date('Y') - $studentData['yyob'];

$parentID = $studentData['parentID'];

$getParent = "SELECT * FROM users WHERE phoneNum = '$parentID'";
$parentQuery = mysqli_query($conString, $getParent) or die(mysqli_error($conString));
$parentData = mysqli_fetch_assoc($parentQuery);



//The following is intended to fetch teacher info so messages can be sent from parent to teacher.
$childClass = $studentData['grade'];
$getTeacherInfo = "SELECT teacherOne, teacherTwo FROM grade WHERE grade = '$childClass'";
$teacherInfoQuery = mysqli_query($conString, $getTeacherInfo) or die(mysqli_error($conString));
$teacherInfo = mysqli_fetch_array($teacherInfoQuery);
$teacherOne = $teacherInfo['teacherOne'];
$teacherTwo = $teacherInfo['teacherTwo'];

if ($profileData['priv'] > 1) {
    $teacherOne = $studentData['parentID'];
}

if (empty($teacherOne)) {
    $teacherOne = "NULL";
}
if (empty($teacherTwo)) {
    $teacherTwo = "NULL";
}



$feesString = "SELECT fees FROM grade WHERE grade = '$childClass'";
$queryFees = mysqli_query($conString, $feesString);
$fees = mysqli_fetch_array($queryFees);
$childFees = $fees['fees'];
//echo $childFees;
?>


<div class="wrapper">

    <!-- Left side column. contains the logo and sidebar -->

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                Student Profile
            </h1>

            <?php
            if ($priv > 1) {
                echo '<a href="editStudent.php?regNum=' . $regNum . '" style="color:white"><button class="btn btn-primary">Edit Student Details</button></a>';

                echo '<form enctype="multipart/form-data" method="POST" action="process/profilePic.php"><br><input style="width:220px" class="pull-left form-control"'
                . ' type="file" name="passp">'
                        . '<input type="hidden" value="'.$regNum.'" name="regNum">'
                        . ' <span class="input-group-btn"><input style="" class="btn btn-primary" type="submit" value="Update Passport" name="submit"></span>'
                        . '</form>';
            }
            ?>


        </section>

        <!-- Main content -->
        <section class="content">

            <div class="row">
                <div class="col-md-4">

                    <!-- Profile Image -->
                    <div class="box box-primary">
                        <div class="box-body box-profile">
                            <img class="profile-user-img img-responsive img-circle" src="<?php echo $baseURL . "/" . $parentData['passport']; ?>" alt="User profile picture">

                            <h3 class="profile-username text-center"><?php echo $parentData['fname'] . " " . $parentData['sname']; ?></h3>


                            <ul class="list-group list-group-unbordered">
                                <li class="list-group-item">
                                    <b>Phone number</b> <a class="pull-right"><?php echo $parentData['phonenum']; ?></a>
                                </li>
                                <li class="list-group-item">
                                    <b>Email address</b> <a class="pull-right"><?php echo $parentData['email'] ?></a>
                                </li>
                                <li class="list-group-item">
                                    <b>Address line 1</b> <a class="pull-right"><?php echo $parentData['lineone'] ?></a>
                                </li>
                                <li class="list-group-item">
                                    <b>Address line 2</b> <a class="pull-right"><?php echo $parentData['linetwo'] ?></a>
                                </li>
                                <li class="list-group-item">
                                    <b>Address line 3</b> <a class="pull-right"><?php echo $parentData['linethree'] ?></a>
                                </li>

                            </ul>


                            <ul class="list-group list-group-unbordered">
                                <li class="list-group-item">
                                    <div class="panel box box-primary">
                                        <div class="box-header with-border">
                                            <h4 class="box-title">
                                                <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne">
                                                    Send Message <small>
                                                        <?php
                                                        if ($profileData['priv'] > 1) {
                                                            echo 'to the parent(s)';
                                                        } else {
                                                            echo 'to the teacher(s)';
                                                        }
                                                        ?>
                                                    </small>
                                                </a>
                                            </h4>
                                        </div>
                                        <div id="collapseOne" class="panel-collapse collapse in">
                                            <div class="box-body">
                                                <form method="POST" action="process/sendMessage.php">
                                                    <input type="text" name="subject" placeholder="Subject" style="width:100%" class="form-control">
                                                    <br>
                                                    <textarea name="msgBody" rows="5" style="width:100%" class="form-control">Message goes here...
                                                    </textarea>

                                                    <input type="hidden" value="<?php echo $childClass; ?>" name="childClass">
                                                    <input type="hidden" value="<?php echo $teacherOne; ?>" name="teacherOne">
                                                    <input type="hidden" value="<?php echo $teacherTwo; ?>" name="teacherTwo">
                                                    <input type="hidden" value="<?php echo $profileData['phonenum']; ?>" name="userID">

                                                    <input type="hidden" value="<?php echo $profileData['fname']; ?>" name="fname">
                                                    <input type="hidden" value="<?php echo $profileData['sname']; ?>" name="sname">


                                                    <input type="submit" name="submit" value="Send Message" class="btn btn-success pull-right" style="margin-top: 30px">
                                                </form>
                                            </div>
                                        </div>
                                    </div>  
                                </li>
                            </ul>
                        </div>
                        <!-- /.box-body -->
                    </div>
                    <!-- /.box -->



                </div>
                <!-- /.col -->
                <div class="col-md-8">
                    <div class="nav-tabs-custom">
                        <ul class="nav nav-tabs">
                            <li class="active"><a href="#activity" data-toggle="tab">General Info</a></li>
                            <li><a href="#timeline" data-toggle="tab">Fees Payments and Notes</a></li>
                            <li><a href="#reports" data-toggle="tab">Report Cards</a></li>
                            <li><a href="#downloads" data-toggle="tab">Downloads (<small>Assignments and CA</small>)</a></li>
                            <!--li><a href="#settings" data-toggle="tab">Settings</a></li-->
                        </ul>
                        <div class="tab-content">
                            <div class="active tab-pane" id="activity">
                                <!-- Post -->
                                <div class="box box-primary">
                                    <div class="box-body box-profile">
                                        <img class="profile-user-img img-responsive img-circle" src="<?php echo $baseURL . $studentData['passport'] ?>" alt="User profile picture">

                                        <h3 class="profile-username text-center"><?php echo $studentData['fname'] . " " . $studentData['lname']; ?></h3>

                                        <p class="text-muted text-center"><?php echo $studentData['realRegNum'] ?></p>

                                        <ul class="list-group list-group-unbordered">
                                            <li class="list-group-item">
                                                <b>Age</b> <a class="pull-right"><?php echo $studentAge; ?></a>
                                            </li>
                                            <li class="list-group-item">
                                                <b>Height</b> <a class="pull-right"><?php echo $studentData['height'] ?></a>
                                            </li>
                                            <li class="list-group-item">
                                                <b>Weight</b> <a class="pull-right"><?php echo $studentData['weight'] ?></a>
                                            </li>
                                            <li class="list-group-item">
                                                <b>Gender</b> <a class="pull-right"><?php echo $studentData['gender'] ?></a>
                                            </li>
                                            <li class="list-group-item">
                                                <b>Class</b> <a class="pull-right"><?php echo $studentData['grade'] ?></a>
                                            </li>
                                            <li class="list-group-item">
                                                <b>Blood group</b> <a class="pull-right"><?php echo $studentData['bloodGroup'] ?></a>
                                            </li>
                                            <li class="list-group-item">
                                                <b>Nationality</b> <a class="pull-right"><?php echo $studentData['nationality'] ?></a>
                                            </li>
                                            <li class="list-group-item">
                                                <b>Religion</b> <a class="pull-right"><?php echo $studentData['religion'] ?></a>
                                            </li>
                                            <li class="list-group-item">
                                                <b>Date of birth</b> <a class="pull-right"><?php echo $studentData['ddob'] . "/" . $studentData['mmob'] . "/" . $studentData['yyob']; ?></a>
                                            </li>
                                            <li class="list-group-item">
                                                <b>Home Language</b> <a class="pull-right"><?php echo $studentData['homelang'] ?></a>
                                            </li>



                                            <div class="box box-primary">
                                                <div class="box-body box-profile">

                                                    <h3 class="profile-username text-center">First Contact Person</h3>

                                                    <ul class="list-group list-group-unbordered">
                                                        <li class="list-group-item">
                                                            <b>Name</b> <a class="pull-right"><?php echo $studentData['icename'] ?></a>
                                                        </li>
                                                        <li class="list-group-item">
                                                            <b>Relationship</b> <a class="pull-right"><?php echo $studentData['icerel']; ?></a>
                                                        </li>
                                                        <li class="list-group-item">
                                                            <b>Contact</b> <a class="pull-right"><?php echo $studentData['icephone'] ?></a>
                                                        </li>

                                                    </ul>

                                                </div>
                                                <!-- /.box-body -->
                                            </div>

                                            <div class="box box-primary">
                                                <div class="box-body box-profile">

                                                    <h3 class="profile-username text-center">Second Contact Person</h3>

                                                    <ul class="list-group list-group-unbordered">
                                                        <li class="list-group-item">
                                                            <b>Name</b> <a class="pull-right"><?php echo $studentData['icename2'] ?></a>
                                                        </li>
                                                        <li class="list-group-item">
                                                            <b>Relationship</b> <a class="pull-right"><?php echo $studentData['icerel2']; ?></a>
                                                        </li>
                                                        <li class="list-group-item">
                                                            <b>Contact</b> <a class="pull-right"><?php echo $studentData['icephone2'] ?></a>
                                                        </li>

                                                    </ul>

                                                </div>
                                                <!-- /.box-body -->
                                            </div>




                                    </div>
                                    <!-- /.box-body -->
                                </div>
                                <!-- /.post -->
                            </div>
                            <!-- /.tab-pane -->
                            <div class="tab-pane" id="timeline">
                                <div class="box box-primary">
                                    <div class="box-body box-profile">



                                        <div>
                                            <?php
                                            if ($profileData['priv'] > 2) {
                                                echo "<form action='process/sendNote.php'method='POST'>"
                                                . "<input type='text' placeholder='This is just for brief notes related to payment of school fees.' style='width:100%' name='note'"
                                                . "class='form-control'><br>";
                                                echo '<input type="hidden" value="' . $regNum . '" name="regNum">';
                                                echo '<input type="hidden" value="' . $parentID . '" name="parentID">';
                                                echo "<input type='submit' class='btn btn-lg btn-success pull-right'name='sendNote'><br>";
                                                echo '</form>';
                                            }
                                            echo "</div><br><br>";
                                            if ($studentData['feesPaid'] == 0) {
                                                echo "<button class = 'btn btn-lg btn-danger pull-left' style = 'width:100%'><span class = 'fa fa-warning'></span> Fees unpaid</button>";

                                                if ($profileData['priv'] == 1) {
                                                    ?>

                                                    <script src="https://js.paystack.co/v1/inline.js"></script>
                                                    <div id="paystackEmbedContainer"></div>

                                                    <script>
        PaystackPop.setup({
            key: "pk_test_testkey",
            email: "<?php echo $parentData['email'] ?>",
            amount: "<?php echo $childFees; ?>",
            container: "paystackEmbedContainer",
            callback: function (response) {
                alert("Payment successful. transaction ref is " + response.reference);
                window.location = "<?php echo $baseURL."/process/paymentConfirmed.php?studentID=".$regNum; ?>"
            },
        });
                                                    </script>
                                                    <?php
                                                    }
                                                if($userPrivilege>2){
                                                echo '<a href=process/markAsPaid.php?studentID=' . $regNum . '>';
                                                echo "<br><button class = 'btn btn-lg btn-success pull-right' style = 'width:100%; padding-right:10px;padding-top:10px'><span class = 'fa fa-check' style='color:white;'> Mark as paid</span></buton>";
                                                echo '</a>';}
                                            } else {
                                                echo "<button class = 'btn btn-lg btn-success pull-right' style = 'width:100%'>Fees Paid</buton>";
                                            }
                                            ?>
                                        </div>
                                        <br>

                                        <!-- /.box-body -->
                                        <strong>Notes</strong>
                                        <?php
                                        $fetchNotes = "SELECT * FROM notes WHERE recipient = '$parentID' AND refchild = '$regNum'";
                                        $getNotes = mysqli_query($conString, $fetchNotes);
#$fetchNotes = mysqli_fetch_assoc($fetchNotes);

                                        if (mysqli_affected_rows($conString) == 0) {
                                            echo '<strong>No notes here</strong>';
                                        } else {
                                            while ($notesArray = mysqli_fetch_array($getNotes)) {
                                                echo '                 
                                            
                                            
                                                <blockquote>
                                                    <p>' . $notesArray["note"] . '</p>
                                                    
                                                </blockquote>';
                                                if ($profileData['priv'] > 1) {

                                                    echo
                                                    '<a href=process/deleteNote.php?noteID=' . $notesArray["id"] . '> <button class="btn btn-danger">Delete Note</button></a> '
                                                    ;
                                                }
                                            }
                                        }
                                        ?>




                                    </div>



                                </div>

                                <div class="tab-pane" id="reports">
                                    <div class="box box-primary">
                                        <div class="box-body box-profile">

                                            <h3 class="profile-username text-center">Report cards</h3>

                                            <div class="box">
                                                <div class="box-header">

                                                </div>
                                                <!-- /.box-header -->
                                                <div class="box-body no-padding">
                                                    <table class="table table-striped">
                                                        <tr>
                                                            <th style="width: 10px">#</th>
                                                            <th>Term</th>
                                                            <th>Year</th>
                                                            <th style="width: 200px">File</th>
                                                             <?php
                                                            if($priv > 1){
                                                                    echo "<th>Action</th>";
                                                                }
                                                            ?>
                                                        </tr>

                                                        <?php
                                                        $fetchReportCards = "SELECT * FROM reportcards WHERE regNum = '$regNum'";
                                                        $queryReportCards = mysqli_query($conString, $fetchReportCards);
                                                        if (mysqli_num_rows($queryReportCards) > 0) {
                                                            while ($reportData = mysqli_fetch_array($queryReportCards)) {
                                                                echo "<tr>";
                                                                echo "<td>" . $reportData['id'] . "</td>";
                                                                echo "<td>" . $reportData['term'] . "</td>";
                                                                echo "<td>" . $reportData['year'] . "</td>";
                                                                echo "<td><a href='" . str_replace("..", "", $baseURL . $reportData['fileURL']) . "'<button class='btn bg-maroon'>Download <span class='fa fa-cloud-download'></button></td>";
                                                                if($priv > 1){
                                                                    $fileURL = str_replace("..", "", substr($reportData['fileURL'], 3));
                                                                    $rowID = $reportData['id']; 
                                                                    echo "<td><a href='delFile.php?fileID=".$fileURL."&&rowID=".$rowID."'><button class='btn btn-danger'><span class='fa fa-remove'></span> Delete file</button></a></td>";
                                                                }
                                                            }
                                                        } else {
                                                            echo "<h3 class='box-title'>Couldn't fetch any results.</h3>";
                                                        }
                                                        ?>


                                                    </table>
                                                </div>
                                                <!-- /.box-body -->
                                            </div>
                                            <?php
                                            if ($userPrivilege >=2) {
                                                echo"<div class='box-body box-profile'>
                      
                                <b style='width: 30%'>Upload Report Card</b> 
                                <form action='process/uploadReportCard.php' enctype='multipart/form-data' method='POST'>
                                <input type='file' name='reportCard' style='width: 100%' class='form-control'>
                                <br>
                                <input type='hidden' value='" . $regNum . "' name='regNum'>
                                <button name='saveReportCard' class='btn btn-success pull-right'>Upload <span class='fa fa-upload' style='width: 40%'></span></button>
                      </form>
                          
                                            </div>  ";}
                                       ?>         </div>
                                                <!--/.box-body -->
                                                </div>



                                                </div>
                                                <!--/.tab-pane -->



                                                <div class = "tab-pane" id = "downloads">
                                                <div class = "box box-primary">
                                                <div class = "box-body box-profile">

                                                <h3 class = "profile-username text-center">Assignments, CA, etc.</h3>

                                                <div class = "box">
                                                <div class = "box-header">

                                                </div>
                                                <!--/.box-header -->
                                                <div class = "box-body no-padding">
                                                <table class = "table table-striped">
                                                <tr>
                                                <th style = "width: 10px">#</th>
                                                <th>Title</th>
                                                <!--th>Year</th-->
                                                <th style = "width: 200px">File</th>
                                                 <?php
                                                if($priv > 1){
                                                                    echo "<th>Action</th>";
                                                                }
                                                            ?>
                                                </tr>

                                                <?php
                                                $fetchDownloads = "SELECT * FROM downloads WHERE recipient = '$regNum'";
                                                $queryDownloads = mysqli_query($conString, $fetchDownloads);
                                                if (mysqli_num_rows($queryDownloads) > 0) {
                                                    while ($downloadData = mysqli_fetch_array($queryDownloads)) {
                                                        echo "<tr>";
                                                        echo "<td>" . $downloadData['id'] . "</td>";
                                                        echo "<td>" . $downloadData['title'] . "</td>";
                                                        #echo "<td>" . $downloadData['fileURL'] . "</td>";
                                                        echo "<td><a href='" . str_replace("..", "", $baseURL . $downloadData['fileURL']) . "'<button class='btn bg-maroon'>Download <span class='fa fa-cloud-download'></button></td>";
                                                    if($priv > 1){
                                                                    $filePath = str_replace("..", "", substr($downloadData['fileURL'], 3));
                                                                    $rowId = $downloadData['id']; 
                                                                    echo "<td><a href='delFile.php?fileID=".$filePath."&&rowID=".$rowId."'><button class='btn btn-danger'><span class='fa fa-remove'></span> Delete file</button></a></td>";
                                                                }
                                                    }
                                                } else {
                                                    echo "<h3 class='box-title'>Couldn't fetch any results.</h3>";
                                                }
                                                ?>


                                                </table>
                                            </div>


                                            <!-- /.box-body -->
                                        </div>
                                        <?php
                                        if ($userPrivilege >= 2) {

                                            echo '<div class="col-md-12" style="height:auto" style="width:100%">
                    <div class="box box-primary">
                        <div class="box-body box-profile">
                      
                                <b style="width: 100%">Upload file <small>Continuous asessment, homework, weekly reports, etc.</small></b> 
                                <form action="process/uploadReportCard.php" enctype="multipart/form-data" method="POST">
                                <br>
                                 <label for="title">Title</label>
                                <input type="text" name="title" class="form-control">
                                <br>
                                <input type="file" name="otherFile" style="width: 100%" class="form-control">
                                <br>
                               
                                <input type="hidden" value="' . $regNum . '" name="regNum">
                                <button name="sendFile" class="btn btn-success pull-right">Upload <span class="fa fa-upload" style="width: 40%"></span></button>
                      </form>
                            </div>   
                    </div>
                </div>';
                                        }
                                        ?>
                                    </div>
                                    <!-- /.box-body -->

                                </div>



                            </div>             



                        </div>
                        <!-- /.tab-content -->
                    </div>
                    <!-- /.nav-tabs-custom -->
                </div>


                <!-- /.col -->

        </div>

    </div>
    <!-- /.row -->

    </section>
    <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->


    <!-- Control Sidebar -->
    <!-- Add the sidebar's background. This div must be placed
         immediately after the control sidebar -->
    <div class="control-sidebar-bg"></div>
    </div>
    <!-- ./wrapper -->


    <?php
    require 'inc/footer.php';
    ?>