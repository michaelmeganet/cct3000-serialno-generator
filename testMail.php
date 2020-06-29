<?php
if (isset($_POST['submitSendMail'])){
    $recipient = $_POST['address'];
    $vouchertype = $_POST['radioRM'];
}
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require './assets/PHPMailer/src/Exception.php';
require './assets/PHPMailer/src/PHPMailer.php';
require './assets/PHPMailer/src/SMTP.php';

$mail = new PHPMailer(true);

try {
    //Server settings
    $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      // Enable verbose debug output
    $mail->isSMTP();                                            // Send using SMTP
    $mail->Host       = 'smtp.gmail.com';                    // Set the SMTP server to send through
    $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
    $mail->Username   = 'claudio.christyo@gmail.com';                     // SMTP username
    $mail->Password   = 'thraxelonrules50124aaa';                               // SMTP password
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;         // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
    $mail->Port       = 587;                                    // TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above

    //Recipients
    $mail->setFrom('claudio.christyo@gmail.com', 'Claudio');
    #$mail->addAddress('joe@example.net', 'Joe User');     // Add a recipient
    $mail->addAddress($recipient);               // Name is optional
    $mail->addReplyTo('claudio.christyo@gmail.com', 'Claudio');
    #$mail->addCC('cc@example.com');
    #$mail->addBCC('bcc@example.com');

    // Attachments
    #$mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
    #$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name

    // Content
    $text_encode = urlencode("You scanned the image!");
    $mail->isHTML(true);                                  // Set email format to HTML
    $mail->Subject = 'Here is the subject';
    $mail->Body    = "This is a test Message!<br>"
                    . "You got a voucher of $vouchertype!<br>"
                    . "Scan This please !<br>"
                    ."<img src='qrcodeimage.php?code=$text_encode'/>";
    $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

    $mail->send();
    echo 'Message has been sent';
} catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}