Simple app to receive credit card payments using Stripe.

Code is PHP + JavaScript.

The special thing about this app is that it uses <a href="https://stripe.com/docs/checkout">Checkout</a> but allows the user to type an amount and description (most of the reference code available for Checkout has hardcoded amount and description). So, it is pretty much a PHP version of https://stripe.com/docs/recipes/variable-amount-checkout (which is in Ruby).

For convenience, this repository already includes the PHP library for Stripe. But if you wan't to reinstall from scratch, you can remove the "vendor" directory and do "composer install". It also includes copies of Bootstrap and JQuery but you can always download a fresh copy or load from a CDN.

Steps:
 1. Set up your Stripe account.
 2. Modify config.php with your Stripe account info (API keys and such). Use your test keys first.
 3. Once you've tested it out, put in your production keys.
 
