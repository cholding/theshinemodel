<?php

class shine_email 
{

    

    function __construct()
    {
    	
    	require_once($_SERVER['DOCUMENT_ROOT'].'/includes/PHPMailer/class.phpmailer.php');
    } // end construct

	public function sendkemail($subject, $body, $altbody, $email, $fullname,$attachment)
	{	

			
		try {
			
			$lsubject = $subject;
			$lbody =$body;
			$lemail=$email;
			$lfullname=$fullname;
			$lattachment=$attachment;
			$laltbody=$altbody;
			//echo "we are in sendkemail";

			$mail= new PHPMailer();
			$lbody= file_get_contents('../email.html');
			$lbody = eregi_replace("[\]",'',$body);

			$mail->IsSMTP(); // telling the class to use SMTP
			$mail->Host       = "mail.theshinemodel.com"; // SMTP server
		
			//$mail->SMTPDebug  = 2;                     // enables SMTP debug information (for testing)
			                                           // 1 = errors and messages
			                                           // 2 = messages only
			$mail->SMTPAuth   = true;                  // enable SMTP authentication
			$mail->Host       = "mail.theshinemodel.com"; // sets the SMTP server
			//$mail->SMTPSecure = "ssl";
			$mail->Port       = 587;                // set the SMTP port for the GMAIL server
			$mail->Username   = "mail@theshinemodel.com"; // SMTP account username
			$mail->Password   = "Lang@t@266";        // SMTP account password

			$mail->SetFrom('mail@theshinemodel.com', 'The SHINE Team');

			$mail->AddReplyTo("mail@theshinemodel.com","The SHINE Team");

			$mail->Subject    = $lsubject;

			$mail->MsgHTML($lbody);

			$address = $lemail;
			$mail->AltBody    = $altbody; // optional, comment out and test

			$address = "admin@theshinemodel.com";
			$fullname =  $lfullname;
			$mail->AddAddress($laddress, $lfullname);

			$mail->AddAttachment($lattachment);      // attachment

			$result=$mail->Send();
			if(!$result) {
			  echo "send failed";
			  $bSend= false;
			} else {
			  echo "email set";
			  $bSend= true;
			}



		} 
		catch (PDOException $e) {
		    $error[] = $e->getMessage();
			$bSend= false;
		}// end try
		return true;
		/*If(!$bSend) {
			return true;
		} else
			return false;
		}*/
	
	} // end function

} // end class
?>