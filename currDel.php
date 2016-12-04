<?php
require('config.php');

$code = $_GET['code'];
$at = time();


$currencyXML = simplexml_load_file("data/currencies.xml");
if ($currencyXML->xpath("/rates/rate[@code='" . $code . "']")) {
  // If node exists within currencies.xml
  header('Content-Type: text/xml');
  $xml = new SimpleXMLElement('<method type="delete" />');
  $xml->addChild('at', date("d F Y G:i", (int)$at));
  $xml->addChild('code', $code);
  echo $xml->asXML();


  foreach($currencyXML->xpath("/rates/rate[@code='" . $code . "']") as $found){
			//We make that node into a DOM object
			$dom = dom_import_simplexml($found);
			//Then we delete that node
			$dom->parentNode->removeChild($dom);
	}
  $currencyXML->asXml("data/currencies.xml");


} else {
  // If currency is not an existing node (already deleted)
  header('Content-Type: text/xml');
  $xml = new SimpleXMLElement('<method type="delete" />');
  $error = $xml->addChild('error');
  $error->addChild('msg', 'Currency does not exist');
  echo $xml->asXML();

  // Saving new currency to existing currencies.xml
  // $node = $existingXML->addChild('rate');
  // $node->addAttribute('code', $code);
  // $node->addAttribute('value', $rate);
  // $node->addAttribute('ts', $at);
  // $existingXML->asXML("data/currencies.xml");
}

$countryXML = simplexml_load_file("data/countries.xml");
if ($countryXML->xpath("/currencies/currency/ccode[text='" . $code . "']")) {
  // If node already exists within currencies.xml, display error
  header('Content-Type: text/xml');
  $xml = new SimpleXMLElement('<method type="put" />');
  $error = $xml->addChild('error');
  $error->addChild('msg', 'Country already exists');
  echo $xml->asXML();

} else {
  // Saving new currency to existing currencies.xml
  // $node = $countryXML->addChild('currency');
  // $node->addChild('ccode', $code);
  // $node->addChild('cname', $name);
  // $node->addChild('cntry', $locations);
  // $countryXML->asXML("data/countries.xml");
}
?>
