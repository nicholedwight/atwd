<?php

$API_KEY = "18947b8fdda74706b676b4ab92faa09d";
$exchange_rate_url = 'https://openexchangerates.org/api/latest.json?app_id=' . $API_KEY;
$json = file_get_contents($exchange_rate_url);
$json_array = json_decode($json, JSON_PRETTY_PRINT);


// $test_array = array (
//   'bla' => 'blub',
//   'foo' => 'bar',
//   'another_array' => array (
//     'stack' => 'overflow',
//   ),
// );
//
// $xml = new SimpleXMLElement('<currencies/>');
// array_walk_recursive($json_array, array ($xml, 'addChild'));
// print $xml->asXML();

// echo "<pre>$json</pre>";

echo "<pre>";
var_dump($json_array);
echo "</pre>";
