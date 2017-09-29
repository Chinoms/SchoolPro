<?php
require 'inc/config.php';


session_start();// Starting Session
// Storing Session
$user_check=$_SESSION['validuser'];
// SQL Query To Fetch Complete Information Of User
$ses_sql=mysqli_query($conString, "SELECT * FROM users WHERE phonenum='$user_check'");
$profileData = mysqli_fetch_assoc($ses_sql);
$login_session =$profileData['phonenum'];
$userID = $login_session;
if($profileData['access'] < 1){
   die(header('Location:logout.php'));
}
#echo $profileData['access'];
if(!isset($login_session)){
mysqli_close($conString); // Closing Connection
header('location: login.php'); // Redirecting To Home Page
}
$priv = $profileData['priv'];
?>