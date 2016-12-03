<?php

require('config.php');
// require('api/errors.php');
// getCurrencies();
// getCountries();

if (isset($_GET['from'])) {
  $countries = simplexml_load_file('data/countries.xml');
  // $fromcname = $countries->xpath("/currencies/currency/ccode[text()='" . $_GET['from'] . "']");
  // $tocname = $countries->xpath("/currencies/currency/ccode[text()='" . $_GET['to'] . "']");
  $currencies = simplexml_load_file('data/currencies.xml');
  // Using Xpath to grab the rate value of the nodes with the code matching the get and to parameters
  $fromRate = $currencies->xpath("/rates/rate[@code='" . $_GET['from'] . "']/@value");
  $toRate = $currencies->xpath("/rates/rate[@code='" . $_GET['to'] . "']/@value");

  // Grabbing the value of the from rate from the objet
  foreach ($fromRate as $key => $value) {
    $fromRate = $value;
  }
  // Grabbing the value of the to rate from the object
  foreach ($toRate as $key => $value) {
    $toRate = $value;
  }
  $rate = (($_GET['amnt']/(float)$fromRate)*(float)$toRate);
  echo $rate;

  $xml =  '<?xml version="1.0" encoding="UTF-8"?>';
  $xml .= '<conv>';
  $xml .= '<rate>' . $rate . '</rate>';
  $xml .= '<from>';
  $xml .= '<code>' . $_GET['from'] . '</code>';
  $xml .= '<curr>' . 'CURRENCYNAME' . '</curr>';
  $xml .= '<loc>' . 'LOCATIONARRAY' . '</loc>';
  $xml .= '<amnt>' . $fromRate . '</amnt>';
  $xml .= '</from>';
  $xml .= '<to>';
  $xml .= '<code>' . $_GET['to'] . '</code>';
  $xml .= '<curr>' . 'CURRENCYNAME' . '</curr>';
  $xml .= '<loc>' . 'LOCATIONARRAY' . '</loc>';
  $xml .= '<amnt>' . $toRate . '</amnt>';
  $xml .= '</to>';
  $xml .= '</conv>';

}

?>

<!DOCTYPE html>
<html>
<body>
  <div class="result"><?php echo htmlentities($xml);?></div>
  <form action="" method="GET">
    <input type='text' name="amnt" />
    <select name="from">
      <?php foreach($ccodes as $codeName) : ?>
        <option id=""><?php echo $codeName;?> </option>
      <?php  endforeach; ?>
    </select>
    to
    <select name="to">
      <?php foreach($ccodes as $codeName) : ?>
        <option id=""><?php echo $codeName;?> </option>
      <?php endforeach; ?>
    </select>
    <select name="format">
      <option value="xml">XML</option>
      <option value="json">JSON</option>
    </select>
    <button type="submit">Submit</button>
  </form>
</body>
</html>
