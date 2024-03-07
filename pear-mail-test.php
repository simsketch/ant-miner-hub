<?php
	include "Mail.php";
	$recipients = 'pizza@gmail.com';

	$headers['From']    = 'pizza@gmail.com';
	$headers['To']      = 'pizza@gmail.com';
	$headers['Subject'] = 'Test message';

	$body = 'Test message';

	$params['sendmail_path'] = '/usr/lib/sendmail';

	// Create the mail object using the Mail::factory method
	$mail_object =& Mail::factory('sendmail', $params);
	
	$host = "localhost";
	$username = "pizza@gmail.com";  
	$password = "Karaoke1234!";  
	$smtp = Mail::factory('smtp', 
		array ('host' => $host, 
		'auth' => true, 
		'username' => $username, 
		'password' => $password)); 

	var_dump($smtp->send($recipients, $headers, $body));

	//var_dump($mail_object->send($recipients, $headers, $body));
	?>