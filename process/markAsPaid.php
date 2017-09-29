<?php
require '../inc/config.php';
if(isset($_GET['studentID'])){
    $studentID = $_GET['studentID'];
   
 
    $changeTuition = "UPDATE students SET feesPaid = 1 WHERE realRegNum = '$studentID'";
   
    $updateTuition = mysqli_query($conString, $changeTuition);
    ?>
<script>window.alert('Updated!'); window.history.back();</script>
<?php
}
