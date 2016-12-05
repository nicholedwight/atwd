<?
require_once 'config.php';

$xml=simplexml_load_file(RATES_URL) or die("Error: Cannot create object");

$writer = new XMLWriter();
$writer->openURI(RATES);
$writer->startDocument("1.0");
$writer->startElement("rates");

$codes = $xml->xpath('//field[@name="name"]');
$values = $xml->xpath('//field[@name="price"]');
$ts = $xml->xpath('//field[@name="ts"]');

foreach($codes as $key=>$code) {

	if (in_array(substr($code, -3), $ccodes)) {

				$writer->startElement("rate");
					$writer->writeAttribute('code',  substr($code, -3));
					$writer->writeAttribute('value', $values[$key]);
					$writer->writeAttribute('ts', $ts[$key]);
				$writer->endElement();
	}

}

$writer->endDocument();
$writer->flush();
?>
