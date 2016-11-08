<?php

require('api/config.php');
// require('api/errors.php');
getCurrencies();



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
