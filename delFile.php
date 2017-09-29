<?php
require 'inc/session.php';
if($_GET['fileID']){
    $fileID = $_GET['fileID'];
    $rowID = $_GET['rowID'];
   
    $deleteRow = "DELETE FROM reportcards WHERE id = '$rowID'";
    if(mysqli_query($conString, $deleteRow) && (unlink($fileID))){
        ?>
<script>alert('File deleted! Click OK to go back.'); window.history.back();</script>
<?php
die();
    }
}elseif($_GET['uploadID']){
    $fileID = $_GET['uploadID'];
    $rowID = $_GET['rowID'];
  
     $deleteRow = "DELETE FROM downloads WHERE id = '$rowID'";
    if(mysqli_query($conString, $deleteRow) && (unlink($fileID))){
        ?>
<script>alert('File deleted! Click OK to go back.'); window.history.back();</script>
<?php
die();
    
    }
}
?>