<?php

function convert($from, $to, $amnt, $format) {
  $countries = simplexml_load_file(COUNTRIES);
  $currencies = simplexml_load_file(RATES);
  // Using Xpath to grab the rate values and timestamp of the nodes with the code matching the get and to parameters
  $fromRate = $currencies->xpath("/rates/rate[@code='" . $_GET['from'] . "']/@value");
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
  // Doing the conversion, amount divided by the fromRate, times the toRate
  $rate = (($_GET['amnt']/(float)$fromRate)*(float)$toRate);

	if ($format=='json') {
		$json = array(
      'conv' => array(
        "at" => date("F j Y G:i", (int)$at),
        "rate" => $rate,
        'from' => array(
          "code" => $_GET['from'],
          "curr" => 'CURRENCYNAME',
          "loc" => 'LOCATIONS',
          "amnt" => $fromRate,
        ),
        'to' => array(
          "code" => $_GET['to'],
          "curr" => 'CURRENCYNAME',
          "loc" => 'LOCATIONS',
          "amnt" => $toRate,
        ),
      ));
		header('Content-Type: application/json');
		return json_encode($json, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
    // var_dump($json);
	}
	else {

    // $countries = simplexml_load_file(COUNTRIES);
    // $currencies = simplexml_load_file(RATES);
    // // Using Xpath to grab the rate values and timestamp of the nodes with the code matching the get and to parameters
    // $fromRate = $currencies->xpath("/rates/rate[@code='" . $_GET['from'] . "']/@value");
    // $toRate = $currencies->xpath("/rates/rate[@code='" . $_GET['to'] . "']/@value");
    // $at = $currencies->xpath("/rates/rate[@code='" . $_GET['to'] . "']/@ts");

    // // Grabbing the value of the from rate from the objet
    // foreach ($fromRate as $key => $value) {
    //   $fromRate = $value;
    // }
    // // Grabbing the value of the to rate from the object
    // foreach ($toRate as $key => $value) {
    //   $toRate = $value;
    // }
    // foreach ($at as $key => $value) {
    //   $at = $value;
    // }
    // // Doing the conversion, amount divided by the fromRate, times the toRate
    // $rate = (($_GET['amnt']/(float)$fromRate)*(float)$toRate);

    // Creating the XML to be displayed on conversion
    $xml =  '<?xml version="1.0" encoding="UTF-8"?>';
    $xml .= '<conv>';
    $xml .= '<at>' . date("F j Y G:i", (int)$at) . '</at>';
    $xml .= '<rate>' . $rate . '</rate>';
    $xml .= '<from>';
    $xml .= '<code>' . $_GET['from'] . '</code>';
    $xml .= '<curr>' . 'CURRENCYNAME' . '</curr>';
    $xml .= '<loc>' . 'LOCATIONARRAY' . '</loc>';
    $xml .= '<amnt>' . $fromRate . '</amnt>';
    $xml .= '</from>';
    $xml .= '<to>';
    $xml .= '<code>' . $_GET['to'] . '</code>';
    $xml .= '<curr>' . 'CURRENCYNAME' . '</curr>';
    $xml .= '<loc>' . 'LOCATIONARRAY' . '</loc>';
    $xml .= '<amnt>' . $toRate . '</amnt>';
    $xml .= '</to>';
    $xml .= '</conv>';
    
    return htmlentities($xml);
  }
}

if (isset($_GET['from'])) {
  convert($_GET['from'], $_GET['to'], $_GET['amnt'], $_GET['format']);
}
