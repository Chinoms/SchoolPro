<?php
require '../inc/config.php';
#The purpose of this file is to receive data from sessionsAndYesrs.php and 
#set whatever it recieves there as the current term or session, one at a time.

if(isset($_POST['setTerm'])){
    $currTerm = mysqli_escape_string($conString, $_POST['term']);
    $setTerm = "UPDATE config SET optionValue = '$currTerm' WHERE optionName = 'currTerm'";
    $updateTerm = mysqli_query($conString, $setTerm);
    ?>
<script>window.alert('Term Updated! Redirecting . . .'); window.history.back();</script>
<?php
die();
}


if(isset($_POST['setYear'])){
    $currYear = mysqli_escape_string($conString, $_POST['year']);
    $setYear = "UPDATE config SET optionValue = '$currYear' WHERE optionName = 'currYear'";
    $updateYear = mysqli_query($conString, $setYear);
    ?>
<script>window.alert('Year Updated! Redirecting . . .'); window.history.back();</script>
<?php
die();
}


if(isset($_POST['submit'])){
    $grade = $_POST['grade'];
    $tuition = $_POST['fee'];
    $setFee = "UPDATE grade SET fees = '$tuition' WHERE grade = '$grade'";
    if(mysqli_query($conString, $setFee)===TRUE){
        ?>
<script>window.alert('Tuition set for selected class. Redirecting . . .');window.history.back();</script>
<?php
    } else {
    ?>
<script>window.alert('Oops! Something went wrong. Please try again');</script>
        <?php
    }
}
?>