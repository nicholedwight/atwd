<?php
// function getLocations($code) {
//   global $result;
//
//   $country_by_currency_url = 'https://restcountries.eu/rest/v1/currency/';
//   $endpoint = $country_by_currency_url . $code;
//   $request = file_get_contents($endpoint);
//
//   $responseArray = json_decode($request, true);
//
//   $countries = array();
//
//   for ($i = 0; $i < count($responseArray); $i++ ) {
//       array_push($countries, $responseArray[$i]["name"]);
//   }
//
//   $result = $countries;
//
//   return $result;
// }
//
// function getCurrencyNames() {
//   global $currencyNames;
//
//   $exchange_rate_url = 'https://openexchangerates.org/api/currencies.json';
//
//   $json_data = file_get_contents($exchange_rate_url);
//   $namesArray = json_decode($json_data, true);
//
//   // echo "<pre>";
//   // var_dump($responseArray);
//   // echo "</pre>";
//   // $namesArray = array();
//   //
//   // foreach($responseArray as $keys => $values) {
//   //     array_push($namesArray, $values);
//   // }
//
//   // echo "<pre>";
//   // var_dump($namesArray);
//   // echo "</pre>";
//   $currencyNames = $namesArray;
//
//   return $currencyNames;
//
// }
//
