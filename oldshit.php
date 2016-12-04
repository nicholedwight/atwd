if ($format=='json') {
  $json = array(
    'conv' => array(
      "at" => date("d F Y G:i", (int)$at),
      "rate" => $rate,
      'from' => array(
        "code" => $_GET['from'],
        "curr" => 'CURRENCYNAME',
        "loc" => 'LOCATIONS',
        "amnt" => $fromRate,
      ),
      'to' => array(
        "code" => $_GET['to'],
        "curr" => 'CURRENCYNAME',
        "loc" => 'LOCATIONS',
        "amnt" => $toRate,
      ),
    ));
  header('Content-Type: application/json');
  return json_encode($json, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
}
else {

  // Creating the XML to be displayed on conversion
  $xml =  "<?xml version='1.0' encoding='UTF-8'?>";
  $xml .= '<conv>';
  $xml .= '<at>' . date("d F Y G:i", (int)$at) . '</at>';
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

  // return htmlentities($xml);


  //
  // $result = "butts";
  // echo $result;
}
