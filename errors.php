<?php
$missingParameter = <<<XML
<?xml version='1.0' standalone='yes'?>
  <conv>
    <error>
      <code>1100</code>
      <msg>Required parameter is missing</msg>
    </error>
  </conv>
XML;

$currencyNotRecognised = <<<XML
<?xml version='1.0' standalone='yes'?>
  <conv>
    <error>
      <code>1000</code>
      <msg>Currency type not recognized</msg>
    </error>
  </conv>
XML;

$parameterNotRecognised = <<<XML
<?xml version='1.0' standalone='yes'?>
  <conv>
    <error>
      <code>1200</code>
      <msg>Parameter not recognized</msg>
    </error>
  </conv>
XML;

$invalidAmount = <<<XML
<?xml version='1.0' standalone='yes'?>
  <conv>
    <error>
      <code>1300</code>
      <msg>Currency amount must be a decimal number</msg>
    </error>
  </conv>
XML;

$error = <<<XML
<?xml version='1.0' standalone='yes'?>
  <conv>
    <error>
      <code>1400</code>
      <msg>Error in service</msg>
    </error>
  </conv>
XML;

?>
