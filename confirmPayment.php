<?php
require_once 'Verification.php';

//: db
//: read raw post
 $req = file_get_contents('php://input');

//; weak pattern for json check.
$_REQUEST = json_decode($req, true);



function receiveFeePayment($reference, $referenceData, $dbCon){
 $paystack_ref = $reference;
        //: paystack lib
      $response = array();
//The parameter after verify/ is the transaction reference to be verified
        //############# START BLOCK ############

$curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => "https://api.paystack.co/transaction/verify/$paystack_ref",
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => "",
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 30,
  CURLOPT_SSL_VERIFYPEER => false,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => "GET",
  CURLOPT_HTTPHEADER => array(
    "authorization: Bearer sk_test_2de7343f4e25d991a771a1e28ed65415575e8025",
    "cache-control: no-cache",
    "postman-token: b75bbd76-abaa-35a0-c686-ff044cee9a87"
  ),
));

$response = curl_exec($curl);

$response = json_decode($response, TRUE);
$err = curl_error($curl);

curl_close($curl);

if ($err) {
  echo "cURL Error #:" . $err;
} else {
  //there is response
  if (array_key_exists('data', $response) && array_key_exists('status', $response['data']) && ($response['data']['status'] === 'success')) {

$regNum = $_REQUEST['student_reg'];
$checkFeePayment = new Verification();

$confPay = $checkFeePayment->updateFee($regNum, $dbCon);
if($confPay === true){

$savePayToDB = $checkFeePayment->saveTrnx($referenceData, $dbCon);
echo "Payment Verified";
}else{
echo "Couldn't verify your payment.";
}


    //: DO SOME PROCESSING : update school fees status and send receipt to email

//var_dump($result);


    // echo "<pre>".print_r($_REQUEST, true)."</pre>";
      exit;
      //: SEND BACK
    echo json_encode(array("code" => 33, "message" => "Payment verified."));
}else{
   // echo "<pre>".print_r($response, true)."</pre>";
  //echo "Transaction was unsuccessful";
  echo json_encode(array("code" => -33, "message" => "Unable to verify payment."));
}



}



        //############ END BLOCK ############




        }
        
      if(isset($_REQUEST["api_request"])){
      
      include_once '../inc/config.php';
    //  var_dump($conString);die();
        $reference = $_REQUEST["reference"];
        //echo $_REQUEST['reference']; die();
        receiveFeePayment($reference, $_REQUEST, $conString);
      }




?>