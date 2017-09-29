<?php

require('../inc/config.php');
//This file saves all input from the addStudents.php file into the database
if (isset($_POST['saveReportCard'])) {
    $regNum = $_POST['regNum'];





    $target_dir = "../uploads/reportCards/";
    $target_dir = $target_dir . str_replace(" ", "_", $_FILES['reportCard']['name']);
    $uploadFile_type = $_FILES["reportCard"]["type"];
    $reportCardort = $target_dir;
    //Check if file exists
    if (file_exists($target_dir)) {
        ?>  <script>alert('File already exists. Please rename the file and try again.');window.history.back();</script><?php

        die();
        $uploadOk = 0;
    }
    //Check the size of the file.
    if ($_FILES["reportCard"]["size"] > 3000000) {
        ?>  <script>alert('The file you uploaded is too large. The maximum upload size is 500KB');window.history.back();</script><?php

        $uploadOk = 0;
    }

    if ($_FILES['reportCard']['type'] != "application/pdf") {
        ?> <script>alert('Sorry, only PDF files are allowed.');window.history.back();</script><?php

        $uploadOk = 0;
        die();
    } else {
        $uploadOk = 1;
        //echo 'yes';
    }

    if (move_uploaded_file($_FILES["reportCard"]["tmp_name"], $target_dir)) {
        //$regNum = $studentData['realRegNum'];

        $getCurrYear = "SELECT * FROM config WHERE optionName = 'currYear'";
        $getCurrYearVal = mysqli_query($conString, $getCurrYear);
        $getCurrYearVal = mysqli_fetch_array($getCurrYearVal);
        $presentYear = $getCurrYearVal['optionValue'];


        $getCurrTerm = "SELECT * FROM config WHERE optionName = 'currTerm'";
        $getCurrTermVal = mysqli_query($conString, $getCurrTerm);
        $getCurrTermVal = mysqli_fetch_array($getCurrTermVal);
        $presentTerm = $getCurrTermVal['optionValue'];


        $store = "INSERT INTO reportcards(regNum, fileURL, year, term) VALUES('$regNum','$target_dir', '$presentYear', '$presentTerm')";
        if (mysqli_query($conString, $store)) {
            ?>
            <script>window.alert('File successfully uploaded.');window.history.back();</script>
            <?php

            die();
        } else {
            die(mysqli_error($conString));
        }
    } else {
        ?>  <script>alert('Oops! Something went wrong. Please try again.');window.history.back();</script><?php

    }
} elseif


/* * ********The following handles uploads of other files.....*88****** */
 (isset($_POST['sendFile'])) {
    $regNum = $_POST['regNum'];
    $title = $_POST['title'];


    $target_dir = "../uploads/otherFiles/";
    $target_dir = $target_dir . str_replace(" ", "_", $_FILES['otherFile']['name']);
    $uploadFile_type = $_FILES["otherFile"]["type"];

    //Check if file exists
    if (file_exists($target_dir)) {
        ?>  <script>alert('File already exists. Please rename the file and try again.');window.history.back();</script><?php

        die();
        $uploadOk = 0;
    }
    //Check the size of the file.
    if ($_FILES["otherFile"]["size"] > 3000000) {
        ?>  <script>alert('The file you uploaded is too large. The maximum upload size is 500KB');window.history.back();</script><?php

        $uploadOk = 0;
    }

    if ($_FILES['otherFile']['type'] != "application/pdf") {
        ?> <script>alert('Sorry, only PDF files are allowed.');window.history.back();</script><?php

        $uploadOk = 0;
        die();
    } else {
        $uploadOk = 1;
        //echo 'yes';
    }

    if (move_uploaded_file($_FILES["otherFile"]["tmp_name"], $target_dir)) {
        //$regNum = $studentData['realRegNum'];




        $store = "INSERT INTO downloads(recipient, title, fileURL) VALUES('$regNum','$title', '$target_dir')";
        if (mysqli_query($conString, $store)) {
            ?>
            <script>window.alert('Report card uploaded successfully');window.history.back();</script>
            <?php

            die();
        } else {
            unlink($target_dir);
            die(mysqli_error($conString));
        }
    } else {
        ?>  <script>alert('Oops! Something went wrong. Please try again.');window.history.back();</script><?php

    }
} else {
    ?>
    <script>alert('You came in through the wrong place. Please try again');window.history.back();</script>
    <?php

}
?>