<?php

require_once('../includes/PHPMailer/class.phpmailer.php');
//include("class.smtp.php"); // optional, gets called from within class.phpmailer.php if not already loaded
echo 'running';
$mail             = new PHPMailer();

$body             = file_get_contents('../email.html');
$body             = eregi_replace("[\]",'',$body);

$mail->IsSMTP(); // telling the class to use SMTP
$mail->Host       = "mail.theshinemodel.com"; // SMTP server
$mail->SMTPDebug  = 2;                     // enables SMTP debug information (for testing)
                                           // 1 = errors and messages
                                           // 2 = messages only
$mail->SMTPAuth   = true;                  // enable SMTP authentication
$mail->Host       = "mail.theshinemodel.com"; // sets the SMTP server
$mail->Port       = 587;                   // set the SMTP port for the GMAIL server
$mail->Username   = "colin@theshinemodel.com"; // SMTP account username
$mail->Password   = "Lang@t@266";        // SMTP account password

$mail->SetFrom('colin@theshinemodel.com', 'Colin Holding');

$mail->AddReplyTo("colin@theshinemodel.com","Colin Holding");

$mail->MsgHTML($body);

$address = "colin@theshinemodel.com";
$mail->AddAddress($address, "Colin Holding");

//$mail->AddAttachment("../audiofiles/isis.MP3");      // attachment

$mail->Subject    = "PHPMailer Test Subject via smtp, basic with authentication";

$mail->AltBody    = "To view the message, please use an HTML compatible email viewer!"; // optional, comment out and test


if(!$mail->Send()) {
  echo "Mailer Error: " . $mail->ErrorInfo;
} else {
  echo "Message sent!";
}

?>