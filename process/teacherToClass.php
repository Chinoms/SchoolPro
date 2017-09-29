<?php

/*
 * The purpose of this file is to receive data from manageClasses.php file 
 * and assign teachers to classes.
 */
require '../inc/config.php';

if (isset($_POST['submit'])) {
    $grade = $_POST['grade'];
    $teacher = $_POST['teacherList'];
    if ($_POST['role'] == 1) {
        $role = "teacherOne";
    } else {
        $role = "teacherTwo";
    }

    $assignTeacher = "UPDATE grade SET $role='$teacher' WHERE grade='$grade'";
    $setTeacher = mysqli_query($conString, $assignTeacher) OR die(mysqli_error($conString));
    ?>
<script>window.alert('Teacher assigned to class. Redirecting...');window.history.back();</script>
<?php
    die();
}

