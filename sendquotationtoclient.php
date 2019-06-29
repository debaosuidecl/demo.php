<?php
	// You need to install the sendgrid client library so run: composer require sendgrid/sendgrid
	require 'vendor/autoload.php';
	// contains a variable called: $API_KEY that is the API Key.
    // You need this API_KEY created on the Sendgrid website.
    // require 'lib/SendGrid/Email.php';
	// include_once('credentials.php');
$API_KEY = "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"; 	
$email = new \SendGrid\Mail\Mail(); 
$email->setFrom("debaosuidecl@gmail.com", "Example User");
$email->setSubject("Sending with Twilio SendGrid is Fun");
$email->addTo("degrapheng@gmail.com", "Example User");
$email->addContent("text/plain", "and easy to do anywhere, even with PHP");
// $email->addContent(
//     "text/html", "<strong>and easy to do anywhere, even with PHP</strong>"
// );
$sendgrid = new \SendGrid($API_KEY);
if($sendgrid->send($email)){
    echo "Email sent successfully";
}
// try {
//     $response = $sendgrid->send($email);
//     print $response->statusCode() . "\n";
//     print_r($response->headers());
//     print $response->body() . "\n";
// } catch (Exception $e) {
//     echo 'Caught exception: '. $e->getMessage() ."\n";
// }
?>