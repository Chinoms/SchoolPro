<?php
  require 'inc/header.php';
  require 'inc/sidebar.php';
  $userID = $profileData['phonenum'];
  
  function userLevel(){
      global $priv;
      global $userID;
  if($priv==1){
  $getMyKids = "SELECT * FROM students WHERE parentID = '$userID'";
  }
   elseif($priv==2){
       //$priv=$profileData['priv'];
  $getMyKids = "SELECT * FROM students, grade WHERE students.grade=grade.grade AND teacherOne='$userID' OR teacherTwo='$userID'";
  
   }
  
  elseif($priv==3){
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
                <h3 class="box-title">My Children</h3>

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
                <tr>
                  <th>Name</th>
                  <th>Class</th>
                  <th>Action</th>
                  
                </tr>
                <?php
                while($kidsData = mysqli_fetch_array($kidsQuery)){
                    $kidRegNum = $kidsData['realRegNum'];
                    
                    echo "<tr>";
                    echo "<td><input type='checkbox' value='".$kidRegNum."'>" . $kidsData['fname'] ." ".$kidsData['lname']."</td>";
                    echo "<td>" . $kidsData['grade'] ."</td>";
                    echo "<td><a href='".$baseURL."/studentProfile.php?regNum=".$kidRegNum."'>"  ."<button class='btn bg-maroon'>"."<span style='color:white' class='fa fa-eye'></span>"."<span style='color:white' >View</span>". "</a></td>";
                    echo '</tr>';
                
                    //echo "$";
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