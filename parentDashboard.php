<?php
require 'inc/header.php';
require 'inc/sidebar.php';
require 'inc/functions.php';
$userID = $profileData['phonenum'];

function userLevel() {
    global $priv;
    global $userID;
    if ($priv == 1) {
        $getMyKids = "SELECT * FROM students WHERE parentID = '$userID'";
    } elseif ($priv == 2) {
        //$priv=$profileData['priv'];
        $getMyKids = "SELECT * FROM students, grade WHERE students.grade=grade.grade AND teacherOne='$userID' OR teacherTwo='$userID'";
    } elseif ($priv == 3) {
        #$priv=$profileData['priv'];
        $getMyKids = "SELECT * FROM students";
    }
    return $getMyKids;
}

$kidsQuery = mysqli_query($conString, userLevel()) or die(mysqli_error($conString));
?>

<div class="content-wrapper">
    <!-- Content Header (Page header) -->


    <!-- Main content -->
    <section class="content">

        <!-- /.row -->
        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title"><?php tableName(); ?></h3>

                        <div class="box-tools">
                            <div class="input-group input-group-sm" style="width: 150px;">
                                <!--input type="text" name="table_search" class="form-control pull-right" placeholder="Search"-->

                                <div class="input-group-btn">
                                  <!--button type="submit" class="btn btn-default"><i class="fa fa-search"></i></button-->
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body table-responsive no-padding">
                        <table class="table table-striped">
                            
<?php
if (!isset($_GET['cmd'])) {
echo "<th>Name</th>
                                <th>Class</th>
                                <th>Action</th>";
    while ($kidsData = mysqli_fetch_array($kidsQuery)) {
        $kidRegNum = $kidsData['realRegNum'];
        echo '<tr>
                                

                            </tr>';
        echo "<tr>";
        echo "<td>" . $kidsData['fname'] . " " . $kidsData['lname'] . "</td>";
        echo "<td>" . $kidsData['grade'] . "</td>";
        echo "<td><a href='" . $baseURL . "/studentProfile.php?regNum=" . $kidRegNum . "'>" . "<button class='btn btn-lg bg-maroon'>" . "<span style='color:white;'><span class='fa fa-eye'></span>" . "View" . "</span></a></td>";
        echo '</tr>';

        //echo "$";
    }
}

if (isset($_GET['cmd']) && $_GET['cmd'] == "allStudents") {
    while ($kidsData = mysqli_fetch_array($kidsQuery)) {
        $kidRegNum = $kidsData['realRegNum'];

        echo "<tr>";
        echo "<td>" . $kidsData['fname'] . " " . $kidsData['lname'] . "</td>";
        echo "<td>" . $kidsData['grade'] . "</td>";
        echo "<td><a href='" . $baseURL . "/studentProfile.php?regNum=" . $kidRegNum . "'>" . "<button class='btn btn-lg bg-maroon'>" . "<span style='color:white;'><span class='fa fa-eye'></span>" . "View" . "</span></a></td>";
        echo '</tr>';
    }
} elseif(isset($_GET['cmd']) && $_GET['cmd'] == "allParents") {
    $getParents = mysqli_query($conString, "SELECT * FROM users WHERE priv=1");
    echo '     <tr>
                                <th>Name</th>
                                <th>Phone</th>
                                <th>Action</th>

                            </tr>';
    while($fetchParents=mysqli_fetch_array($getParents)){
   
       echo "<tr>";
        echo "<td>" . $fetchParents['fname'] . " " . $fetchParents['sname'] . "</td>";
        echo "<td>" . $fetchParents['phonenum'] . "</td>";
        echo "<td><a href='#'><button class='btn btn-lg bg-maroon'>" . "<span style='color:white;'><span class='fa fa-eye'></span>" . "View" . "</span></a></td>";
        echo '</tr>';
  
    }
        
    }elseif(isset($_GET['cmd']) && $_GET['cmd'] == "allMales") {
    $getParents = mysqli_query($conString, "SELECT * FROM students WHERE gender='male'");
    echo '     <tr>
                                <th>Name</th>
                                <th>Grade</th>
                                <th>Action</th>

                            </tr>';
    while($fetchParents=mysqli_fetch_array($getParents)){
   
       echo "<tr>";
        echo "<td>" . $fetchParents['fname'] . " " . $fetchParents['lname'] . "</td>";
        echo "<td>" . $fetchParents['grade'] . "</td>";
        echo "<td><a href='#'><button class='btn btn-lg bg-maroon'>" . "<span style='color:white;'><span class='fa fa-eye'></span>" . "View" . "</span></a></td>";
        echo '</tr>';
    }
    }elseif(isset($_GET['cmd']) && $_GET['cmd'] == "allFemales") {
    $getParents = mysqli_query($conString, "SELECT * FROM students WHERE gender='Female'");
    echo '     <tr>
                                <th>Name</th>
                                <th>Grade</th>
                                <th>Action</th>

                            </tr>';
    while($fetchParents=mysqli_fetch_array($getParents)){
   
       echo "<tr>";
        echo "<td>" . $fetchParents['fname'] . " " . $fetchParents['lname'] . "</td>";
        echo "<td>" . $fetchParents['grade'] . "</td>";
        echo "<td><a href='#'><button class='btn btn-lg bg-maroon'>" . "<span style='color:white;'><span class='fa fa-eye'></span>" ."View"."</span> ". "</a></td>";
        echo '</tr>';
  
    }
        
    }
    
    elseif(isset($_GET['cmd']) && $_GET['cmd'] == "allTeachers") {
    $getParents = mysqli_query($conString, "SELECT * FROM users WHERE priv='2'");
    echo '     <tr>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Action</th>

                            </tr>';
    while($fetchParents=mysqli_fetch_array($getParents)){
   
       echo "<tr>";
        echo "<td>" . $fetchParents['fname'] . " " . $fetchParents['sname'] . "</td>";
        echo "<td>" . $fetchParents['email'] . "</td>";
        echo "<td><a href='#'><button class='btn btn-lg bg-maroon'>" . "<span style='color:white;'><span class='fa fa-eye'></span>" ."View"."</span> ". "</a></td>";
        echo '</tr>';
  
    }
        
    }
    ?>

                            </table>
                        </div>
                        <!-- /.box-body -->
                    </div>
                    <!-- /.box -->
                </div>
            </div>
        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->


    <!-- Control Sidebar -->

    <div class="control-sidebar-bg"></div>
    </div>
    <!-- ./wrapper -->

    <?php
    require 'inc/footer.php';
    ?>