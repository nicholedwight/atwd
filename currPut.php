<?php
require('config.php');

$rate = $_GET['rate'];
$code = $_GET['code'];
$name = $_GET['name'];
$locations = $_GET['locations'];
$at = time();


$currencyXML = simplexml_load_file("data/currencies.xml");
if ($currencyXML->xpath("/rates/rate[@code='" . $code . "']")) {
  // If node already exists within currencies.xml, display error
  header('Content-Type: text/xml');
  $xml = new SimpleXMLElement('<method type="put" />');
  $error = $xml->addChild('error');
  $error->addChild('msg', 'Currency already exists');
  echo $xml->asXML();

} else {
  // Displaying new currency in the browser
  header('Content-Type: text/xml');
  $xml = new SimpleXMLElement('<method type="put" />');
  $xml->addChild('at', date("d F Y G:i", (int)$at));
  $xml->addChild('rate', $rate);
  $currency = $xml->addChild('curr');
  $currency->addChild('code', $code);
  $currency->addChild('name', $name);
  $currency->addChild('loc', $locations);
  echo $xml->asXML();

  // Saving new currency to existing currencies.xml
  $node = $currencyXML->addChild('rate');
  $node->addAttribute('code', $code);
  $node->addAttribute('value', $rate);
  $node->addAttribute('ts', $at);
  $currencyXML->asXML("data/currencies.xml");
}

$countryXML = simplexml_load_file("data/countries.xml");
if ($countryXML->xpath("/currencies/currency/ccode[text='" . $code . "']")) {
  // If node already exists within currencies.xml, display error
  header('Content-Type: text/xml');
  $xml = new SimpleXMLElement('<method type="put" />');
  $error = $xml->addChild('error');
  $error->addChild('msg', 'Currency already exists');
  echo $xml->asXML();

} else {
  // Saving new currency to existing currencies.xml
  $node = $countryXML->addChild('currency');
  $node->addChild('ccode', $code);
  $node->addChild('cname', $name);
  $node->addChild('cntry', $locations);
  $countryXML->asXML("data/countries.xml");
}
?>
