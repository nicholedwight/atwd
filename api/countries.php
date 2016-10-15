<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$country_by_currency_url = 'https://restcountries.eu/rest/v1/currency/';
$currency = 'USD';
$endpoint = $country_by_currency_url . $currency;
$request = file_get_contents($endpoint);

$responseArray = json_decode($request, true);

var_dump($responseArray[0]["name"]);
$countries = array();

for ($i = 0; $i < count($responseArray); $i++ ) {
    array_push($countries, $responseArray[$i]["name"]);
}

echo '<pre>';
var_dump($countries);
echo '</pre>';
