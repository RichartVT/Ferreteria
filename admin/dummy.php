<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
require '../vendor/autoload.php';
$mail = new PHPMailer();
$mail->isSMTP();
//Enable SMTP debugging
//SMTP::DEBUG_OFF = off (for production use)
//SMTP::DEBUG_CLIENT = client messages
//SMTP::DEBUG_SERVER = client and server messages
$mail->SMTPDebug = SMTP::DEBUG_OFF;
$mail->Host = 'smtp.gmail.com';
$mail->Port = 465;
$mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
$mail->SMTPAuth = true;
$mail->Username = '21030017@itcelaya.edu.mx';
$mail->Password = '';
$mail->setFrom('21030017@itcelaya.edu.mx', 'GUSTAVO RAMIREZ MIRELES');
//$mail->addReplyTo('replyto@example.com', 'First Last');
$mail->addAddress('gusramireles46@gmail.com', 'Gustavo Ramírez Mireles');
$mail->Subject = 'Hola mundo';
$mail->msgHTML("Hola mundo");
if (!$mail->send()) {
    echo 'Mailer Error: ' . $mail->ErrorInfo;
} else {
    echo 'Message sent!';
}