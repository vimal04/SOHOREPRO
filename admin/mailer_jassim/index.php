<?php
require_once('class.phpmailer.php');

$mail = new PHPMailer(); // create a new object
$mail->IsSMTP(); // enable SMTP
$mail->SMTPDebug = 1; // debugging: 1 = errors and messages, 2 = messages only
$mail->SMTPAuth = true; // authentication enabled
$mail->SMTPSecure = 'ssl'; // secure transfer enabled REQUIRED for GMail
$mail->Host = "smtp.gmail.com";
$mail->Port = 465; // or 587
$mail->IsHTML(true);
$mail->Username = "mohamedjassim5@gmail.com";
$mail->Password = "njassimndhalalnsameer85412";
//$mail->SetFrom("example@gmail.com");
$mail->Subject = "Test";
$mail->Body = "hello";
$mail->AddAddress("n.mohamedjassim@gmail.com");
 if(!$mail->Send())
    {
    echo "Mailer Error: " . $mail->ErrorInfo;
    }
    else
    {
    echo "Message has been sent";
    }



//define('GUSER', 'jassim.colan@gmail.com'); // GMail username
//define('GPWD', 'njassimndhalalnsameer85412'); // GMail password
//
//function smtpmailer($to, $from, $from_name, $subject, $body) { 
//	global $error;
//	$mail = new PHPMailer();  // create a new object
//	$mail->IsSMTP(); // enable SMTP
//	$mail->SMTPDebug = 0;  // debugging: 1 = errors and messages, 2 = messages only
//	$mail->SMTPAuth = true;  // authentication enabled
//	$mail->SMTPSecure = 'ssl'; // secure transfer enabled REQUIRED for GMail
//	$mail->Host = 'smtp.gmail.com';
//	$mail->Port = 465; 
//	$mail->Username = GUSER;  
//	$mail->Password = GPWD;           
//	$mail->SetFrom($from, $from_name);
//	$mail->Subject = $subject;
//	$mail->Body = $body;
//	$mail->AddAddress($to);
//	if(!$mail->Send()) {
//		$error = 'Mail error: '.$mail->ErrorInfo; 
//		return false;
//	} else {
//		$error = 'Message sent!';
//		return true;
//	}
//}
//
//
//$msg = 'Hello World';
//$subj = 'test mail message';
//$to = 'to@mail.com';
//$from = 'from@mail.com';
//$name = 'yourName';
// 
//if (smtpmailer($to, $from, $name, $subj, $msg)) {
//	echo 'Yippie, message send via Gmail';
//} else {
//	if (!smtpmailer($to, $from, $name, $subj, $msg, false)) {
//		if (!empty($error)) echo $error;
//	} else {
//		echo 'Yep, the message is send (after doing some hard work)';
//	}
//}