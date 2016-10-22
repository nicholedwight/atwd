<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include('api/currencies.php');
require('api/errors.php');
// getCurrencies();
//
// if (!empty($_GET['amnt'])) {
//   $xml = simplexml_load_file('./data/currencies.xml');
//   echo $xml->currency[0]->name;
// } else {
//   $xml = simplexml_load_string($missingParameter);
//   Header('Content-type: text/xml');
//   echo $xml->asXML();
// }

if (!empty($_GET['from'])) {
  $request = (string)$_GET['from'];
  $xml = simplexml_load_file('./data/currencies.xml');
  $match = false;
  for($i = 0; $i < count($xml); $i++) {
    if($xml->currency[$i]['code'] == $request) {
      echo $i;
      echo 'success';
      $match = true;
      return;
    }
  }
  if ($match == false ) {
    $errors = simplexml_load_string($currencyNotRecognised);
    Header('Content-type: text/xml');
    echo $errors->asXML();
  }
  // foreach($xml->currency as $currency) {
  //    $currency->name;
    // if($currency['code'] == $request) {
    //   echo $request . ' is the same as ' . $currency['code'];
    //   break;
    // } else {
    //   // echo "fail";
    //   // break;
    //   // $errors = simplexml_load_string($currencyNotRecognised);
    //   // Header('Content-type: text/xml');
    //   // echo $errors->asXML();
    // }



    // switch ($currency) {
    //   case ['code'] == $request;
    //     echo $request;
    //     break;
    //   case ['code'] != $request;
    //     $errors = simplexml_load_string($currencyNotRecognised);
    //     Header('Content-type: text/xml');
    //     echo $errors->asXML();
    // }
  // }

} else {

}
?>
