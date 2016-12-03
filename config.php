<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
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
$params = array('from', 'to', 'amnt', 'format');
$frmaction = array('post', 'put', 'delete');
$frmpost = array('code', 'rate');
$frmput = array('code', 'name', 'rate', 'countries');
$frmdelete = array('code');

$update_interval = 43200;

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
