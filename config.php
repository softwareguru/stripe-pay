<?php
require_once('vendor/autoload.php');

$stripe = array(
  "secret_key"      => "Your secret key",
  "publishable_key" => "Your publishable key",
  "company_name"    => "Your company name",
  "image"           => "Url for your company logo"
);

\Stripe\Stripe::setApiKey($stripe['secret_key']);

/* 
    You can get the image url from the prefilled example at https://stripe.com/docs/checkout#integration-simple
    It should be something like https://s3.amazonaws.com/stripe-uploads/........
    (you need to be logged in with your stripe account). 
*/

?>

