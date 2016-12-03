<?php

require('config.php');
// require('api/errors.php');
// getCurrencies();
// getCountries();

require_once('generate_error.php');
# currency code array
# kept in the config file
$ccodes = array(
   'CAD','CHF','CNY','DKK',
   'EUR','GBP','HKD','HUF',
   'INR','JPY','MXN','MYR',
   'NOK','NZD','PHP','RUB',
   'SEK','SGD','THB','TRY',
   'USD','ZAR');
# parmeters in URL and format values expected
# kept in the config file
$params = array('from', 'to', 'amnt', 'format');
$frmts = array('xml', 'json');
# turn $_GET params into PHP variables
extract($_GET);
# set format to default to XML
if (!isset($format)) {
	$format = 'xml';
}
$get = array_intersect($params, array_keys($_GET));
if (count($get) < 4) {
	echo generate_error(1100, $error_hash, $format);
	exit;
}
if (count($_GET) > 4) {
	echo generate_error(1200, $error_hash, $format);
	exit;
}
# $to and $from are not recognized currencies
if (!in_array($to, $ccodes) || !in_array($from, $ccodes)) {
	echo generate_error(1000, $error_hash, $format);
	exit;
}
# check for allowed format values
if (!in_array($format, $frmts)) {
	echo generate_error(1200, $error_hash, $format);
	exit;
}
# $amnt is not a decimal value
if (!preg_match('/^[+-]?(\d*\.\d+([eE]?[+-]?\d+)?|\d+[eE][+-]?\d+)$/', $amnt)) {
	echo generate_error(1300,  $error_hash, $format);
	exit;
}
# now read in data files
# update rate if more than 12 hours old
# do conversion
# echo result as XML or JSON depending on format param.


?>
<!-- <!DOCTYPE html>
<html>
<body>
  <form action="convert.php" method="GET">
    <input type='text' name="amnt" />
    <select name="from">
      <?php foreach($codesArray as $codeName) : ?>
        <option id=""><?php echo $codeName;?> </option>
      <?php endforeach; ?>
    </select> to <select name="to">
      <?php foreach($codesArray as $codeName) : ?>
        <option id=""><?php echo $codeName;?> </option>
      <?php endforeach; ?>
    </select>
    <button type="submit" name="submit">Submit</button>
  </form>
</body>
</html> -->
