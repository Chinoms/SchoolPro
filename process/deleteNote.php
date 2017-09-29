<?php
require '../inc/config.php';
if(isset($_GET['noteID'])){
    $noteID = $_GET['noteID'];
    $deleteNote = "DELETE FROM notes WHERE id = $noteID";
    $queryNote = mysqli_query($conString, $deleteNote);
    
  
    ?>
<script>window.alert('Note deleted!'); window.history.back();</script>
<?php

die();
}else{
    ?>
<script>window.alert('Unable to delete note. Couldn\'t verify your identity.'); window.history.back();</script>
<?php
}
?>
