<?php

#This file updates a student's profile picture by picking up the reg number
# storing the path tho the former profile pic in a variable,
# updating the profile picture, and deleting the former one.
require('../inc/config.php');
//This file saves all input from the addStudents.php file into the database
if (isset($_POST['submit'])) {

    $regNum = $_POST['regNum'];
    $getOldPassport = mysqli_query($conString, "SELECT * FROM students WHERE realRegNum = '$regNum'");
    $getPic = mysqli_fetch_array($getOldPassport);
    $oldPic = $getPic['passport'];
   // "<br>";
    #echo $oldPic . "<br>";
    #echo $regNum;
    #die();



    $target_dir = "../uploads/passports/";
    $target_dir = $target_dir . str_replace(" ", "_", $_FILES['passp']['name']);
    $uploadFile_type = $_FILES["passp"]["type"];
    $passport = $target_dir;
    //Check if file exists
    if (file_exists($target_dir)) {
        ?>  <script>alert('File already exists. Please rename the file and try again.');window.history.back();</script><?php

        die();
        $uploadOk = 0;
    }
    //Check the size of the file.
    if ($_FILES["passp"]["size"] > 500000) {
        ?>  <script>alert('The file you uploaded is too large. The maximum upload size is 500KB');window.history.back();</script><?php

        $uploadOk = 0;
    }

    if ($_FILES['passp']['type'] != "image/jpg" && $_FILES['passp']['type'] != "image/png" && $_FILES['passp']['type'] != "image/jpeg" && $_FILES['passp']['type'] != "gif") {
        ?> <script>alert('Sorry, only JPG, JPEG, PNG & GIF files are allowed.');window.history.back();</script><?php

        $uploadOk = 0;
        die();
    } else {
        $uploadOk = 1;
        //echo 'yes';
    }

    if (move_uploaded_file($_FILES["passp"]["tmp_name"], $target_dir)) {
        $store = "UPDATE students SET passport ='$passport' WHERE realRegNum='$regNum'";

        if (mysqli_query($conString, $store)) {
            if($passport!==$oldPic){
            unlink($oldPic);
            }
            ?>  <script>alert('Photo updated!');window.history.back();</script><?php

        } else {
            die(mysqli_error($conString));
        }
    } else {
        ?>  <script>alert('Oops! Something went wrong. Please try again.');window.history.back();</script><?php

    }
}
?>