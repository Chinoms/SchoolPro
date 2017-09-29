<?php
//require 'inc/session.php';
session_start();
session_destroy();
header('location:login.php');
?>