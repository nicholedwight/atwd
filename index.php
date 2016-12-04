<?php

require('config.php');
// include('convert.php');

// If the conversion form has been submitted, call convert function and display result in response field
// if (isset($_GET['from'])) {
//   $result = convert($_GET['from'], $_GET['to'], $_GET['amnt'], $_GET['format']);
// }
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
      <label for="code" class="heading">Currency Code</label>
      <select name="code" class="input__text input__text-lg">
        <?php foreach($ccodes as $codeName) : ?>
          <option id=""><?php echo $codeName;?> </option>
        <?php  endforeach; ?>
      </select>
    </div>
    <div class="CurrencyRate" id="currate">
      <label for="rate" class="heading">Currency Rate ($ = 1)</label>
      <input name="rate" type="text" class="input__text input__text-sm amntinput" value="" placeholder="Rate">
    </div>
    <div class="ResponseMessage section" id="submitMessage">
      <pre lang="xml">
        <p class="ResponseMessage__text" id="postresult"></p>
      </pre>
    </div>
    <div class="Submit section">
      <input type="submit" class="Submit__btn" value="Submit">
    </div>
  </form>

  <!-- Form for creating a new currency -->
  <form action="currPut.php" id="putform" method="GET">
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
      <input name="rate" type="text" class="input__text input__text-sm amntinput" value="" placeholder="Rate">
    </div>

    <div class="Countries section" id="countries">
      <label for="locations" class="heading">Countries (comma seperated if 1+)</label>
      <input name="locations" type="text" class="input__text input__text-lg" value="" placeholder="Countries">
    </div>

    <div class="ResponseMessage section" id="submitMessage">
      <pre lang="xml">
        <p class="ResponseMessage__text" id="putresult"></p>
      </pre>
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
    <div class="ResponseMessage section" id="submitMessage">
      <pre lang="xml">
        <p class="ResponseMessage__text" id="deleteresult"></p>
      </pre>
    </div>
    <div class="Submit section">
      <input type="submit" class="Submit__btn" value="Submit">
    </div>
  </form>

  <form action="convert.php" id="convertform">
    <div class="Rate section" id="amnt">
      <label for="amnt" class="heading">Amount</label>
      <input id="convamnt" name="amnt" type="text" class="input__text input__text-md amntinput" value="" placeholder="Amount">
    </div>
    <div class="From section" id="from">
      <label for="from" class="heading">From</label>
      <select id="fromcode" name="from" class="input__text input__text-lg">
        <?php foreach($ccodes as $codeName) : ?>
          <option id=""><?php echo $codeName;?></option>
        <?php  endforeach; ?>
      </select>
    </div>
    <div class="To section" id="to">
      <label for="to" class="heading">To</label>
      <select id="tocode" name="to" class="input__text input__text-lg">
        <?php foreach($ccodes as $codeName) : ?>
          <option id=""><?php echo $codeName;?></option>
        <?php  endforeach; ?>
      </select>
    </div>
    <div class="Format section" id="format">
      <label for="format" class="heading">Format</label>
      <select id="format" name="format" class="input__text input__text-lg">
          <option id="xml" value="xml">xml</option>
          <option id="json" value="json">json</option>
      </select>
    </div>
    <div class="Submit section">
      <input type="submit" class="Submit__btn" value="Submit">
    </div>
    <div class="ResponseMessage section" id="submitMessage">
      <pre lang="xml">
        <p class="ResponseMessage__text" id="convertresult"></p>
      </pre>
    </div>
  </form>

<script src="dist/assets/js/jquery.js"></script>
<script src="dist/assets/js/main.js"></script>
</body>
</html>
