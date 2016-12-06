<?php

// include('../config.php');
include('../convert.php');
$ccodes = array(
   'CAD','CHF','CNY','DKK',
   'EUR','GBP','HKD','HUF',
   'INR','JPY','MXN','MYR',
   'NOK','NZD','PHP','RUB',
   'SEK','SGD','THB','TRY',
   'USD','ZAR');

if (!isset($_GET['from'])) { ?>
  <!DOCTYPE html>
  <html>
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Currency API</title>
    <link rel="stylesheet" href="./dist/assets/css/main.css">
  </head>
  <body>
    <header>
      <div class="user">
        <div class="user-name">
          <span>13000673</span>
        </div>
      </div>

      <div class="main-nav">
        <a href='#' class="current">Currency API Interface</a>
      </div>
    </header>
    <div class="form-content">
      <div class="InterfaceAction section">
        <h2 class="heading">Choose an action</h2>
        <div class="InterfaceAction__input">
          <input type="radio" id="post" value="post" name="InterfaceAction__radio" checked="checked">
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
      </div>
      <!--Form for updating-->
      <form action="../currPost.php" id="postform" method="post">
        <div class="CurrencyCode section single-margin--top" id="curcode">
          <label for="code" class="heading">Currency Code</label>
          <select name="code" class="input__text input__text-lg">
            <?php foreach($ccodes as $codeName) : ?>
              <option id=""><?php echo $codeName;?></option>
            <?php  endforeach; ?>
          </select>
        </div>
        <div class="CurrencyRate single-margin--top" id="currate">
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
      <form action="../currPut.php" id="putform" method="get">
        <div class="CurrencyCode section single-margin--top" id="curcode">
          <label for="code" class="heading">Currency Code</label>
          <input name="code" type="text" class="input__text input__text-sm" value="" placeholder="Code">
        </div>

        <div class="CurrencyName section single-margin--top" id="curname">
          <label for="name" class="heading">Currency Name</label>
          <input name="name" type="text" class="input__text input__text-md" value="" placeholder="Name">
        </div>

        <div class="CurrencyRate single-margin--top" id="currate">
          <label for="rate" class="heading">Currency Rate ($ = 1)</label>
          <input name="rate" type="text" class="input__text input__text-sm amntinput" value="" placeholder="Rate">
        </div>

        <div class="Countries section single-margin--top" id="countries">
          <label for="locations" class="heading">Countries (comma seperated)</label>
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
      <form action="currDel.php" id="deleteform" method="delete">
        <div class="CurrencyCode section single-margin--top" id="curcode">
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
    </div>

  <script src="./dist/assets/js/jquery.js"></script>
  <script src="./dist/assets/js/main.js"></script>
  </body>
  </html>
<?php } ?>
