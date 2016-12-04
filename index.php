<?php

require('config.php');
// require('api/errors.php');
// getCurrencies();
// getCountries();
include('convert.php');
if (isset($_GET['from'])) {
  $result = convert($_GET['from'], $_GET['to'], $_GET['amnt'], $_GET['format']);

  // header("Content-type: text/xml");
  // echo $xml->asXML();
  // echo $result;
}
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Currency API</title>
  <link rel="stylesheet" href="dist/assets/css/main.css">
</head>
<body>
  <!-- <form action="" method="GET">
    <input type='text' name="amnt" value="" />
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
    <?php if (isset($_GET['from'])) { ?>
    <div class="ResponseMessage section" id="submitMessage">
      <p class="ResponseMessage__text">
        <?php echo $result; ?></p>
    </div>
    <?php } ?>
  </form> -->
    <div class="InterfaceTitle">
    <h1 class="heading--primary">Currency API Interface</h1>
  </div>
  <div class="InterfaceAction section">
    <h2 class="heading">Action</h2>
    <div class="InterfaceAction__input">
      <input type="radio" id="post" value="post" name="InterfaceAction__radio">
      <label for="post">Post</label>
    </div>
    <div class="InterfaceAction__input">
      <input type="radio" id="put" value="put" name="InterfaceAction__radio">
      <label for="put">Put</label>
    </div>
    <div class="InterfaceAction__input">
      <input type="radio" id="delete" value="delete" name="InterfaceAction__radio">
      <label for="delete">Delete</label>
    </div>
    <div class="InterfaceAction__input">
      <input type="radio" id="convert" value="convert" name="InterfaceAction__radio" checked="checked">
      <label for="convert">Convert</label>
    </div>
  </div>
  <!--Form for updating-->
  <form action="currPost.php" id="postform">
    <div class="CurrencyCode section" id="curcode">
      <label for="curcode" class="heading">Currency Code</label>
      <select name="curcode" class="input__text input__text-lg">
        <?php foreach($ccodes as $codeName) : ?>
          <option id=""><?php echo $codeName;?> </option>
        <?php  endforeach; ?>
      </select>
    </div>
    <div class="CurrencyRate" id="currate">
      <label for="currate" class="heading">Currency Rate ($ = 1)</label>
      <input name="currate" type="text" class="input__text input__text-sm" value="" placeholder="Rate">
    </div>
    <div class="Submit section">
      <input type="submit" class="Submit__btn" value="Submit">
    </div>
  </form>

  <!-- Form for creating a new currency -->
  <form action="currPut.php" id="putform">
    <div class="CurrencyCode section" id="curcode">
      <label for="code" class="heading">Currency Code</label>
      <input name="code" type="text" class="input__text input__text-sm" value="" placeholder="Code">
    </div>
    <div class="CurrencyName section" id="curname">
      <label for="name" class="heading">Currency Name</label>
      <input name="name" type="text" class="input__text input__text-md" value="" placeholder="Name">
    </div>
    <div class="CurrencyRate" id="currate">
      <label for="rate" class="heading">Currency Rate ($ = 1)</label>
      <input name="rate" type="text" class="input__text input__text-sm" value="" placeholder="Rate">
    </div>
    <div class="Countries section" id="countries">
      <label for="locations" class="heading">Countries (comma seperated if 1+)</label>
      <input name="locations" type="text" class="input__text input__text-lg" value="" placeholder="Countries">
    </div>
    <div class="Submit section">
      <input type="submit" class="Submit__btn" value="Submit">
    </div>
  </form>

  <!-- Form for deleting an existing currency -->
  <form action="currDel.php" id="deleteform">
    <div class="CurrencyCode section" id="curcode">
      <label for="code" class="heading">Currency Code</label>
      <input name="code" type="text" class="input__text input__text-sm" value="" placeholder="Code">
    </div>
    <div class="Submit section">
      <input type="submit" class="Submit__btn" value="Submit">
    </div>
  </form>

  <form action="" id="convertform">
    <div class="Rate section" id="amnt">
      <label for="amnt" class="heading">Amount</label>
      <input name="amnt" type="text" class="input__text input__text-md" value="" placeholder="Amount">
    </div>
    <div class="From section" id="from">
      <label for="from" class="heading">From</label>
      <select name="from" class="input__text input__text-lg">
        <?php foreach($ccodes as $codeName) : ?>
          <option id=""><?php echo $codeName;?> </option>
        <?php  endforeach; ?>
      </select>
    </div>
    <div class="To section" id="to">
      <label for="to" class="heading">To</label>
      <select name="to" class="input__text input__text-lg">
        <?php foreach($ccodes as $codeName) : ?>
          <option id=""><?php echo $codeName;?> </option>
        <?php  endforeach; ?>
      </select>
    </div>
    <div class="Format section" id="format">
      <label for="format" class="heading">Format</label>
      <select name="format" class="input__text input__text-lg">
          <option id="xml">xml</option>
          <option id="json">json</option>
      </select>
    </div>
    <div class="Submit section">
      <input type="submit" class="Submit__btn" value="Submit">
    </div>
    <?php if (isset($_GET['from'])) { ?>
    <div class="ResponseMessage section" id="submitMessage">
      <p class="ResponseMessage__text"><?php echo $result; ?></p>
    </div>
    <?php } ?>
  </form>


</form>

<script src="dist/assets/js/jquery.js"></script>
<script src="dist/assets/js/main.js"></script>
</body>
</html>
