<?php 
defined('SITE_ROOT')? null: define('SITE_ROOT', $_SERVER['DOCUMENT_ROOT']);
include(SITE_ROOT."/global/class.error_handler.php");
$handler = new error_handler(NULL,1,1,'colin-h@dircon.co.uk',SITE_ROOT.'/global/error_logs/test.com.txt');
set_error_handler(array(&$handler, "handler"));


require(SITE_ROOT."/login/includes/config.php"); 
require_once(SITE_ROOT. '/login/classes/shine_email.php');

//require_once('../includes/PHPMailer/class.phpmailer.php');
//include("class.smtp.php"); // optional, gets called from within class.phpmailer.php if not already loaded

//if the user is not logged in - send them   to the login page
if( !$user->is_logged_in() ){ 
		// header('Location: login.php'); 
} 

//if form has been submitted process it
if(isset($_POST['submit']))
{

	//very basic validation
	if(strlen($_POST['subject']) < 1){
		
		$error[] = 'Please enter a valid subject' ;
		
	} else {
		
	//we can put some validation in here - maybe has this user asked for this subject before
		// get the person's email
		/*$stmt = $db->prepare('SELECT username FROM members WHERE username = :username');
		$row = $stmt->fetch(PDO::FETCH_ASSOC);

		if(!empty($row['username'])){
			$error[] = 'Username provided is already in use.';
		}*/
		$stmt->execute(array(':username' => $_POST['username']));
			
	} //close Post subject
	
	if(strlen($_POST['comment']) < 1){
		$error[] = 'It is useful to add a comment just so we know if we need to be specific' .$_POST['comment'];
	} else {
	echo $_POST['comment'];
	} // close Post comment
	

	/*get the email form the account name
	if(!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)){
	    $error[] = 'Please enter a valid email address';
	} else {
		$stmt = $db->prepare('SELECT email FROM members WHERE email = :email');
		$stmt->execute(array(':email' => $_POST['email']));
		$row = $stmt->fetch(PDO::FETCH_ASSOC);

		if(!empty($row['email'])){
			$error[] = 'Email provided is already in use.';
		}
			
	} */


	//if no errors have been created carry on
	if(!isset($error)){

		//create the activasion code
		$activasion = md5(uniqid(rand(),true));
		
		try {

			$mail             = new k_email();

			$body             = file_get_contents('../email.html');
			$body             = eregi_replace("[\]",'',$body);
		

			$subject  = "Thank you for your SHINE Request on " .$_POST['subject'];

			$altbody    = "To view the message, please use an HTML compatible email viewer!"; // optional, comment out and test

			$email = $_SESSION['email'];
			$fullname =  $_SESSION['fullname'] ;
			$attachment="../audiofiles/ISIS.MP3";

			
			if (!$mail->sendkemail($subject,$body,$altbody,$email,$fullname,$attachment)) 
			{
					$error[]="sent ok";

			} else{

				$error[]="send failed";
			} ;
			


		//else catch the exception and show the error.
		} catch(PDOException $e) {
		    $error[] = $e->getMessage();
		} // end try
			

			/*$mail             = new PHPMailer();

			$body             = file_get_contents('../email.html');
			$body             = eregi_replace("[\]",'',$body);

			$mail->IsSMTP(); // telling the class to use SMTP
			$mail->Host       = "mail.kwiken.com"; // SMTP server
			//$mail->SMTPDebug  = 2;                     // enables SMTP debug information (for testing)
			                                           // 1 = errors and messages
			                                           // 2 = messages only
			$mail->SMTPAuth   = true;                  // enable SMTP authentication
			$mail->Host       = "mail.kwiken.com"; // sets the SMTP server
			//$mail->SMTPSecure = "ssl";
			$mail->Port       = 587;                // set the SMTP port for the GMAIL server
			$mail->Username   = "mail@kwiken.com"; // SMTP account username
			$mail->Password   = "Lang@t@266";        // SMTP account password

			$mail->SetFrom('mail@kwiken.com', 'The Kwiken Team');

			$mail->AddReplyTo("mail@kwiken.com","The Kwiken Team");

			$mail->Subject    = "Thank you for your Kwiken Request on " .$_POST['subject'];

			$mail->AltBody    = "To view the message, please use an HTML compatible email viewer!"; // optional, comment out and test

			$mail->MsgHTML($body);

			$address = $_SESSION['email'];
			//$address = "colin@wildfitness.com";
			$fullname =  $_SESSION['fullname'] ;
			$mail->AddAddress($address, $fullname);

			$mail->AddAttachment("../audiofiles/ISIS.MP3");      // attachment


			if(!$mail->Send()) {
			  //echo "Mailer Error: " . $mail->ErrorInfo;
			} else {
			  echo "Message sent!";
			} 


		//else catch the exception and show the error.
		} catch(PDOException $e) {
		    $error[] = $e->getMessage();
		}*/

	}

}

//define page title
$title = 'Member Page';

//include header template
require('layout/header.php'); 
?> 
<nav class="navbar navbar-custom navbar-static-top">
	
	<div class="navbar navbar-default navbar-fixed-top" style="background-color:white">	
    	<div class="container" >	
    		<div class="navbar-header">	
    			 <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
  				<span class="icon-bar"></span>
  				<span class="icon-bar"></span>
  				<span class="icon-bar"></span>
  				</button>
    			<a class="navbar-brand kimage"><img src=''.SITE_ROOT."/images/shine.png" alt="SHINE" style="height:26px;margin-top:0,background-color:grey"></a>	
    		</div>	
    			
    		<div class="collapse navbar-collapse">	
    			<ul class="nav navbar-nav">		
    				<li class="active"><a href="#topContainer">Home</a></li>	
    				<li><a href="#details">About</a></li>	
    				<li><a href="#footer">Download The App</a></li>	
    			</ul>	
    			<form class="navbar-form navbar-right" Method="post" action="/login/logout.php">	
    				<div class="form-group">	
    					 Welcome <?php echo $_SESSION['username']; ?>
    					
    				</div>	
    				<button name="submit" type="submit" class="btn btn-success">Log Out</ button>	
    				
    			</form>	
  			</div>	
      </div>	<!-- END container -->
    </div> <!-- END navbar -->


</nav>	
<div class="container_bg"><!-- Open background image -->

	<div class="container-fluid">
		<div id="loginbox" style="margin-top:50px;" class="mainbox col-md-3 col-md-offset-0 col-sm-12 col-sm-offset-1">
			<div class="panel panel-default" style="width:500px;"><!-- this is the image container -->
	
				<!-- <h2 class="opaquetitle">Member only page - Welcome <?php echo $_SESSION['username'];?></h2> -->
	        	<div class="panel-heading">
	            	<h2>Please choose your subject</h2>
	        	</div>
		        <div class="panel-body" style="margins:30px 30px,30px,30px"; style="padding: 40px 40px 40x 40px">

				<div class="row" >

			    <!--<div class="col-xs-12 col-sm-8 col-md-6 col-sm-offset-0 col-md-offset-0">
					<div class-"row">
					<div class="row">
							<h2 class="opaquetitle">Comment<?php //echo $_POST['comment'];?></h2>
						</div>	
					</div>	
					<div class-"row">	
						<div class="col-md-9 ">
							<p><a class="opaquetitle" href='logout.php'>Logout</a>                 <a class="opaquetitle" href='/index.html'><b>HOME</b></a></p>
						</div>
					</div>
									
					

					<div class="col-md-9">
						
							<h2 class="opaquetitle">Subject <?php //echo $_POST['subject'];?></h2>
					
			</div>-->
		</div>

		   
								
				
				<form role="form" method="post" action="" autocomplete="off" style="padding: 40px 40px 40x 40px">
					<!--<h2 class="opaquetitle">Please enter the subject you are interested in</h2>-->
					
					<?php
										//check for any errors
					if(isset($error)){
						foreach($error as $error){
							echo '<p class="bg-danger">'.$error.'</p>';
						}
					}

					//if action is joined show sucess
					if(isset($_GET['action']) && $_GET['action'] == 'joined'){
						echo "<h2 class='bg-success'>Registration successful, please check your email to activate your account.</h2>";
					}
					?>

					
					<div class="form-group">
						
						<!--<textarea class="form-control" rows="5" id="subject" placeholder="Enter subject of interest"></textarea>-->
						<input type="text" name="subject" "style="width:200px" id="subject" class="form-control input-lg" placeholder="Subject" tabindex="3">
					

					<div class="form-group">
						<!--label class="opaquetitle"for="comment">Comment:</label>-->
						<input type="text" name="comment" style="width:200px" id="comment" class="form-control input-lg" placeholder="Comment" tabindex="3">
						<!--<textarea class="form-control" rows="5" id="comment" placeholder="Please enter comment if you need specifics"></textarea>-->
					</div>
					<div class="row">
						<div class="col-xs-6 col-md-6"><input type="submit" name="submit" value="Submit" class="btn btn-primary btn-block btn-lg" tabindex="5"></div>
					</div>
				</form>
				<?php
						//check for any errors
						if(isset($sent)){
								echo '<div style="padding: 30px 30px 30px 30px">';
								echo '<p class="bg-danger" style="width:300px">'.$sent.'</p>';
								echo '</div>';
							
						}

						
				?>

					</div>
				</div>
			</div>	
		</div>
	</div>
</div>

<?php 
//include header template
require('layout/footer.php'); 
?>