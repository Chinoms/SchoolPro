<?php
require '../inc/config.php';
if(isset($_GET['id'])){
    $userID = $_GET['id'];
    $checkUserAccess = "SELECT access FROM users WHERE id = $userID";
    $queryUSers = mysqli_query($conString, $checkUserAccess);
    $userAccess = mysqli_fetch_array($queryUSers);
 
    $getUserID = "UPDATE users SET access = NOT ACCESS WHERE id = '$userID'";
   
    $updateAccess = mysqli_query($conString, $getUserID);
    ?>
<script>window.alert('User\'s access modified. '); window.history.back();</script>
<?php
}
