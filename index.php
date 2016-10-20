<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Card Payment</title>

    <link href="lib/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="styles.css" rel="stylesheet">

    <script src="lib/jquery/jquery-3.1.0.min.js"></script>

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
        <h1>Make a payment to Software Guru</h1>
        <p class="lead">This form enables you to make a secure payment to Nearshore Link (Software Guru) using a credit card. 
         Charge is handled by <a href="https://stripe.com">Stripe</a>.</p>
      </div>
      <p>Please type the amount and description and click the "Continue" button. This will open a form where you can enter your credit card information and
        submit the payment. The charge is processed directly by Stripe and no credit card information goes through Software Guru's servers.</p>

      <?php require_once('./config.php'); ?>

  <div id="error_explanation">
  </div>

      <form action="charge.php" method="post" class="form-horizontal">
       <input type="hidden" id="stripeToken" name="stripeToken">
        <div class="form-group">
          <label class="control-label col-sm-2 col-sm-offset-2" for="amount">Amount</label>
          <div class="input-group col-sm-3">
            <div class="input-group-addon">$</div>
            <input class="form-control" id="amount" name="amount" type="text" placeholder="">
            <div class="input-group-addon">USD</div>
          </div>
        </div>

        <div class="form-group">
          <label class="control-label col-sm-2 col-sm-offset-2" for="textinput">Description</label>
          <input class="col-md-6" id="description" name="description" type="text" placeholder="Will appear in your statement">
        </div>
        <div class="form-group">
          <button class="center-block btn btn-success" id="Continue">Continue</button>
        </div>
      </form>

      <footer class="footer">
        <p>Powered by Stripe.</p>
      </footer>

    </div> <!-- /container -->

<script src="https://checkout.stripe.com/checkout.js"></script>
<script>
  var handler = StripeCheckout.configure({
    key: '<?php echo $stripe['publishable_key'] ?>',
    image: '<?php echo $stripe['image'] ?>',
    name: '<?php echo $stripe['company_name'] ?>',
    locale: 'auto',
    allowRememberMe: false,
    zipCode: true,
    token: function(token) {
      $('input#stripeToken').val(token.id);
      $('form').submit();
    }
  });

  $('#Continue').on('click', function(e) {
    e.preventDefault();
    $('#error_explanation').html('');

    var amount = $('input#amount').val();
    var desc = $('input#description').val();
    amount = amount.replace(/$/g, '').replace(/,/g, '')
    amount = parseFloat(amount);

    if (isNaN(amount)) {
      $('#error_explanation').html('<p>Please enter a valid amount.</p>');
    }
    else if (amount < 2.00) {
      $('#error_explanation').html('<p>Payment must be at least $2.</p>');
    }
    else {
      amount = amount * 100; // Needs to be an integer!
      handler.open({
        amount: Math.round(amount),
        description: desc
      })
    }
  });

  // Close Checkout on page navigation:
  $(window).on('popstate', function() {
    handler.close();
  });
</script>

  </body>
</html>

