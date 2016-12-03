<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);


function getCurrencies() {
  $currencyCodes = array(
      "CAD", "CHF", "CNY", "DKK", "EUR", "GBP", "HDK", "HUF",
      "INR", "JPY", "MXN", "MYR", "NOK", "NZD", "PHP", "RUB",
      "SEK", "SGD", "THB", "TRY", "USD", "ZAR"
  );

  $apiKey = '6d7de6f2f6410e006fd8850568b2eee2';


  $writer = new XMLWriter();
  $writer->openURI('./data/currencies.xml');
  $writer->startDocument("1.0");
  $writer->startElement("rates");

  $json = file_get_contents('http://www.apilayer.net/api/live?access_key='.$apiKey.'&format=1');

  $object = json_decode($json, true);

  $rates = $object['quotes'];
  $timestamp = $object['timestamp'];

  foreach ($rates as $key => $value) {
      foreach ($currencyCodes as $currencyCode) {
          $code = substr($key, -3);
          if ($code == $currencyCode) {
              $writer->startElement("rate");
              $writer->writeAttribute('code', $code);
              $writer->writeAttribute('value', $value);
              $writer->writeAttribute('ts', $timestamp);
              $writer->endElement();
          }
      }
  }

  $writer->endDocument();
  $writer->flush();
  // $writer->close();

}

function getCountries() {
  $currencyCodes = array(
      "CAD", "CHF", "CNY", "DKK", "EUR", "GBP", "HDK", "HUF",
      "INR", "JPY", "MXN", "MYR", "NOK", "NZD", "PHP", "RUB",
      "SEK", "SGD", "THB", "TRY", "USD", "ZAR"
  );

  $apiKey = '6d7de6f2f6410e006fd8850568b2eee2';
  $jsonNames = file_get_contents('http://www.apilayer.net/api/list?access_key='.$apiKey.'&format=1');
  $objectNames = json_decode($jsonNames, true);
  $countryNames = $objectNames['currencies'];

  $xml = new SimpleXMLElement('<currencies />');

  $json = file_get_contents('https://restcountries.eu/rest/v1/all');

  $data = json_decode($json, true);

  // Foreach of the 22 currencies
  foreach ($currencyCodes as $ccode) {
    // Open root node and one of the 22 child currencies
    $currency = $xml->addChild('currency');
    $currency->addChild('ccode', $ccode);
    // foreach country from the json object
    foreach ($data as $country) {
      $countryName = $country['name'];
      // define array of currencies
      $currencies = implode(', ', $country['currencies']);
      // if one of the currencies from the json object match one of the 22 required currency codes, add the country name
      if ($currencies == $ccode) {
        foreach ($countryNames as $key => $value) {
          if ($currencies == $key) {
            if (!isset($currency->cname)) {
              $currency->addChild('cname', $value);
            }
          }
        }
        $currency->addChild('country', $countryName);
      }
    }

  }

  $xml->asXML("./data/countries.xml");
}
