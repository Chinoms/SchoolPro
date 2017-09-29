<?php

require '../inc/config.php';
if (isset($_POST['sendNote'])) {
    $note = mysqli_escape_string($conString, $_POST['note']);
    $regNum = mysqli_escape_string($conString, $_POST['regNum']);
    $parentID = $_POST['parentID'];
   
    $store = "INSERT INTO notes(recipient, refchild, note)
         VALUES('$parentID', '$regNum', '$note')";
    if (mysqli_query($conString, $store)) {
            ?>
<script>window.alert('Note Saved'); window.history.back();</script>
    <?php
        }else{
            print 'Failed'. mysqli_error($conString);
        }
    
}else{
    echo 'Wrong gate.';
}
    ?>