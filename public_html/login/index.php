
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
if( $user->is_logged_in() ){ header('location: memberpage.php'); } 

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
//define page title
$title = 'Home Page';

//include header template
require(SITE_ROOT.'/layout/header.php');     

?>

<nav class="navbar navbar-fixed-top navbar-light navbar-xs " >
    <div class="container-fluid">
        <button class="navbar-toggler hidden-sm-up pull-xs-right" type="button" data-toggle="collapse" data-target="#mainmenu"> ☰</button>

        <a class="navbar-brand kimage"><img src="../images/shine.png" alt="SHINE" style="height:20px;margin-top:0,background-color:grey"></a>
        <div class="collapse navbar-toggleable-xs" id="mainmenu">
            <ul class="nav navbar-nav pull-md-left">
                <li class="nav-item"><a href="#" class="nav-link">Home</a></li>
                <li class="nav-item"><a href="#" class="nav-link">About</a></li>
                <li class="nav-item"><a href="http://www.theshinemodel.com/blog/" class="nav-link active">Go to blog</a></li>
                <!--                <li class="nav-item"><a class="btn btn-info btn-sm btn-outline" href="/login/profilepage.php" class="nav-link">Profile</a></li>-->

            </ul>
            <div class="btn-group pull-md-right" style="display:inline;">
                <div class="fill">
                    <form class="navbar-form navbar-right form-inline" Method="post" action="/login/login.php">	
                        <div class="form-group form-group-sm">	
                            <input name="username" type="text" placeholder="User Name" class="form-control input-sm" />	
                        </div>	
                        <div class="form-group form-group-sm">	
                            <input name="password" type="password" placeholder="Password" class="form-control input-sm" />	
                        </div>	

                        <button name="submit" type="submit" class="btn btn-sm btn-success">Log In</ button>


                    </form>	
                </div>
            </div>
        </div>
    </div>

</nav>



<!--
<div class="container contentContainer" id="topContainer">	
<div class="row">
<h1 class="center title overlay "style="opacity:0.7;background-color:grey;"Welcome to SHINE <br><p style="font-size:.8em"> Sustainable Health Inspired by Nature and Evolution</p></h1> 

</div>
-->

<div class="fill">

    <!--Carousel-->
    <div id="myCarousel" class="carousel slide carousel-fade" data-ride="carousel" data-interval="4000"><!-- If this doesn't work, paste this data-rider="carousel" after "carousel"-->
        <!--Indicators--> 
        <ol class="carousel-indicators">
            <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
            <li data-target="#myCarousel" data-slide-to="1" ></li>
            <li data-target="#myCarousel" data-slide-to="2" ></li>
            <li data-target="#myCarousel" data-slide-to="3" ></li>
            <li data-target="#myCarousel" data-slide-to="4" ></li>
        </ol>

        <div class="carousel-inner">
            <div class="carousel-item active">
                <img src="../images/bg1.jpg" alt="Headphones" class="img-responsive">

            </div>

            <div class="carousel-item">
                <img src="../images/bg2.jpg" alt="watch" class="img-responsive">
            </div>

            <div class="carousel-item">
                <img src="../images/bg3.jpg" alt="Corridor" class="img-responsive">
            </div>
            <div class="carousel-item">
                <img src="../images/bg4.jpg" alt="Corridor" class="img-responsive">
            </div>
            <div class="carousel-item">
                <img src="../images/bg6.jpg" alt="Corridor" class="img-responsive">
            </div>


        </div>
        <a class="carousel-control left" href="#myCarousel" data-slide="prev">
            <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
        </a>
        <a class="carousel-control right" href="#myCarousel" data-slide="next">
            <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
        </a>
    </div>
</div>
<div class="container contentContainer" id="details">	

    <!--
<div class="row" class="center">	

<h1 class="center title">Why the SHINE App Is Awesome</h1>	
<p class="lead center">The SHINE app will inspire you to embrace your health 24 hours a day - awake or asleep stay inspired</p>	


</div>	
-->


    <!--
<div class="row  marginBottom" >	

<div class="col-md-4 marginTop">	
<h2><span class="glyphicon glyphicon-cloud"></span> Vision</h2>	
<p>To be the best you can be for the rest of your life. We believe Health is something you carry with you always and forever - not 'let's do a bit of health for the next month'</p>	
<a class="btn btn-success marginTop" href="login/index.php">Sign Up! (please)</a>	

</div>	

<div class="col-md-4 marginTop">	
<h2><span class="glyphicon glyphicon-music"></span> Mission</h2>	
<p>SHINE will educate, illuminate and empower people to live in a body that SHINES, to have mental and intellectual capacities that SHINE and to have communication and relationships that SHINE. SHINE is to do just that. Our mission is to help people be the best they can be - physically, mentally, emotionally, spiritually for themselves and for all the precious people around them</p>	
<a class="btn btn-success marginTop" href="login/index.php">Sign Up!</a>

</div>	

<div class="col-md-4 marginTop">	
<h2><span class="glyphicon glyphicon-pencil"></span> Charity</h2>	
<p>SHINE is committed to education and enlightenment - and not just for people who can afford it. We are committed to using the product and knowledge, as well as a percentage of profits, to help and educate the next generations - they are the future and need the education not to repeat the mistakes of previous generations but more importantly to build on the incredible advances provided by previous generations</p>	
<a class="btn btn-success marginTop" href="login/index.php">Sign Up!</a>

</div>	

</div>	
-->
    <div class="mainPitch col-xs-6" style="position:absolute; width:50%;top:30%;left:20%;border-radius: 10px;">
        <div class="container panel">
            <div class="row">
                <div class="col-xs-12" style="text-align:center;">
                    <div class="fixedcaption">
                        <h1>SHINE</h1>
                        <h3>Sustainable Health Inspired by Nature and Evolution</h3>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--
</div>
</div>	
-->
    <!--
<div class="banner-wrapper">
<div class="banner-image"></div>
<div class ="absolute-wrapper">
<div class="container">
<div class="row">
<div class="col-xs-12">
SOME VERY LONG TEXT IN AN ABSOLUTE DIV
</div>
</div>
</div>
</div>
</div>
-->

    <!-- Just include this Js file -->
    <script src="js/jquery.carousel.fullscreen.js"></script> 

    <script>   
        //$(".contentContainer").css("min-height",$(window).height());  
        $(".contentContainer").css("width",1920);
    </script>
    <?php 
    //include header template
    require('layout/footer.php'); 
    ?>
