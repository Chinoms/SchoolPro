<?php

require('../inc/config.php');
//This file saves all input from the addStudents.php file into the database
if (isset($_POST['submit'])) {


    $fname = $_POST['fname'];
    $mname = $_POST['mname'];
    $sname = $_POST['sname'];

    $weight = $_POST['weight'];
    $height = $_POST['height'];
    $classes = $_POST['classes'];

    ##Personal data ends here
    ##In case of emergency....

    $icename = $_POST['icename'];
    $icerel = $_POST['icerel'];
    $icephone = $_POST['icephone'];

    $icename2 = $_POST['icename2'];
    $icerel2 = $_POST['icerel2'];
    $icephone2 = $_POST['icephone2'];
    $realRegNum = $_POST['regNum'];


    if (empty($fname) ||
            empty($mname) ||
            empty($sname) ||
            empty($weight) ||
            empty($height) ||
            empty($classes) ||
            ##Personal data ends here
            ##In case of emergency....

            empty($icename) ||
            empty($icerel) ||
            empty($icephone) ||
            empty($icename2) ||
            empty($icerel2) ||
            empty($icephone2)
    ) {
        ?>
        <script>window.alert('It appears you didn\'t make a selection in one of the fields. \n\
        Try again, please.');
            window.history.back();</script>
            <?php

        die();
    }






    /*     * **End of checks for empty variables** */


    $store = "UPDATE students SET fname = '$fname', mname ='$mname', lname = '$sname', weight = '$weight', height='$height', grade = '$classes', icename = '$icename', icerel = '$icerel', icephone = '$icephone', icename2 = '$icename2', icerel2 = '$icerel2', icephone2 = '$icephone2' WHERE realRegNum = '$realRegNum'";
    if (mysqli_query($conString, $store)) {
        ?>
        <script>window.alert('Student details updated.\n\
        Redirecting . . .');
            window.history.back();</script>
            <?php

        die();
    } else {
        die(mysqli_error($conString));
    }
} else {
    ?>
    <script>alert('You came in throught the wrong place. Please try again');window.history.back();</script>
    <?php

}
?>