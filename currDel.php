<?php
require('config.php');

$code = $_GET['code'];
$at = time();

$currencyXML = simplexml_load_file(RATES);
$countryXML = simplexml_load_file(COUNTRIES);

if ($currencyXML->xpath("/rates/rate[@code='" . $code . "']") &&
$countryXML->xpath("/currencies/currency/ccode[text()='" . $code . "']")) {
  // If node exists within currencies.xml
  header('Content-Type: text/xml');
  $xml = new SimpleXMLElement('<method type="delete" />');
  $xml->addChild('at', date("d F Y G:i", (int)$at));
  $xml->addChild('code', $code);
  echo $xml->asXML();

  // Looping through nodes to find nodes with code equal to code parameter provided
  foreach($currencyXML->xpath("/rates/rate[@code='" . $code . "']") as $found){
			// We make that node into a DOM object
			$dom = dom_import_simplexml($found);
			// Then we delete that node
			$dom->parentNode->removeChild($dom);
	}
  // Updating currencies.xml to remove requested node
  $currencyXML->asXml(RATES);

  // Looping through nodes to find nodes with code equal to code parameter provided
  foreach($countryXML->xpath("/currencies/currency/ccode[text()='" . $code . "']") as $found){
			// We make that node into a DOM object
			$dom = dom_import_simplexml($found);
			// Then we delete that node
			$parent = $dom->parentNode;
      $grandParent = $parent->parentNode;
      $grandParent->removeChild($parent);
	}
  $countryXML->asXml(COUNTRIES);



} else {
  // If currency is not an existing node (already deleted)
  header('Content-Type: text/xml');
  $xml = new SimpleXMLElement('<method type="delete" />');
  $error = $xml->addChild('error');
  $error->addChild('msg', 'Currency does not exist');
  echo $xml->asXML();
}

?>
