<?php


       require("../inc/config.php");
       require("../inc/functions.php");
       #Connection variable = $conString;
         //:  set up services
       isset($_REQUEST["api_key"]) or die("no api key");
       $_REQUEST["api_key"] == "3020" or die("invalid api key");
       
       if(isset($_REQUEST["loginParent"])){
       $password=$_REQUEST['pword'];
       $userid = $_REQUEST['loginParent'];
       $password = hash('sha256', $password);
        extract($_REQUEST);
       
         $rst = loginParentApi($userid, $password, $conString);
         
         //debug($rst);
       echo json_encode($rst);
       //echo $password;
       
       }





?>