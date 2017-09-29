<?php
/*
 * This file contains some functions. They are only created here, but called in the files where they are needed.
 */

function getRecipients() {
    #The function of this function is to fetch the recipients of messages
    #sent from the messaging module based on access levels.
    global $userPrivilege;
    global $conString;
    if ($userPrivilege == 3) {
        $checkParents = "SELECT * FROM users";
    }
    if ($userPrivilege == 2) {
        $checkParents = "SELECT * FROM users WHERE priv > 1";
    }
    echo 'Recipient
            <input list="par" style="width: 100%;" name="teacherOne" required>
                            <datalist id="par">';
//fetch users' info to pre-populate dropdown list when sending messages
    $parents = mysqli_query($conString, $checkParents);
    while ($getParents = mysqli_fetch_assoc($parents)) {
        echo "<option value = " . $getParents['phonenum'] . " >" . $getParents['fname'] . " " . $getParents['sname'] . "</option>";
    }

    echo '</datalist>';
}



function totalStudents(){
    #The function ofthis function is to calculate the total number of students in the database.
    global $conString;
    $fetchTotalStudents = "SELECT COUNT(*) as total FROM students";
    $result = mysqli_query($conString, $fetchTotalStudents);
    $totalStudents = mysqli_fetch_array($result);
    echo $totalStudents['total'];
}


function totalMales(){
    #The function ofthis function is to calculate the total number of students in the database.
    global $conString;
    $fetchTotalMaleStudents = "SELECT COUNT(*) as males FROM students WHERE gender = 'Male'";
    $maleResult = mysqli_query($conString, $fetchTotalMaleStudents);
    $totalMales = mysqli_fetch_array($maleResult);
    echo $totalMales['males'];
}

function totalFeMales(){
    #The function ofthis function is to calculate the total number of students in the database.
    global $conString;
    $fetchTotalFemaleStudents = "SELECT COUNT(*) as females FROM students WHERE gender = 'Female'";
    $femaleResult = mysqli_query($conString, $fetchTotalFemaleStudents);
    $totalFemales = mysqli_fetch_array($femaleResult);
    echo $totalFemales['females'];
}

function totalParents(){
    #The function of this function is to calculate and output the total number of parents in the system
    global $conString;
    $allParents = "SELECT COUNT(*) as totalParents FROM users WHERE priv = 1";
    $fetchParents = mysqli_query($conString, $allParents);
    $totalParents  = mysqli_fetch_array($fetchParents);
    echo $totalParents['totalParents'];
}


function totalTeachers(){
    #The function of this function is to calculate and output the total numberof teachers
    global $conString;
    $allTeachers = "SELECT COUNT(*) as totalTeachers FROM users WHERE priv = 2";
    $fetchTeachers = mysqli_query($conString, $allTeachers);
    $totalTeachers  = mysqli_fetch_array($fetchTeachers);
    echo $totalTeachers['totalTeachers'];
}

function denyAccess() {
    global $profileData;
    if ($profileData['priv'] < 3) {
        ?>
        <script> window.location.href="parentDashboard.php";</script>
        <?php
        die();
    }
}

function tableName(){
    //This function works in parentDashboard.php
    //to check which data is being viewed and name the table appropriately.
    if (isset($_GET['cmd']) && $_GET['cmd'] == "allStudents") {
        $tableName = "All Students";
    }elseif(isset($_GET['cmd']) && $_GET['cmd'] == "allParents"){
        $tableName="All Parents";
    }elseif(isset($_GET['cmd']) && $_GET['cmd'] == "allMales"){
        $tableName="All Males";
    }elseif(isset($_GET['cmd']) && $_GET['cmd'] == "allFemales"){
        $tableName="All Females";
    }elseif(isset($_GET['cmd']) && $_GET['cmd'] == "allTeachers"){
        $tableName="All Teachers";
    }else{
        $tableName = "All Students";
    }
    print $tableName;
}

function debug($var){
    echo "<pre>".print_r($var, true)."</pre>";
}
function loginParentApi($userid, $password, $conString){
    $password = hash('sha256', $password);
    $result = array();
    $user = "select * from users where(priv = 1 and phonenum = '$userid' and pword = '$password' and access > 0)";
    $fetchUser = mysqli_query($conString, $user);
    $userData  = mysqli_fetch_array($fetchUser);
    //: if exit
    if(mysqli_num_rows($fetchUser) === 1){
      $result["code"] = 33;
      $result["message"] = "Successful Login!";  
      $userData[0]["pword"] = "****";
      $result["data"] = $userData; 
    }else{
        
      $result["code"] = -33;
      $result["message"] = "Bad Login!"; 
      
    }
    
    return $result;
    
}

?>