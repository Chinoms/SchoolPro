<?php
require('../inc/config.php');
//This file saves all input from the addUser.php file into the database
if(isset($_POST['addUser'])){
   $fname = mysqli_real_escape_string($conString, $_POST['fname']);
   $sname = mysqli_real_escape_string($conString, $_POST['sname']);
   $phoneNum = mysqli_real_escape_string($conString, $_POST['phonenum']);
   $email = mysqli_real_escape_string($conString, $_POST['email']);
   $pword = mysqli_real_escape_string($conString, $_POST['pword']);
   $gender = mysqli_real_escape_string($conString, $_POST['gender']);
   $addyOne = mysqli_real_escape_string($conString, $_POST['addyOne']);
   $addyTwo = mysqli_real_escape_string($conString, $_POST['addyTwo']);
   $addyThree = mysqli_real_escape_string($conString, $_POST['addyThree']);
   $qual = mysqli_real_escape_string($conString, $_POST['qual']);
   $ddob = mysqli_real_escape_string($conString, $_POST['ddob']);
   $mmob = mysqli_real_escape_string($conString, $_POST['mmob']);
   $yyob = mysqli_real_escape_string($conString, $_POST['yyob']);
   $priv = mysqli_real_escape_string($conString, $_POST['priv']);
   
   //encrypt Password
   $encPword = hash('sha256', $pword);
   
   $userQuery = "SELECT * FROM users WHERE phonenum = '$phoneNum'";
   $queryUser = mysqli_query($conString, $userQuery);
   if(mysqli_affected_rows($conString) > 0){
       ?>
<script>window.alert('There\'s a user here with one or more of the account details supplied. \n\
Please change the phone number and try again'); window.history.back();</script>
<?php
      die();
   }
   

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
    
    die();
$uploadOk = 0;
   }
   if($_FILES['passp']['type'] != "image/jpg" && $_FILES['passp']['type'] != "image/png" && $_FILES['passp']['type'] != "image/jpeg"
    && $_FILES['passp']['type'] != "gif" ) {
       ?> <script>alert('Sorry, only JPG, JPEG, PNG & GIF files are allowed.');window.history.back();</script><?php
    $uploadOk = 0;
    die();
}
if (move_uploaded_file($_FILES["passp"]["tmp_name"], $target_dir)) {
 
    
    $store = "INSERT INTO users(fname, sname, phonenum, email, pword, priv, lineOne, lineTwo, lineThree, passport, ddob, mmob, yyob, qual, gender)
            VALUES('$fname', '$sname', '$phoneNum', '$email', '$encPword', '$priv', '$addyOne', '$addyTwo', '$addyThree', '$target_dir', '$ddob', '$mmob', '$yyob', '$qual', '$gender')";
   if(mysqli_query($conString, $store)){
       
       $to = "$email";
$subject = "Welcome to Our School";

$message = "
<html>
<head>
<title>Welcome to Our School</title>
</head>
<body>
<center><img src='".$baseURL."/uploads/schoollogo.jpg' height='100'></center>
<p>You have been signed up on Our School's Student Information Management System.</p>
<p>The following are your login details:</p>
<p><b>Phone Number:</b>".$phoneNum."</p>
<p><b>Password:</b>".$pword."</p>
<p>Please login and change your password.</p>
</body>
</html>
";


$headers = "MIME-Version: 1.0" . "\r\n";
$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

// More headers
$headers .= 'From: Our School<admin@sukulu.com>' . "\r\n";


mail($to,$subject,$message,$headers);
       
       
       
       ?>
       <script>window.alert('User created successfully. Login details sent to their mailbox.'); window.history.back();</script>
           <?php
      # die('Saved successfully'); 
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