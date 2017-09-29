<?php

/*
 * Create a new class in the database using form data supplied by manageClasses.php
 */
require '../inc/config.php';
if (isset($_POST['submit'])) {
    $grade = $_POST['className'];

    $checkClasses = "SELECT * FROM grade WHERE grade='$grade'";
    $verifyClasses = mysqli_query($conString, $checkClasses);
    if (mysqli_affected_rows($conString) > 0) {
        ?>
        <script>window.alert('There exists a class with the same name. Make sure of the class you want to create and try again.\n\
         Duplicate class names not permitted. \n\
        Redirecting ...');
            window.history.back();</script>
        <?php

        die();
    }

    $newGrade = "INSERT INTO grade (grade) VALUES('$grade')";
    $saveGrade = mysqli_query($conString, $newGrade);
    ?>
    <script>window.alert('Class added. Redirecting . . .'); window.history.back();</script>
    <?php

    die();
}
?>
