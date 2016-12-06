<?php
# a function to update rates
# expects an array of currency codes
function update_rates ($codes) {

	# remove 'USD' - always 1.000000
	$codes = array_diff($codes, array('USD'));

	# open the two files to process
	# RATES & RATES_URL are constants in the congig file
	$local_rates = simplexml_load_file(RATES) or die("Error: Cannot create object");
	$live_rates = simplexml_load_file(RATES_URL) or die("Error: Cannot create object");

	foreach($codes as $code) {

		# get the local rate & ts
		$rate = $local_rates->xpath("//rate[@code='$code']/@value");

		$ts = $local_rates->xpath("//rate[@code='$code']/@ts");


		# get the yahoo live rate & ts
		$live_rate = $live_rates->xpath("//field[@name='price'][../field[@name='name']/text()[contains(.,'$code')]]");
		$live_ts = $live_rates->xpath("//field[@name='ts'][../field[@name='name']/text()[contains(.,'$code')]]");

		# update the nodes in the local file
		$rate[0][0] = $live_rate[0];
		$ts[0][0] = $live_ts[0];

	}

	# always update 'USD' timestamp to now to avoid anamolies
	$ts = $local_rates->xpath("//rate[@code='USD']/@ts");
	$ts[0][0] = time();

	# write the updated rates file to disk
	$local_rates->asXml(RATES);

}

# function to return formatted json or xml error msgs
# expects three params - error_number, error_hash & format
# if format missing, default to xml
function generate_error($eno, $error_hash, $format='xml') {
	$msg = $error_hash[$eno];

	if ($format=='json') {
		$json = array('conv' => array('error' => array("code" => "$eno", "msg" => "$msg")));
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
