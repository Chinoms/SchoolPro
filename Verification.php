<?php


class Verification{

 function updateFee($regNum, $dbCon){
  //global $dbCon;
  $regNum = str_replace('/', '', $regNum); 
  $updatePayment = "UPDATE students SET feesPaid = 1 WHERE realRegNum = '$regNum'";
 
  if(mysqli_query($dbCon, $updatePayment)){
  return true;
  }else{
  return false;
  }
 }
 
 function saveTrnx($referenceData, $dbCon){
 $referenceID = $referenceData['reference'];
 $parentID = $referenceData['parent_phone'];
 $parentEmail = $referenceData['parent_email'];
 $regNum = $referenceData['student_reg'];
  $regNum = str_replace('/', '', $regNum); 
 $studentName = $referenceData['student_fname'];
 $parentName =$referenceData['parent_fname'];
 
 $saveTrnx = "INSERT INTO transactionLogs(parentName, childName, regNum, parentID, trnxRef, parentEmail) VALUES('$parentName', '$studentName', '$regNum', '$parentID', '$referenceID', '$parentEmail')";
 mysqli_query($dbCon, $saveTrnx);
 
 
 }
 
 function emailParent($parentID, $dbCon){
 
 }
 
}

?>