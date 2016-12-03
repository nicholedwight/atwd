<?php

require('config.php');
// require('api/errors.php');
// getCurrencies();
// getCountries();

// $from = $GET('from');
// $to   = $_GET('to');
// $amount = $_GET('amnt');
//
// $conversion_rate  = $rates[$from] / $rates[$to];
// $converted_amount = round ($amount / $conversion_rate, 2);
function convert($from, $to, $amnt) {
  echo $from;
}
?>

<!DOCTYPE html>
<html>
<body>
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
  <!-- <form method="post" action="convert.php">
    <div class="InterfaceTitle">
      <h1 class="heading--primary">Currency API Interface</h1>
    </div>
    <div class="InterfaceAction section">
      <h2 class="heading">Action</h2>
      <div class="InterfaceAction__input">
        <input type="radio" value="post" name="InterfaceAction__radio">
        <label>Post</label>
      </div>
      <div class="InterfaceAction__input">
        <input type="radio" value="put" name="InterfaceAction__radio">
        <label>Put</label>
      </div>
      <div class="InterfaceAction__input">
        <input type="radio" value="delete" name="InterfaceAction__radio">
        <label>Delete</label>
      </div>
    </div>
    <div class="CurrencyCode section">
      <h2 class="heading">Currency Code</h2>
      <input type="text" class="input__text input__text-sm" value="" placeholder="Code">
    </div>
    <div class="CurrencyName section">
      <h2 class="heading">Currency Name</h2>
      <input type="text" class="input__text input__text-md" value="" placeholder="Name">
    </div>
    <div class="CurrencyRate">
      <h2 class="heading">Currency Rate ($ = 1)</h2>
      <input type="text" class="input__text input__text-sm" value="" placeholder="Rate">
    </div>
    <div class="Countries section">
      <h2 class="heading">Countries (comma seperated if 1+)</h2>
      <input type="text" class="input__text input__text-lg" value="" placeholder="Countries">
    </div>
    <div class="Submit section">
      <input type="submit" class="Submit__btn" value="Submit">
    </div>
  </form> -->
</body>
</html>
