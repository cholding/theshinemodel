<!DOCTYPE html>	
<html lang="en">	
    <?php
    defined('SITE_ROOT')? null: define('SITE_ROOT',$_SERVER['DOCUMENT_ROOT']);

    include(SITE_ROOT.'/global/class.error_handler.php');
    $handler = new error_handler(NULL,1,1,'colin-h@dircon.co.uk',SITE_ROOT.'/global/error_logs/test.com.txt');
    set_error_handler(array(&$handler, "handler"));
    //

    //include config
    require_once(SITE_ROOT.'/login/includes/config.php');
    // echo 'this is login php';
    //check if already logged in move to home page
    if( $user->is_logged_in() ){ header('location: login/memberpage.php'); } 

    ////process login form if submitted
    if(isset($_POST['submit'])){
        $username = $_POST['username'];
        $password = $_POST['password'];

        if($user->login($username,$password)){ 
            $_SESSION['username']=$username;
            $_SESSION['memberid']=$user->getuserid($username);
            $_SESSION['fullname']=$user->getfullname($_SESSION['memberid']);
            $_SESSION['email']=$user->getemail($_SESSION['memberid']);

            if($user->gettype($username)>1) {

                header('Location: production.php');
                exit;
            } else {
                header('Location: memberpage.php');
                exit;
            }
        } else {
            $error[] = 'Wrong username or password or your account has not been activated.';
        }

    }//end if submit
    ?>


    <head>	
        <meta charset="utf-8">	
        <meta http-equiv="X-UA-Compatible" content="IE=edge">	    <meta name="viewport" content="width=device-width, initial-scale=1">	
        <title>SHINE - fast knowledge</title>	!
        <!-- Bootstrap -->	
        <link href="css/bootstrap.min.css" rel="stylesheet">	!
        <link href="css/bootstrapkwk.css" rel="stylesheet">  !

        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->	
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->	    <!--[if lt IE 9]>	
<script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></ script>	
<script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/ respond.min.js"></script>	    <![endif]-->	
        <link rel="stylesheet" type="text/css" href="layout/style/index.css">

    </head>	
    <body data-spy="scroll" data-target=".navbar-collapse">	  <div class="navbar navbar-default navbar-fixed-top">	
        <div class="container">	
            <div class="navbar-header">	
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand kimage"><img src="images/shine.png" alt="Shine" style="height:20px;margin-top:0"></a>	
            </div>	

            <div class="collapse navbar-collapse">	
                <ul class="nav navbar-nav">		
                    <li class="active"><a href="#topContainer">Home</a></li>	
                    <li><a href="#details">About</a></li>	
                    <li><a href="#footer">Download The App</a></li>	
                    <li><a href="http://www.theshinemodel.com/blog/" target="_blank">Visit the blog</a></li>
                    <li> <a class="btn btn-info-outline btn-sm" href="login/index.php">Sign Up! (please) </a></li>

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

        </div>	
        </div>

        <div class="container contentContainer" id="topContainer">	
            <div class="row">
                <h1 class="center title overlay "style="opacity:0.7;background-color:grey;"Welcome to SHINE <br><p style="font-size:.8em"> Sustainable Health Inspired by Nature and Evolution</p></h1> 

        </div>



        <!--Carousel-->
        <div id="myCarousel" class="carousel slide carousel-fade" data-ride="carousel" data-interval="4000"><!-- If this doesn't work, paste this data-rider="carousel" after "carousel"-->
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
                    <img src="images/bg1.jpg" alt="Headphones" class="img-responsive">

                </div>

                <div class="item">
                    <img src="images/bg2.jpg" alt="watch" class="img-responsive">
                </div>

                <div class="item">
                    <img src="images/bg3.jpg" alt="Corridor" class="img-responsive">
                </div>
                <div class="item">
                    <img src="images/bg4.jpg" alt="Corridor" class="img-responsive">
                </div>
                <div class="item">
                    <img src="images/bg6.jpg" alt="Corridor" class="img-responsive">
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

            <h1 class="center title">Why the SHINE App Is Awesome</h1>	
            <p class="lead center">The SHINE app will inspire you to embrace your health 24 hours a day - awake or asleep stay inspired</p>	


        </div>	

        <div class="row  marginBottom">	

            <div class="col-md-4 marginTop">	
                <h2><span class="glyphicon glyphicon-cloud"></span> Vision</h2>	
                <p>To be the best you can be for the rest of your life. We believe Health is something you carry with you always and forever - not let's do a bit of health for the next month</p>	
                <a class="btn btn-success marginTop" href="login/index.php">Sign Up! (please)</a>	

            </div>	

            <div class="col-md-4 marginTop">	
                <h2><span class="glyphicon glyphicon-music"></span> Mission</h2>	
                <p>SHINE will educate, illuminate and empower people to live in a body that SHINES, to have mental and intellectual capcities that SHINE and to have comminication and relationships that SHINE. SHINE is to do just that. Our mission is to help people be the best they can be - physically, mentally, emotionally, spiritually for themselves and for all the precious people around them</p>	
                <a class="btn btn-success marginTop" href="login/index.php">Sign Up!</a>

            </div>	

            <div class="col-md-4 marginTop">	
                <h2><span class="glyphicon glyphicon-pencil"></span> Charity</h2>	
                <p>SHINE is committed to education and enlightenment - and not just for people who can afford it. We are committed to using the product and knowledge, as well as a percentage of profits, to help and educate the next generations - they are the future and need the education not to repeat the mistakes of previous generations but more importantly to build on the incredible advances provided by previous generations</p>	
                <a class="btn btn-success marginTop" href="login/index.php">Sign Up!</a>

            </div>	

        </div>	

    </div>	

    <div class="container contentContainer" id="footer">	

        <div class="row">	

            <h1 class="center title">Download The App!</h1>	

            <p class="lead center">Really, why should I download this app?</p>	

            <p class="center"><img src="images/shine.png" class="appstoreImage" />	

        </div>	


    </div>	
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="login/js/bootstrap.min.js"></script>
    <!-- Just include this Js file -->
    <!--<script src="/login/js/jquery.carousel.fullscreen.js"></script> -->

    <script>   

        //$(".contentContainer").css("min-height",$(window).height());  
        $(".contentContainer").css("width",1920);
    </script>
    </body>	
</html>
