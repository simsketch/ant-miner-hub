<?php
// Import PHPMailer classes into the global namespace
// These must be at the top of your script, not inside a function

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

//Load Composer's autoloader
require 'vendor/autoload.php';

$mail = new PHPMailer(true);                              // Passing `true` enables exceptions
try {
    //Server settings
    // $mail->SMTPOptions = array(
    // 'tls' => array(
    //     'verify_peer' => false,
    //     'verify_peer_name' => false,
    //     'allow_self_signed' => true
    // )
    // );
    $mail->SMTPDebug = 3;                                 // Enable verbose debug output
    $mail->isSMTP();                                      // Set mailer to use SMTP
    $mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
    $mail->Host = 'mail1.antminerhub.com';  // Specify main and backup SMTP servers
    $mail->Port = 25;                                    // TCP port to connect to
    $mail->SMTPAuth = true;                               // Enable SMTP authentication
    $mail->Username = 'orders@antminerhub.com';                 // SMTP username
    $mail->Password = 'JxCMqFjzMY';                           // SMTP password
    // $mail->SMTPKeepAlive = true;  
    // $mail->SMTPAutoTLS  = false;                            // Enable TLS encryption, `ssl` also accepted

    //Recipients
    $mail->setFrom('orders@antminerhub.com', 'Antminerhub Orders');
    $mail->addAddress('pizza@gmail.com', 'Antminerhub User');     // Add a recipient
    $mail->addAddress('wejustdoitall@gmail.com');               // Name is optional
    $mail->addReplyTo('info@antminerhub.com', 'Antminerhub Support');
    // $mail->addCC('cc@example.com');
    // $mail->addBCC('bcc@example.com');

    //Attachments
    //$mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
    //$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name

    //Content
    $mail->isHTML(true);                                  // Set email format to HTML
    $mail->Subject = 'Here is the subject';
    $mail->Body    = 'This is the HTML message body <b>in bold!</b>';
    $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

    $mail->send();
    echo 'Message has been sent';
} catch (Exception $e) {
    echo 'Message could not be sent. Mailer Error: ', $mail->ErrorInfo;
}
?>