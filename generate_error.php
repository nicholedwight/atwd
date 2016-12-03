<?php
# function to return formatted json or xml error msgs
# expects three params - error_number, error_hash & format
# if format missing, default to xml
function generate_error($eno, $error_hash, $format='xml') {
	$msg = $error_hash[$eno];

	if ($format=='json') {
		$json = array('conv' => array("code" => "$eno", "msg" => "$msg"));
		header('Content-Type: application/json');
		return json_encode($json, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
	}
	else {
		$xml =  '<?xml version="1.0" encoding="UTF-8"?>';
		$xml .= '<conv><error>';
		$xml .= '<code>' . $eno . '</code>';
		$xml .= '<msg>' . $msg . '</msg>';
		$xml .= '</error></conv>';

		header('Content-type: text/xml');
		return $xml;
	}
}
# uncomment following lines (one at a time) then run to test
//echo generate_error(1200, $error_hash);
// echo generate_error(1300, $error_hash, 'json');
?>
