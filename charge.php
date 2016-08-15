<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Card Payment</title>

    <link href="lib/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="styles.css" rel="stylesheet">

  </head>
  <body>
    <div class="container">

      <div class="header clearfix">
        <nav>
          <ul class="nav nav-pills pull-right">
            <li role="presentation"><a href="mailto:pagos@sg.com.mx">Contact</a></li>
          </ul>
        </nav>
        <h3 class="text-muted">SG - Card Payment</h3>
      </div>

      <div class="jumbotron">

<?php
  require_once('config.php');

  $token  = $_POST['stripeToken'];

  $strAmount  = $_POST['amount'];
  $floatAmount = floatval($strAmount);
  $intAmount = round($floatAmount*100);
  $description  = $_POST['description'];

  $charge = \Stripe\Charge::create(array(
      "amount"   => $intAmount,
      "source"   => $token,
      "currency" => 'usd',
      "description" => $description
  ));

  echo '<p class="lead">Successfully charged $'.$strAmount.' for '.$description.'</p>';

?>
        <p><a class="btn btn-lg btn-success" href="/" role="button">Go back</a></p>
  </div>


</div>
</body>
</html>

