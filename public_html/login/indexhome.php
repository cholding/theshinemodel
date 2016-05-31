<?php require('includes/config.php'); 

defined('SITE_ROOT')? null: define('SITE_ROOT',$_SERVER['DOCUMENT_ROOT']);

include(SITE_ROOT.'/global/class.error_handler.php');
$handler = new error_handler(NULL,1,1,'colin-h@dircon.co.uk',SITE_ROOT.'global/error_logs/test.com.txt');
set_error_handler(array(&$handler, "handler"));


//if not logged in redirect to login page
if(!$user->is_logged_in()){ header('Location: login.php'); } 

?>

<!DOCTYPE html>	

<html lang="en">	
  <head>	
    <meta charset="utf-8">	
    <meta http-equiv="X-UA-Compatible" content="IE=edge">	    <meta name="viewport" content="width=device-width, initial-scale=1">	
    <title>Kwiken - fast knowledge</title>	!
    <!-- Bootstrap -->	
    <link href="/css/bootstrap.min.css" rel="stylesheet">	!
    <link href="/css/bootstrapkwk.css" rel="stylesheet">  !
    
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->	
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->	    <!--[if lt IE 9]>	
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></ script>	
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/ respond.min.js"></script>	    <![endif]-->	
    	<link rel="stylesheet" type="text/css" href="/layout/style/index.css">
    
  </head>	
  <body data-spy="scroll" data-target=".navbar-collapse">	  <div class="navbar navbar-default navbar-fixed-top">	
  	<div class="container">	
  		<div class="navbar-header">	
  			 <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				</button>
  			<a class="navbar-brand kimage"><img src="/images/kwiken.png" alt="KwiKen" style="height:40px;margin-top:0"></a>	
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
	</div>	
  </div>
  	
  <div class="container contentContainer" id="topContainer">	
   
      <div class="overlay">
        <h2 style="background-color:grey; opacity:.8; width:800px;text-align: center; margin-left: 30%"  >This should be where I put Kwiken request form</h2>
      

      </div>
      
  
  	  <!--Carousel-->
    <div id="myCarousel" class="carousel slide carousel-fade" data-ride="carousel" data-interval="20000"><!-- If this doesn't work, paste this data-rider="carousel" after "carousel"-->
      <!--Indicators--> 
      <ol class="carousel-indicators">
              <li data-target="#myCarousel" data-slide-to="0" ></li>
              <li data-target="#myCarousel" data-slide-to="1" ></li>
              <li data-target="#myCarousel" data-slide-to="2" ></li>
              <li data-target="#myCarousel" data-slide-to="3" ></li>
              <li data-target="#myCarousel" data-slide-to="4" ></li>
      </ol>

      <div class="carousel-inner">
              <div class="item active">
                      <img src="/images/bg1.jpg" alt="Headphones" class="img-responsive">
              </div>

              <div class="item">
                      <img src="/images/bg2.jpg" alt="watch" class="img-responsive">
              </div>

              <div class="item">
                      <img src="/images/bg3.jpg" alt="Corridor" class="img-responsive">
              </div>
              <div class="item">
                      <img src="/images/bg4.jpg" alt="Corridor" class="img-responsive">
              </div>
              <div class="item">
                      <img src="/images/bg5.jpg" alt="Corridor" class="img-responsive">
              </div>
             
              <div class="item">
                      <img src="/images/bg6.jpg" alt="Corridor" class="img-responsive">
              </div>
            
    
      </div>
      <a class="carousel-control left" href="#myCarousel" data-slide="prev">
        <span class="icon-prev"></span>
      </a>
      <a class="carousel-control right" href="#myCarousel" data-slide="next">
        <span class="icon-next"></span>
      </a>
    
    </div>
 
  			
  	
  </div>	
  	
  	
  <div class="container contentContainer" id="details">	
  	
  	<div class="row" class="center">	
  		
  		<h1 class="center title">Why the Kwiken App Is Awesome</h1>	
  		<p class="lead center">Everything you ever wanted to know straight to your eardrum. Most times when you want to know something about something you have to go searching - the information is out there but you have to go find it. Imagine if you have someone do it for you - just type in your subject and your email and hey presto there's someone on it for you.All you have to do is sit back and wait for you email to 'ping'</p>	
  		
  		
  	</div>	
		
		<div class="row  marginBottom">	
		
  		<div class="col-md-4 marginTop">	
  		<h2><span class="glyphicon glyphicon-cloud"></span> Vision</h2>	
  		<p>To be the foremost provider if fast, mobile, knowledge on any subject. </p>	
  		<button class="btn btn-success marginTop">Sign Up! (please)</button>	
  			
  		</div>	
  			
  		<div class="col-md-4 marginTop">	
  		<h2><span class="glyphicon glyphicons-heart-empty"></span> Mission</h2>	
  		<p>Kwiken will educate, illuminate and empower people by providing up to date knowledge on the subject of their choice . This product is for people who have a desire for information either, for their own erudition, or to have a repertoire of up to date knowledge for social or business occasions. The client can select subject of their choice and be delivered within 24 hours, an audio file (of approximately 3-4 mins) and support PDF document with a synopsis or abstract of the subject they have selected. The information will be as current as possible and as well as the basic knowledge will contain humour and unusual facts of anecdotes – for easy recital at a dinner table for example.</p>	
  		<button class="btn btn-success marginTop">Sign Up!</button>	
  			
  		</div>	
  		
  		<div class="col-md-4 marginTop">	
  		<h2><span class="glyphicon glyphicon-cloud"></span> Charity</h2>	
  		<p>Kwiken is committed to education and enlightenment - and not just for people who can afford it. We are committed to using the product and knowledge, as well as a percentage of profits, to provide for children and schools in developing countries</p>	
  		<button class="btn btn-success marginTop">Sign Up!</button>	
  			
  		</div>	
  		
  	</div>	

  </div>	
  	
  <div class="container contentContainer" id="footer">	
  	
  	<div class="row">	
  		
  		<h1 class="center title">Download The App!</h1>	
  		
  		<p class="lead center">Really, why should I download this app?</p>	
  			
  		<p class="center"><img src="/images/headphones1.jpg" class="appstoreImage" />	
  		
  	</div>	
  	
  	
  </div>	
  	<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="js/bootstrap.min.js"></script>
    <!-- Just include this Js file -->
    <!--<script src="/login/js/jquery.carousel.fullscreen.js"></script> -->
   
	<script>   
      
      //$(".contentContainer").css("min-height",$(window).height());  
      $(".contentContainer").css("width",1920);
    </script>
  </body>	
</html>
