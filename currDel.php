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

  $nodetoremove = $currencyXML->xpath("/rates/rate[@code='NIC']");
  // var_dump($nodetoremove);
  // $xmldoc = new DOMDocument($currencyXML);
  // $xmldoc->load('data/currencies.xml');
  // foreach($dom_node_list as $n) {
  //   // $temp_dom->appendChild($temp_dom->importNode($n,true));
  //   echo "butts";
  // }
  // print_r($temp_dom->saveHTML());
  // foreach($nodestoremove as $nodetoremove){
    // This is a hint from the manual comments
    // $nodetoremove->parentNode->removeChild($nodetoremove);
    // echo "butts";
    // echo $nodetoremove;
  // }
  // unset();
  // $currencyXML->asXML("data/currencies.xml");

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
