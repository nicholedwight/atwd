<?php
require('config.php');

$at = time();
$countries = simplexml_load_file(COUNTRIES);
$currencies = simplexml_load_file(RATES);

// Using Xpath to grab nodes from xml FilesystemIterator

// Using Xpath to grab the name of the from currency
$fromcname = $countries->xpath("/currencies/currency/ccode[text()='" . $_GET['from'] . "']/following-sibling::cname");

// Grabbing the name of the currency name being converted to
$tocname = $countries->xpath("/currencies/currency/ccode[text()='" . $_GET['to'] . "']/following-sibling::cname");

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

// Grabbing the rate of the to currency
$toRate = $currencies->xpath("/rates/rate[@code='" . $_GET['to'] . "']/@value");
$at = $currencies->xpath("/rates/rate[@code='" . $_GET['to'] . "']/@ts");
// Grabbing the value of the from rate from the objet
foreach ($fromRate as $key => $value) {
  $fromRate = $value;
}
// Grabbing the value of the to rate from the object
foreach ($toRate as $key => $value) {
  $toRate = $value;
}
foreach ($at as $key => $value) {
  $at = $value;
}
foreach ($fromcname as $key => $value) {
  $fromname = $value;
}
foreach ($tocname as $key => $value) {
  $toname = $value;
}
// Doing the conversion, amount divided by the fromRate, times the toRate
$rate = (($_GET['amnt']/(float)$fromRate)*(float)$toRate);


	if ($format=='json') {
		$json = array(
      'conv' => array(
        "at" => date("d F Y G:i", (int)$at),
        "rate" => $rate,
        'from' => array(
          "code" => $_GET['from'],
          "curr" => $fromname,
          "loc" => $fromlocs,
          "amnt" => $fromRate,
        ),
        'to' => array(
          "code" => $_GET['to'],
          "curr" => $toname,
          "loc" => $tolocs,
          "amnt" => $toRate,
        ),
      ));
		header('Content-Type: application/json');
		return json_encode($json, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
	} else {

  // If node already exists within currencies.xml, display error
  header('Content-Type: text/xml');
  $xml = new SimpleXMLElement('<conv />');
  $xml->addChild('at', date("d F Y G:i", (int)$at));
  $xml->addChild('rate', $rate);
  $from = $xml->addChild('from');
  $from->addChild('code', $_GET['from']);
  $from->addChild('curr', $fromname);
  $from->addChild('loc', $fromlocs);
  $from->addChild('amnt', $fromRate);
  $to = $xml->addChild('to');
  $to->addChild('code', $_GET['to']);
  $to->addChild('curr', $toname);
  $to->addChild('loc', $tolocs);
  $to->addChild('amnt', $fromRate);
  echo $xml->asXML();
}


// function convert($from, $to, $amnt, $format) {
//   $countries = simplexml_load_file(COUNTRIES);
//   $currencies = simplexml_load_file(RATES);
//   // Using Xpath to grab the rate values and timestamp of the nodes with the code matching the get and to parameters
//   $fromRate = $currencies->xpath("/rates/rate[@code='" . $_GET['from'] . "']/@value");
//   $toRate = $currencies->xpath("/rates/rate[@code='" . $_GET['to'] . "']/@value");
//   $at = $currencies->xpath("/rates/rate[@code='" . $_GET['to'] . "']/@ts");
//   // Grabbing the value of the from rate from the objet
//   foreach ($fromRate as $key => $value) {
//     $fromRate = $value;
//   }
//   // Grabbing the value of the to rate from the object
//   foreach ($toRate as $key => $value) {
//     $toRate = $value;
//   }
//   foreach ($at as $key => $value) {
//     $at = $value;
//   }
//   // Doing the conversion, amount divided by the fromRate, times the toRate
//   $rate = (($_GET['amnt']/(float)$fromRate)*(float)$toRate);
//
// 	if ($format=='json') {
// 		$json = array(
//       'conv' => array(
//         "at" => date("d F Y G:i", (int)$at),
//         "rate" => $rate,
//         'from' => array(
//           "code" => $_GET['from'],
//           "curr" => 'CURRENCYNAME',
//           "loc" => 'LOCATIONS',
//           "amnt" => $fromRate,
//         ),
//         'to' => array(
//           "code" => $_GET['to'],
//           "curr" => 'CURRENCYNAME',
//           "loc" => 'LOCATIONS',
//           "amnt" => $toRate,
//         ),
//       ));
// 		header('Content-Type: application/json');
// 		return json_encode($json, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
// 	}
// 	else {
//
//     // Creating the XML to be displayed on conversion
//
//       header('Content-Type: text/xml');
//       $xml = new SimpleXMLElement('<conv />');
//       $xml->addChild('at', date("d F Y G:i", (int)$at));
//       $xml->addChild('rate', $rate);
//       $from = $xml->addChild('from');
//       $from->addChild('code', $_GET['from']);
//       $from->addChild('curr', 'CURRENCYNAME');
//       $from->addChild('loc', 'LOCATIONARRAY');
//       $from->addChild('amnt', $fromRate);
//       $to = $xml->addChild('to');
//       $to->addChild('code', $_GET['to']);
//       $to->addChild('curr', 'CURRENCYNAME');
//       $to->addChild('loc', 'LOCATIONARRAY');
//       $to->addChild('amnt', $fromRate);
//       echo $xml->asXML();
//       // echo $result;
//
//   }
// }

// if (isset($_GET['from'])) {
  // $result = convert($_GET['from'], $_GET['to'], $_GET['amnt'], $_GET['format']);
  // echo $result;
// }
