<?php 
/**
 * Embbeded Form minimal integration example
 * 
 * To run the example, go to 
 * hhttps://github.com/lyra/rest-php-example
 */

/**
 * I initialize the PHP SDK
 */
require_once 'vendor/autoload.php';
require_once  'keys.php';
require_once 'helpers.php';

/** 
 * Initialize the SDK 
 * see keys.php
 */
$client = new Lyra\Client();

/**
 * I create a formToken
 */
$store = array("amount" => $_POST['cjprec'], 
"currency" => "USD", 
"orderId" => uniqid("MyOrderId"),
"customer" => array(
  "email" => $_POST['email']
));
$response = $client->post("V4/Charge/CreatePayment", $store);

/* I check if there are some errors */
if ($response['status'] != 'SUCCESS') {
    /* an error occurs, I throw an exception */
    display_error($response);
    $error = $response['answer'];
    throw new Exception("error " . $error['errorCode'] . ": " . $error['errorMessage'] );
}

/* everything is fine, I extract the formToken */
$formToken = $response["answer"]["formToken"];

?>
<!DOCTYPE html>
<html>
<head>
  <meta name="viewport" 
   content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" /> 

  <!-- Javascript library. Should be loaded in head section -->
  <script 
   src="<?php echo $client->getClientEndpoint();?>/static/js/krypton-client/V4.0/stable/kr-payment-form.min.js"
   kr-public-key="<?php echo $client->getPublicKey();?>"
   kr-language="es-PE"
   kr-post-url-success="/plan/?o=<?php echo $_POST['o'];?>&p=<?php echo $_POST['p'];?>&c=<?php echo $_POST['c'];?>">
  </script>

  <!-- theme and plugins. should be loaded after the javascript library -->
  <!-- not mandatory but helps to have a nice payment form out of the box -->
  <link rel="stylesheet" 
   href="<?php echo $client->getClientEndpoint();?>/static/js/krypton-client/V4.0/ext/classic-reset.css">
  <script 
   src="<?php echo $client->getClientEndpoint();?>/static/js/krypton-client/V4.0/ext/classic.js">
  </script>
  <style type="text/css">
    .kr-expiry{
        max-width: 131px !important;
        display: inline-block !important;
    }
    .kr-security-code{
        max-width: 131px !important;
        display: inline-block !important;
    }
    .kr-popin-button {
	    background-color: #46a024 !important;
	    color:#fff !important;
      } 
    .kr-embedded .kr-payment-button {
	    background-color: #46a024 !important;
	    color:#fff !important;
      }
    .kr-installment-number{
	    display:none !important;
      }
    .kr-first-installment-delay{
	    display:none !important;
      }
    </style>
</head>
<body style="padding-top:20px">
  <!-- payment form -->
  <div style="margin: 0 auto;padding: 20px 0px 30px 0px;" class="kr-embedded"
   kr-form-token="<?php echo $formToken;?>">

    <!-- payment form fields -->
    <div class="kr-pan"></div>
    <div class="kr-expiry"></div>
    <div class="kr-security-code"></div>  

    <!-- payment form submit button -->
    <button class="kr-payment-button"></button>

    <!-- error zone -->
    <div class="kr-form-error"></div>
  </div>  
</body>
</html>