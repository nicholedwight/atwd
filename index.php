<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include('api/currencies.php');
require('api/errors.php');
getCurrencyCodes();
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

<form action="" method="POST">
  <input type='text' id="amnt" />
  <select id="from">
    <?php foreach($codesArray as $codeName) { ?>
      <option id=""><?php echo $codeName;?> </option>
    <?php }?>
  </select> to <select id="to">
    <?php foreach($codesArray as $codeName) { ?>
      <option id=""><?php echo $codeName;?> </option>
    <?php }?>
  </select>
  <button type="submit" name="submit">Submit</button>
</form>
