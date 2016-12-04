<?php
require('config.php');

$rate = $_GET['rate'];
$code = $_GET['code'];
$at = time();


$currencyXML = simplexml_load_file(RATES);
$countryXML = simplexml_load_file(COUNTRIES);

$previousRate = $currencyXML->xpath("/rates/rate[@code='" . $code . "']/@value");
foreach ($previousRate as $key => $value) {
  $previousRate = $value;
}
$name = $countryXML->xpath("/currencies/currency/ccode[text()='" . $code . "']/following-sibling::cname");
foreach ($name as $key => $value) {
  $name = $value;
}
$locs = $countryXML->xpath("/currencies/currency/ccode[text()='" . $code . "']/following-sibling::cntry");
foreach ($locs as $key => $value) {
  $locs = $value;
}

if ($currencyXML->xpath("/rates/rate[@code='" . $code . "']") && $countryXML->xpath("/currencies/currency/ccode[text()='" . $code . "']")) {

  // If node already exists within currencies.xml, display error
  header('Content-Type: text/xml');
  $xml = new SimpleXMLElement('<method type="post" />');
  $xml->addChild('at', date("d F Y G:i", (int)$at));
  $previous = $xml->addChild('previous');
  $previous->addChild('rate', $previousRate);
  $curr = $previous->addChild('curr');
  $curr->addChild('code', $code);
  $curr->addChild('name', $name);
  $curr->addChild('loc', $locs);
  $new = $xml->addChild('new');
  $new->addChild('rate', $rate);
  $curr = $new->addChild('curr');
  $curr->addChild('code', $code);
  $curr->addChild('name', $name);
  $curr->addChild('loc', $locs);
  echo $xml->asXML();

  foreach($currencyXML->xpath("/rates/rate[@code='" . $code . "']/@value") as $node) {
    $node->value = $rate;
	}
  foreach($currencyXML->xpath("/rates/rate[@code='" . $code . "']/@ts") as $node) {
    $node->ts = $at;
	}
  $currencyXML->asXML(RATES);

} else {
  header('Content-Type: text/xml');
  $xml = new SimpleXMLElement('<method type="post" />');
  $error = $xml->addChild('error');
  $error->addChild('msg', 'Currency does not exist');
  echo $xml->asXML();
}

?>
