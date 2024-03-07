<?php
//this works with no issue locally using the regular smtp/25 config for xampp
var_dump(mail("pizza@gmail.com","Success","Thanks, that works"));
// include('Mail.php');

// $recipients = 'wejustdoitall@gmail.com';

// $headers['From']    = 'pizza@gmail.com';
// $headers['To']      = 'wejustdoitall@gmail.com';
// $headers['Subject'] = 'Test message';

// $body = 'Test message foxtrot';

// $mail_object =& Mail::factory('sendmail');

// var_dump($mail_object->send($recipients, $headers, $body));
?>