<?php
require('../inc/config.php');
//This file saves all input from the addStudents.php file into the database
if(isset($_POST['submit'])){
   $fname = $_POST['fname'];
   $mname = $_POST['mname'];
   $sname = $_POST['sname'];
   $gender = $_POST['gender'];
   $bgroup = $_POST['bgroup'];
   $nationality = $_POST['nationality'];
   $religion = $_POST['religion'];
  
   $parent = $_POST['parent'];
   $ddob = $_POST['ddob'];
   $mmob = $_POST['mmob'];
   $yyob = $_POST['yyob'];
   $weight = $_POST['weight'];
   $height = $_POST['height'];
   $classes = $_POST['classes'];
   $homelang = $_POST['homelang'];
   
   ##Personal data ends here
   ##In case of emergency....
   
   $icename = $_POST['icename'];
   $icerel = $_POST['icerel'];
   $icephone = $_POST['icephone'];
   
   $icename2 = $_POST['icename2'];
   $icerel2 = $_POST['icerel2'];
   $icephone2 = $_POST['icephone2'];
   
   
   if(empty($fname) ||
empty($mname) ||
empty($gender) ||
empty($bgroup) ||
empty($nationality) ||
empty($religion) ||           
empty($parent) ||
empty($ddob) ||
empty($mmob) ||
empty($yyob) ||
empty($weight) ||
empty($height) ||
empty($classes) ||
empty($homelang) ||
 
   ##Personal data ends here
   ##In case of emergency....
   
   empty($icename) ||
   empty($icerel) ||
   empty($icephone) ||
   empty($icename2) ||
   empty($icerel2) ||
   empty($icephone2)   
           
           ){
       
       ?> <script>alert('One or more fields empty. Please make sure all fields are filled');window.history.back();<?php
   }
       
       
       
       
       
       
       /****End of checks for empty variables***/
   $target_dir = "../uploads/passports/";
   $target_dir = $target_dir.str_replace(" ", "_", $_FILES['passp']['name']);
   $uploadFile_type=$_FILES["passp"]["type"];
   $passport = $target_dir;
   //Check if file exists
   if (file_exists($target_dir )) {
   ?>  <script>alert('File already exists. Please rename the file and try again.');window.history.back();</script><?php
   die();
    $uploadOk = 0;
}
    //Check the size of the file.
   if ($_FILES["passp"]["size"] > 500000) {
	?>  <script>alert('The file you uploaded is too large. The maximum upload size is 500KB');window.history.back();</script><?php
    $uploadOk = 0;
}

   if($_FILES['passp']['type'] != "image/jpg" && $_FILES['passp']['type'] != "image/png" && $_FILES['passp']['type'] != "image/jpeg"
    && $_FILES['passp']['type'] != "gif" ) {
       ?> <script>alert('Sorry, only JPG, JPEG, PNG & GIF files are allowed.');window.history.back();</script><?php
    $uploadOk = 0;
    die();
}
else{
	   $uploadOk = 1;
           //echo 'yes';
}

if (move_uploaded_file($_FILES["passp"]["tmp_name"], $target_dir)) {
 #echo "File uploaded";  
$regNum = "SUK/".date('ymd')."/".date('his');
$realRegNum = "SUK" . date('ymd').date('his');


    
    $store = "INSERT INTO students(fname, mname, lname, gender, bloodGroup, nationality, religion,"
            . "parentID, mmob, yyob, ddob, weight, height, grade, homelang, icename, icerel, icephone,"
            . "icename2, icerel2, icephone2, regNum, realRegNum, passport) VALUES('$fname','$mname', '$sname', '$gender', '$bgroup',
                '$nationality', '$religion', '$parent', '$mmob', '$yyob', '$ddob', '$weight', '$height', '$classes', '$homelang', '$icename',"
            . "'$icerel', '$icephone', '$icename2', '$icerel2', '$icephone2', '$regNum', '$realRegNum', '$passport')";
   if(mysqli_query($conString, $store)){
      ?>  <script>alert('Student added successfully!.');window.history.back();</script><?php
   }else{
       die(mysqli_error($conString));
   }
    
    
       
    } else {
	?>  <script>alert('Oops! Something went wrong. Please try again.');window.history.back();</script><?php
      
    }
   
}else{
    ?>
       <script>alert('You came in throught the wrong place. Please try again');window.history.back();</script>
       <?php
}


?>