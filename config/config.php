<?php
require_once('stripe-php/lib/Stripe.php');
// Set your secret key: remember to change this to your live secret key in production
// See your keys here https://manage.stripe.com/account

$stripe = array(
"secret_key"        => "sk_live_6SfP2cSgoy5oNl8Tan8eWSJV",
"publishable_key"   => "pk_live_CRM6aOQ11RfcncXdqX8jKYpB"
);

Stripe::setApiKey($stripe['secret_key'] );

?>