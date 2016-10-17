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

  $result = $countries;

  return $result;
}

function getCurrencies() {
  global $result;

  $API_KEY = "18947b8fdda74706b676b4ab92faa09d";
  $exchange_rate_url = 'https://openexchangerates.org/api/latest.json?app_id=';

  $json_data = file_get_contents($exchange_rate_url  . $API_KEY);
  $data = json_decode($json_data, true);
  $rates = array_slice($data, 4);
  $xml = new SimpleXMLElement('<currencies/>');


  echo "<pre>";
  var_dump($result);
  echo "</pre>";

  foreach($rates as $keys => $values) {
    foreach($values as $key => $value) {
      getLocations($key);
      $currency = $xml->addChild('currency');
      $currency->addAttribute('rate', $value);
      $currency->addAttribute('code', $key);
      $currency->addChild('name');
      $locations = $currency->addChild('locations');
      foreach($result as $location) {
        $locations->addChild('location', $location);
      }
    }
  }

  // Header('Content-type: text/xml');
  $xml->asXML("./data/currencies.xml");
}
