<?php
require_once 'config.php';

$xml=simplexml_load_file(COUNTRIES_URL) or die("Error: Cannot create object");

$writer = new XMLWriter();
$writer->openURI(COUNTRIES);
$writer->startDocument("1.0");
$writer->startElement("currencies");

foreach ($ccodes as $ccode) {

	$nodes = $xml->xpath("//Ccy[.='$ccode']/parent::*");
	$cname =  $nodes[0]->CcyNm;

	$writer->startElement("currency");
		$writer->startElement("ccode");
		$writer->text($ccode);
		$writer->endElement();
		$writer->startElement("cname");
		$writer->text($cname);
		$writer->endElement();
		$writer->startElement("cntry");

		$last = count($nodes) - 1;

		foreach ($nodes as $index=>$node) {
			$writer->text(mb_convert_case($node->CtryNm, MB_CASE_TITLE, "UTF-8"));
			if ($index!=$last) { $writer->text(', ');}
		}
		$writer->endElement();

	$writer->endElement();
}

$writer->endDocument();
$writer->flush();
?>
