<?php
	// You need to install the sendgrid client library so run: composer require sendgrid/sendgrid
	require 'vendor/autoload.php';
	// contains a variable called: $API_KEY that is the API Key.
    // You need this API_KEY created on the Sendgrid website.
    // require 'lib/SendGrid/Email.php';
	// include_once('credentials.php');
$API_KEY = "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"; 	
$email = new \SendGrid\Mail\Mail(); 
$email->setFrom("deba@mrfixit.ng", "Fixit");
$email->setSubject("A message from Me");
$email->addTo("degrapheng@gmail.com", "DegrapheTech");
$email->addContent("text/plain", "Hey there world");
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