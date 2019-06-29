<?php
	// You need to install the sendgrid client library so run: composer require sendgrid/sendgrid
	require '/vendor/autoload.php';
	// contains a variable called: $API_KEY that is the API Key.
	// You need this API_KEY created on the Sendgrid website.
	include_once('./credentials.php');
	
	$FROM_EMAIL = 'debaosuidecl@gmail.com';
	// they dont like when it comes from @gmail, prefers business emails
	$TO_EMAIL = 'debaosuidecl@gmail.com';
	// Try to be nice. Take a look at the anti spam laws. In most cases, you must
	// have an unsubscribe. You also cannot be misleading.
	$subject = "YOUR_SUBJECT";
	$from = new SendGrid\Email(null, $FROM_EMAIL);
	$to = new SendGrid\Email(null, $TO_EMAIL);
	$htmlContent = '
    <h1>Hello Life is good</h1>
    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Pariatur minima blanditiis amet. Saepe omnis eveniet excepturi dignissimos, ad ut commodi totam tempore alias, deleniti voluptatem exercitationem quam quo dolorem iste.</p>
  ';
	// Create Sendgrid content
	$content = new SendGrid\Content("text/html",$htmlContent);
	// Create a mail object
	$mail = new SendGrid\Mail($from, $subject, $to, $content);
	
	$sg = new \SendGrid($API_KEY);
	$response = $sg->client->mail()->send()->post($mail);
			
	if ($response->statusCode() == 202) {
		// Successfully sent
		echo 'done';
	} else {
		echo 'false';
	}
?>