<?php 
// put site root in because of problems referencing files.
defined('SITE_ROOT')? null: define('SITE_ROOT', dirname(__FILE__));

// Error handler
include(SITE_ROOT."/global/class.error_handler.php");
$handler = new error_handler(NULL,1,1,'colin-h@dircon.co.uk',SITE_ROOT.'/global/error_logs/test.com.txt');
set_error_handler(array(&$handler, "handler"));

require(SITE_ROOT.'/login/includes/config.php'); 


// test


	require_once('includes/Log.php');
	
	$Log= new cLog();
	$Log-> Write('Test.txt',date("Y-m-d H:i:s") . ' In index.php ' );
	




//if not logged in redirect to login page
if(!$user->is_logged_in()){ 
    $Log-> Write('Test.txt',date("Y-m-d H:i:s") . ' User not logged in going to login' );
    header('Location: login/login.php'); 
} else 
{
    $Log-> Write('Test.txt',date("Y-m-d H:i:s") . ' User  logged in - continue ' );
    
}
    

?>

<!DOCTYPE html>	

<html lang="en">	
    <head>	
        <meta charset="utf-8">	
        <meta http-equiv="X-UA-Compatible" content="IE=edge">	    <meta name="viewport" content="width=device-width, initial-scale=1">	
        <title>SHINE - the ultimate living experience</title>	
        <!-- Bootstrap -->	
        <link href="css/bootstrap.min.css" rel="stylesheet">  !
        <link href="css/bootstrapkwk.css" rel="stylesheet">  !

        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->	
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->	    <!--[if lt IE 9]>	
<script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></ script>	
<script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/ respond.min.js"></script>	    <![endif]-->	
        <link rel="stylesheet" type="text/css" href="layout/style/index.css">

    </head>	
    <body data-spy="scroll" data-target=".navbar-collapse">
        <div class="navbar navbar-default navbar-fixed-top">	
            <div class="container">	
                <div class="navbar-header">	
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand kimage"><img src="images/shine.png" alt="SHINE" style="height:26px;margin-top:0"></a>	
                </div>	

                <div class="collapse navbar-collapse">	
                    <ul class="nav navbar-nav">		
                        <div class="container contentContainer" id="topContainer">	

                            <!--Carousel-->
                            <div id="myCarousel" class="carousel slide carousel-fade" data-ride="carousel" data-interval="3000"><!-- If this doesn't work, paste this data-rider="carousel" after "carousel"-->
                                <!--Indicators--> 
                                <li class="active"><a href="#topContainer">Home</a></li>  
                                <li><a href="#details">About</a></li> 
                                <li><a href="#footer">Download The App</a></li> 
                            </div>
                        </div>
                    </ul> 
                        <form class="navbar-form navbar-right" Method="post" action="/login/login.php"> 
                            <div class="form-group">  
                                <input name="username" type="text" placeholder="User Name" class="form-control" />  
                            </div>  
                            <div class="form-group">  
                                <input name="password" type="password" placeholder="Password" class="form-control" /> 
                            </div>  
                            <button name="submit" type="submit" class="btn btn-success">Log In</ button>  
                        </form> 
                </div>  
                    <!--                        </div>  -->
<!--                </div>-->

                <ol class="carousel-indicators">
                    <li data-target="#myCarousel" data-slide-to="0" ></li>
                    <li data-target="#myCarousel" data-slide-to="1" ></li>
                    <li data-target="#myCarousel" data-slide-to="2" ></li>
                    <li data-target="#myCarousel" data-slide-to="3" ></li>
                    <li data-target="#myCarousel" data-slide-to="4" ></li>
                </ol>

                <div class="carousel-inner">
                    <div class="item active">
                        <img src="images/bg1.jpg" alt="" class="img-responsive">


                    </div>

                    <div class="item">
                        <img src="images/bg2.jpg" alt="" class="img-responsive">
                    </div>

                    <div class="item">
                        <img src="images/bg3.jpg" alt="" class="img-responsive">
                    </div>
                    <div class="item">
                        <img src="images/bg4.jpg" alt="" class="img-responsive">
                    </div>
                    <div class="item">
                        <img src="images/bg6.jpg" alt"" class="img-responsive">
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

                <h1 class="center title">SHINE</h1>	
                <p class="lead center">Sustainable Health Inspired by Nature and Evolution</p>  		
            </div>	

            <div class="row  marginBottom">	

                <div class="col-md-4 marginTop">	
                    <h2><span class="glyphicon glyphicon-cloud"></span> Vision</h2>	
                    <p>To provide the most complete and all round health solution - nothing is missed - the result is you SHINE</p>	
                    <button class="btn btn-success marginTop">Sign Up! (please)</button>	

                </div>	

                <div class="col-md-4 marginTop">	
                    <h2><span class="glyphicon glyphicon-music"></span> Mission</h2>	
                    <p>Kwiken will educate, illuminate and empower people by providing up to date knowledge on the subject of their choice . This product is for people who have a desire for information either, for their own erudition, or to have a repertoire of up to date knowledge for social or business occasions. The client can select subject of their choice and be delivered within 24 hours, an audio file (of approximately 3-4 mins) and support PDF document with a synopsis or abstract of the subject they have selected. The information will be as current as possible and as well as the basic knowledge will contain humour and unusual facts of anecdotes – for easy recital at a dinner table for example.</p>	
                    <button class="btn btn-success marginTop">Sign Up!</button>	

                </div>	

                <div class="col-md-4 marginTop">	
                    <h2><span class="glyphicon glyphicon-pencil"></span> Charity</h2>	
                    <p>Kwiken is committed to education and enlightenment - and not just for people who can afford it. We are committed to using the product and knowledge, as well as a percentage of profits, to provide for children and schools in developing countries</p>	
                    <button class="btn btn-success marginTop">Sign Up!</button>	

                </div>	

            </div>	

        </div>	

        <div class="container contentContainer" id="footer">	

            <div class="row">	

                <h1 class="center title">Download The App!</h1>	

                <p class="lead center">Really, why should I download this app?</p>	

                <p class="center"><img src="images/headphones1.jpg" class="appstoreImage" />	

            </div>	


        </div>	
        <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
        <!-- Include all compiled plugins (below), or include individual files as needed -->
        <script src="login/js/bootstrap.min.js"></script>
        <!-- Just include this Js file -->
        <!--<script src="/login/js/jquery.carousel.fullscreen.js"></script> -->

        <script>   

            //            $(".contentContainer").css("min-height",$(window).height());  
            $(".contentContainer").css("width",1920);
        </script>
    </body>	
</html>
