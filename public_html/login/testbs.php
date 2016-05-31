<?php 

require('includes/config.php'); 
//if the user is not logged in - send them   to the login page
if( !$user->is_logged_in() ){} 

//if form has been submitted process it
if(isset($_POST['submit'])){

	//very basic validation
	if(strlen($_POST['subject']) < 1){
		
		$error[] = 'Please enter a valid subject' ;
		
	} else {
		
	//we can put some validation in here - maybe has this user asked for this subject before
		// get the person's email
		/*$stmt = $db->prepare('SELECT username FROM members WHERE username = :username');
		$stmt->execute(array(':username' => $_POST['username']));
		$row = $stmt->fetch(PDO::FETCH_ASSOC);

		if(!empty($row['username'])){
			$error[] = 'Username provided is already in use.';
		}*/
			
	}
	
	if(strlen($_POST['comment']) < 1){
		$error[] = 'It is useful to add a comment just so we know if we need to be specific' .$_POST['comment'];
	} else {
	
	}
	

	/*//get the email form the account name
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
		/*$activasion = md5(uniqid(rand(),true));

		try {

			//insert into database with a prepared statement
			$stmt = $db->prepare('INSERT INTO members (username,password,email,active) VALUES (:username, :password, :email, :active)');
			$stmt->execute(array(
				':username' => $_POST['username'],
				':password' => $hashedpassword,
				':email' => $_POST['email'],
				':active' => $activasion
			));
			$id = $db->lastInsertId('memberID');

			//send confirmation email
			$to = "colin@kwiken.com"; //<!--$_POST['email']; // this needs to be picked up from the user
			$subject = "Kwiken submission Confirmation";
			$body = "Thank you for submitting your request.\n\n The subject you chose was:\n\n ";
			$additionalheaders = "From: <".SITEEMAIL.">\r\n";
			$additionalheaders .= "Reply-To: $".SITEEMAIL."";
			mail($to, $subject, $body, $additionalheaders);
			$sent = "Kwiken request was sent regarding " .$_POST['subject'];
			//redirect to index page
			//header('Location: index.php?action=joined');
			//exit;

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
    			<a class="navbar-brand kimage"><img src="/images/kwiken.png" alt="KwiKen" style="height:26px;margin-top:0,background-color:grey"></a>	
    		</div>	
    			
    		<div class="collapse navbar-collapse">	
    			<ul class="nav navbar-nav">		
    				<li class="active"><a href="#topContainer">Home</a></li>	
    				<li><a href="#details">About</a></li>	
    				<li><a href="#footer">Download The App</a></li>	
    			</ul>	
    			<form class="navbar-form navbar-right" Method="post" action="/login/logout.php">	
    				<div class="form-group">	
    					 Welcome <?php echo $_SESSION['fullname']; ?>
    					
    				</div>	
    				

    				<button name="submit" type="submit" class="btn btn-success">Log Out</ button>	
    			</form>	
  			</div>	
      </div>	
    </div>

</nav>	
<div class="container_bg"><!-- this is the image container -->
	
	<div class="container-fluid">

		<!--<div class="row" >

		    <div class="col-xs-12 col-sm-8 col-md-6 col-sm-offset-0 col-md-offset-0">
				<div class-"row">
					<div class="col-md-9">
						<h2 class="opaquetitle">Member only page - Welcome <?php //echo $_SESSION['username'];*/?></h2>
						<h2 class="opaquetitle">Subject <?php // echo $_POST['subject'];*/?></h2>
						<h2 class="opaquetitle">Comment<?php //echo $_POST['comment'];?></h2>
					</div>	
				</div>	
				<div class-"row">	
					<div class="col-md-9 ">
						<p><a class="opaquetitle" href='logout.php'>Logout</a>                 <a class="opaquetitle" href='/index.html'><b>HOME</b></a></p>
					</div>
				</div>	
									
					
					
			</div>
		</div>-->

		<div class="row">

		    <div class="col-xs-12 col-sm-8 col-md-6 col-sm-offset-0 col-md-offset-0">
				<div id="page-wrap">
	  				
	  					<div class="overlay">

				
				
						<form role="form" method="post" action="" autocomplete="off" style="padding: 100px 100px 100px 100px">
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
							<input type="text" name="subject" id="subject" class="form-control input-lg" placeholder="Subject" tabindex="3">
						</div>

						<div class="form-group">
							<!--label class="opaquetitle"for="comment">Comment:</label>-->
							<input type="text" name="comment" id="comment" class="form-control input-lg" placeholder="Comment" tabindex="3">
							<!--<textarea class="form-control" rows="5" id="comment" placeholder="Please enter comment if you need specifics"></textarea>-->
						</div>
						<div class="row">
							<div class="col-xs-6 col-md-6">
								<input type="submit" name="submit" value="Submit" class="btn btn-primary btn-block btn-lg" tabindex="5">
							</div>
						</div>
					</form>
					<?php
					//check for any errors
					if(isset($sent)){
							echo '<div style="padding: 100px 100px 100px 100px">';
							echo '<p class="bg-danger">'.$sent.'</p>';
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