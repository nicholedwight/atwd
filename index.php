<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include('api/currencies.php');
require('api/errors.php');
getCurrencyCodes();
// getCurrencies();

?>
<!DOCTYPE html>
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
</html>
