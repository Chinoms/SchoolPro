<?php

/* 
 * The purpose of this file is to receive data from studentProfile.php
 * after payment has been made and update the 'feesPaid' column in the 
 * database to reflect payment.
 */

require '../inc/config.php';
if(isset($_GET['studentID'])){
    $regNum = $_GET['studentID'];
    $updateFeesPaid = "UPDATE students SET feesPaid =1 WHERE realRegNum = '$regNum'";
    $pay = mysqli_query($conString, $updateFeesPaid);
    if(mysqli_affected_rows($conString) === 1){
      ?>
<script>alert('Payment status updated.');window.history.back();</script>
<?php
    }else{
        die(mysqli_error($conString));
    }
}

?>