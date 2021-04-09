<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require_once __DIR__ . '/phpmailer/Exception.php';
require_once __DIR__ . '/phpmailer/PHPMailer.php';
require_once __DIR__ . '/phpmailer/SMTP.php';

// passing true in constructor enables exceptions in PHPMailer
$mail = new PHPMailer(true);

try {
    $contact = 'info@sanjaysteelco.com';
    $clientname = $_POST['name'];
    $clientemail = $_POST['email'];
    $subject = $_POST['subject'];
    $message = $_POST['message'];
    $from = 'sanjaysteel2021@gmail.com';

    // Server settings
    $mail->isSMTP();
    $mail->Host = 'smtp.gmail.com';
    $mail->SMTPAuth = true;
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
    $mail->Port = 587;

    $mail->Username = $from; // YOUR gmail email
    $mail->Password = 'Sanjay@2020'; // YOUR gmail password

    // Sender and recipient settings
    $mail->setFrom($from, 'Sanjay');
    $mail->addAddress($contact, 'Sanjay');
    $mail->addReplyTo($contact, 'Sanjay'); // to set the reply to

    // Setting the email content
    $mail->IsHTML(true);
    $mail->Subject = "Message Received(Website Contact Page) ".$subject;
    $mail->Body = $message.'<br>ClientName is: '.$clientname.' Client Email is: '.$clientemail;
    $mail->AltBody = 'Plain text message body for non-HTML email client. Gmail SMTP email body.';

    $mail->send();
    echo "Email message sent.";
} catch (Exception $e) {
    echo "Error in sending email. Mailer Error: {$mail->ErrorInfo}";
}

?>