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

  $list = 'list';
  // currency rates
  $live = 'live';

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
  $writer->close();
}
