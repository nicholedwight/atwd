<?php
// ini_set('display_errors', 1);
// ini_set('display_startup_errors', 1);
// ini_set('precision', 3);
// error_reporting(E_ALL);
#############################################################
# file: 	config.php                                        #
# author:	p.chatterjee@uwe.ac.uk                            #
# purpose:	config file for RESTful currency conversion     #
  # version:  1.3 14/11/2016                                #
#############################################################

# set timezone
@date_default_timezone_set("GMT");

# set URL's constants for external data
define('RATES_URL',	'http://finance.yahoo.com/webservice/v1/symbols/allcurrencies/quote?format=xml');
define('COUNTRIES_URL', 'http://www.currency-iso.org/dam/downloads/lists/list_one.xml');

# set path to local xml files
define('RATES',	'data/rates.xml');
define('COUNTRIES', 'data/countries.xml');

# currency code array
$ccodes = array(
   'CAD','CHF','CNY','DKK',
   'EUR','GBP','HKD','HUF',
   'INR','JPY','MXN','MYR',
   'NOK','NZD','PHP','RUB',
   'SEK','SGD','THB','TRY',
   'USD','ZAR');

# url params
$params = array('from', 'to', 'amnt', 'format', 'code', 'name', 'rate', 'locations');
$frmts = array('xml', 'json');
$frmaction = array('post', 'put', 'delete');
$frmpost = array('code', 'rate');
$frmput = array('code', 'name', 'rate', 'locations');
$frmdelete = array('code');


# error_hash to hold error numbers and messages
$error_hash = array(
	1000 => 'Currency type not recognized',
	1100 => 'Required parameter is missing',
	1200 => 'Parameter not recognized',
	1300 => 'Currency amount must be a decimal number',
	1400 => 'Error in service',
	2000 => 'Method not recognized or is missing',
	2100 => 'Rate in wrong format or is missing',
	2200 => 'Currency code in wrong format or is missing',
	2300 => 'Country name in wrong format or is missing',
	2400 => 'Currency code not found for update',
	2500 => 'Error in service'
);

require_once('functions.php');

# turn $_GET params into PHP variables
extract($_GET);
# set format to default to XML
if (!isset($format)) {
	$format = 'xml';
}

// if there's a code param, make sure it's uppercase
if (isset($_GET['code'])) {
  if (strtoupper($_GET['code']) != $_GET['code']) {
  	echo generate_error(2200,  $error_hash, $format);
  	exit;
  }
// Making sure the code param is 3 characters long
  if (strlen($_GET['code']) != 3) {
  	echo generate_error(2200,  $error_hash, $format);
  	exit;
  }
}

// Making sure the rate param is a float
if (isset($_GET['rate'])) {
  if (!preg_match('/^[+-]?(\d*\.\d+([eE]?[+-]?\d+)?|\d+[eE][+-]?\d+)$/', $_GET['rate'])) {
  	echo generate_error(2100,  $error_hash, $format);
  	exit;
  }
}


if (isset($_GET['locations'])) {
  // Checking if the locations param contains a number, if it does, throw the error
  if (preg_match('/\d/', $_GET['locations'])) {
  	echo generate_error(2300, $error_hash, $format);
  	exit;
  }
}

if (isset($_GET['to'])) {
  // Checking if the format param is set
  if (!isset($_GET['format'])) {
  	echo generate_error(1100, $error_hash, $format);
  	exit;
  }
}

// If the form method is not set
if ($_SERVER['REQUEST_METHOD'] != 'POST' && $_SERVER['REQUEST_METHOD'] != 'GET' && $_SERVER['REQUEST_METHOD'] != "DELETE") {
  echo generate_error(2000, $error_hash, $format);
}

$get = array_intersect($params, array_keys($_GET));
// This errors the index.php page as there are no params set
if (count($get) < 1) {
	echo generate_error(1100, $error_hash, $format);
	exit;
}

if (count($_GET) > 4) {
	echo generate_error(1200, $error_hash, $format);
	exit;
}
# $to and $from are not recognized currencies
if (isset($to) || isset($from)){
  if (!in_array($to, $ccodes) || !in_array($from, $ccodes)) {
  	echo generate_error(1000, $error_hash, $format);
  	exit;
  }
}
# check for allowed format values
if (!in_array($format, $frmts)) {
	echo generate_error(1200, $error_hash, $format);
	exit;
}
# $amnt is not a decimal value
if (isset($amnt)) {
  if (!preg_match('/^[+-]?(\d*\.\d+([eE]?[+-]?\d+)?|\d+[eE][+-]?\d+)$/', $amnt)) {
  	echo generate_error(1300,  $error_hash, $format);
  	exit;
  }
}


// Grabbing the existing rates file
$ratesFile = simplexml_load_file(RATES);
$update_interval = 43200;
// Setting the current time
$newtime = time();
// Checktime is now minus 12 hours ago
$checktime = $newtime - $update_interval;
$nodes = $ratesFile->xpath("/rates/rate/@ts");
$toBeUpdatedArray = [];
// Looping through each node, if timestamp is older than 12 hours,
// add currency code from node to toBeUpdatedArray
foreach ($nodes as $key => $value) {
  if ($value < $checktime ){
    $nodeToUpdate = $ratesFile->xpath("/rates/rate[@ts='" . $value . "']/@code");
    $timestamp = $value;
    foreach ($nodeToUpdate as $key => $value) {
      $nodeToUpdate = $value;
      array_push($toBeUpdatedArray, $nodeToUpdate);
    }
    update_rates($toBeUpdatedArray);
  }
}

# determine if local or UWE server
if (stristr($_SERVER['HTTP_HOST'], 'local')) {
	$local = TRUE;
} else {
	$local = FALSE;
}

# determine location of files and the URL of the site:
# allow for development on different servers.
if ($local) {

	# always debug when running locally:
	$debug = TRUE;

	# define the constants:
	define ('BASE_URI', '/nichole/Sites/ATWD/assignment/');
	define ('BASE_URL',	'http://localhost:8888//ATWD/assignment/');
  $BASE_URL = 'http://localhost:8888/ATWD/assignment/';
} else {

	define ('BASE_URI', '/public_html/atwd1/assignment/');
	define ('BASE_URL',	'http://isa.cems.uwe.ac.uk/~a2-dwight/atwd1/assignment/');

}

############################################################
# Error Management

# Create Error Handler
// function crest_error_handler ($e_number, $e_message, $e_file, $e_line, $e_vars) {
//
// 	global $debug;
//
// 	$contact_email = 'ashley2.dwight@live.uwe.ac.uk';
//
// 	# Build the error message.
// 	$message = "An error occurred in script '$e_file' on line $e_line: \n<br />$e_message\n<br />";
//
// 	# Add the date and time.
// 	$message .= "Date/Time: " . date('n-j-Y H:i:s') . "\n<br />";
//
// 	# Append $e_vars to the $message.
// 	$message .= "<pre>" . print_r ($e_vars, 1) . "</pre>\n<br />";
//
// 	if ($debug) { # show the error.
//
// 		echo '<p class="error">' . $message . '</p>';
//
// 	} else {
//
// 		# Log the error:
// 		error_log ($message, 1, $contact_email); #send email.
//
// 		# Only print an error message if the error isn't a notice or strict.
// 		if ( ($e_number != E_NOTICE) && ($e_number < 2048)) {
// 			echo '<p class="error">A system error occurred. We apologize for the inconvenience.</p>';
// 		}
//
// 	} # End of $debug IF.
//
// } # End of crest_error_handler() definition.
//
// # Use this error handler:
// set_error_handler ('crest_error_handler');

# End of Error Management
############################################################
?>
