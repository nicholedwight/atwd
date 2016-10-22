<?php

// if (!empty($_GET['amnt'])) {
//   $xml = simplexml_load_file('./data/currencies.xml');
//   echo $xml->currency[0]->name;
// } else {
//   $xml = simplexml_load_string($missingParameter);
//   Header('Content-type: text/xml');
//   echo $xml->asXML();
// }

if (!empty($_GET['from'])) {
  $from = (string)$_GET['from'];
  $xml = simplexml_load_file('./data/currencies.xml');
  $match = false;
  for($i = 0; $i < count($xml); $i++) {
    if($xml->currency[$i]['code'] == $from) {
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
    // $json = json_encode($errors);
    // echo $json;
  }

} else {

}
?>

<!DOCTYPE html>
<html>
  <body>

  </body>
</html>
