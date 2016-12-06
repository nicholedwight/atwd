<?php
// require('config.php');

if(isset($_GET['from'])) {
$at = time();
$format = $_GET['format'];
$countries = simplexml_load_file(COUNTRIES);
$currencies = simplexml_load_file(RATES);

// Using Xpath to grab nodes from xml FilesystemIterator

// Using Xpath to grab the name of the from currency
$fromcname = $countries->xpath("/currencies/currency/ccode[text()='" . $_GET['from'] . "']/following-sibling::cname");
foreach ($fromcname as $key => $value) {
  $fromname = $value;
}

// Grabbing the name of the currency name being converted to
$tocname = $countries->xpath("/currencies/currency/ccode[text()='" . $_GET['to'] . "']/following-sibling::cname");
foreach ($tocname as $key => $value) {
  $toname = $value;
}

// Grabbing the countries the from currency is used in
$fromlocs = $countries->xpath("/currencies/currency/ccode[text()='" . $_GET['from'] . "']/following-sibling::cntry");
foreach ($fromlocs as $key => $value) {
  $fromlocs = $value;
}

// Grabbing the countries the to currency is used in
$tolocs = $countries->xpath("/currencies/currency/ccode[text()='" . $_GET['to'] . "']/following-sibling::cntry");
foreach ($tolocs as $key => $value) {
  $tolocs = $value;
}

// Grabbing the rate of the from currency
$fromRate = $currencies->xpath("/rates/rate[@code='" . $_GET['from'] . "']/@value");
// Grabbing the value of the from rate from the objet
foreach ($fromRate as $key => $value) {
  $fromRate = $value;
}

// Grabbing the rate of the to currency
$toRate = $currencies->xpath("/rates/rate[@code='" . $_GET['to'] . "']/@value");
// Grabbing the value of the to rate from the object
foreach ($toRate as $key => $value) {
  $toRate = $value;
}

$at = $currencies->xpath("/rates/rate[@code='" . $_GET['to'] . "']/@ts");
foreach ($at as $key => $value) {
  $at = $value;
}

// Doing the conversion, amount divided by the fromRate, times the toRate
$rate = floatval(floatval($toRate[0][0])/floatval($fromRate[0][0]));
$toAmnt = ($rate*floatval($_GET['amnt']));

	if ($format=='json') {
		$json = array(
      'conv' => array(
        "at" => date("d F Y G:i", (int)$at),
        "rate" => (string)$fromRate,
        'from' => array(
          "code" => $_GET['from'],
          "curr" => (string)$fromname,
          "loc" => (string)$fromlocs,
          "amnt" => $_GET['amnt'],
        ),
        'to' => array(
          "code" => $_GET['to'],
          "curr" => (string)$toname,
          "loc" => (string)$tolocs,
          "amnt" => $toAmnt,
        ),
      ));
		header('Content-Type: application/json');
		echo json_encode($json, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
	} else {

  // If node already exists within currencies.xml, display error
  header('Content-Type: text/xml');
  $xml = new SimpleXMLElement('<conv />');
  $xml->addChild('at', date("d F Y G:i", (int)$at));
  $xml->addChild('rate', $fromRate);
  $from = $xml->addChild('from');
  $from->addChild('code', $_GET['from']);
  $from->addChild('curr', $fromname);
  $from->addChild('loc', htmlspecialchars($fromlocs));
  $from->addChild('amnt', $_GET['amnt']);
  $to = $xml->addChild('to');
  $to->addChild('code', $_GET['to']);
  $to->addChild('curr', $toname);
  $to->addChild('loc', $tolocs);
  $to->addChild('amnt', $toAmnt);
  echo $xml->asXML();
}
}
