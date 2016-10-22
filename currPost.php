<?php
require('api/currencies.php');
getCurrencyCodes();

function update($code) {
  global $result;

  $API_KEY = "18947b8fdda74706b676b4ab92faa09d";
  $exchange_rate_url = 'https://openexchangerates.org/api/latest.json?app_id=';
  $currency = '&symbols=' . $code;
  // $request = file_get_contents($exchange_rate_url  . $API_KEY . $currency);

  echo $exchange_rate_url  . $API_KEY . $currency;
  // $responseArray = json_decode($request, true);
  //
  // $countries = array();
  //
  // for ($i = 0; $i < count($responseArray); $i++ ) {
  //     array_push($countries, $responseArray[$i]["name"]);
  // }
  //
  // $result = $countries;
  //
  // return $result;
}

if(isset($_GET['code'])) {
    update($_GET['code']);
} else {
//show form
?>
<!DOCTYPE html>
<html>
<body>
  <h1>Update Currency</h1>
  <form action="" method="GET">
    <select name="code">
      <?php foreach($codesArray as $codeName) : ?>
        <option id=""><?php echo $codeName;?> </option>
      <?php endforeach; ?>
    </select>
    <button type="submit" name="submit">Submit</button>
  </form>
</body>
</html>

<?php } ?>
