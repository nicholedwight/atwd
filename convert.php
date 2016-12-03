<?php
require('config.php');

function convert($from, $to, $amnt, $format) {
  //
	// if ($format=='json') {
	// 	$json = array('conv' => array("code" => "$eno", "msg" => "$msg"));
	// 	header('Content-Type: application/json');
	// 	return json_encode($json, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
	// }
	// else {

    $xml =  '<?xml version="1.0" encoding="UTF-8"?>';
    $xml .= '<conv>';
    $xml .= '<rate>' . 'RATEHERE' . '</rate>';
    $xml .= '<from>';
    $xml .= '<code>' . $from . '</code>';
    $xml .= '<curr>' . 'CURRENCYNAME' . '</curr>';
    $xml .= '<loc>' . 'LOCATIONARRAY' . '</loc>';
    $xml .= '<amnt>' . $amnt . '</amnt>';
    $xml .= '</from>';
    $xml .= '<to>';
    $xml .= '<code>' . $to . '</code>';
    $xml .= '<curr>' . 'CURRENCYNAME' . '</curr>';
    $xml .= '<loc>' . 'LOCATIONARRAY' . '</loc>';
    $xml .= '<amnt>' . $amnt . '</amnt>';
    $xml .= '</to>';
    $xml .= '</conv>';

    echo htmlentities($xml);

    $newxml = new SimpleXMLElement($xml);
    echo $newxml->asXML();

  // }
}

if (isset($_GET['from'])) {
  convert($_GET['from'], $_GET['to'], $_GET['amnt'], $_GET['format']);
}
