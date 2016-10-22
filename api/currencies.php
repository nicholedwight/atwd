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

function getCurrencyNames() {
  global $currencyNames;

  $exchange_rate_url = 'https://openexchangerates.org/api/currencies.json';

  $json_data = file_get_contents($exchange_rate_url);
  $namesArray = json_decode($json_data, true);

  // echo "<pre>";
  // var_dump($responseArray);
  // echo "</pre>";
  // $namesArray = array();
  //
  // foreach($responseArray as $keys => $values) {
  //     array_push($namesArray, $values);
  // }

  // echo "<pre>";
  // var_dump($namesArray);
  // echo "</pre>";
  $currencyNames = $namesArray;

  return $currencyNames;

}

function getCurrencies() {
  global $result;
  global $currencyNames;

  $API_KEY = "18947b8fdda74706b676b4ab92faa09d";
  $exchange_rate_url = 'https://openexchangerates.org/api/latest.json?app_id=';

  $json_data = file_get_contents($exchange_rate_url  . $API_KEY);
  $data = json_decode($json_data, true);
  $rates = array_slice($data, 4);
  $xml = new SimpleXMLElement('<currencies/>');


  foreach($rates as $keys => $values) {
    foreach($values as $key => $value) {
      getLocations($key);
      getCurrencyNames();
      $currency = $xml->addChild('currency');
      $currency->addAttribute('rate', $value);
      $currency->addAttribute('code', $key);
      foreach($currencyNames as $keyName => $valueName) {
        if($keyName == $key) {
          $currency->addChild('name', $valueName);
        }
      }
      $locations = $currency->addChild('locations');
      foreach($result as $location) {
        $locations->addChild('location', $location);
      }

    }
  }

  // Header('Content-type: text/xml');
  $xml->asXML("./data/currencies.xml");
}
