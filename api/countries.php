<?php
function getLocations($code) {
  global $result;

  $country_by_currency_url = 'https://restcountries.eu/rest/v1/currency/';
  $endpoint = $country_by_currency_url . $code;
  $request = file_get_contents($endpoint);

  $responseArray = json_decode($request, true);

  $countries = array();

  for ($i = 0; $i < count($responseArray); $i++ ) {
      array_push($countries, $responseArray[$i]["name"]);
  }

  $result = implode(", ", $countries);

  return $result;
}
