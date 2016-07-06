
<?php
defined('SITE_ROOT')? null: define('SITE_ROOT',$_SERVER['DOCUMENT_ROOT']);

//set error handling
include(SITE_ROOT.'/global/class.error_handler.php');
$handler = new error_handler(NULL,1,1,'colin-h@dircon.co.uk',SITE_ROOT.'/global/error_logs/test.com.txt');
set_error_handler(array(&$handler, "handler"));
//

//include config
require_once(SITE_ROOT.'/login/includes/config.php');
// echo 'this is login php';
//check if already logged in move to home page
if( $user->is_logged_in() ){ header('location: login/memberpage.php'); } 

//process login form if submitted
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
$title = 'Member Page';

//include header template
require('layout/header.php'); 

?>
<div class="container">
    <nav class="navbar navbar-fixed-top navbar-light navbar-xs " >
        <button class="navbar-toggler hidden-sm-up pull-xs-right" type="button" data-toggle="collapse" data-target="#mainmenu"> ☰</button>

        <a class="navbar-brand kimage"><img src="/images/shine.png" alt="SHINE" style="height:20px;margin-top:0,background-color:grey"></a>
        <div class="collapse navbar-toggleable-xs" id="mainmenu">
            <ul class="nav navbar-nav pull-md-left">
                <li class="nav-item"><a href="#" class="nav-link">Home</a></li>
                <li class="nav-item"><a href="#" class="nav-link">About</a></li>
                <li class="nav-item"><a href="http://www.theshinemodel.com/blog/" class="nav-link active">Go to blog</a></li>
                <li class="nav-item"><a class="btn btn-info btn-sm btn-outline" href="/login/profilepage.php" class="nav-link">Profile</a></li>

            </ul>
            <div class="navbar-form pull-md-right">
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
    </nav>

</div>

<div class="container contentContainer" id="topContainer">	
    <div class="row">
        <h1 class="center title overlay" style="opacity:0.7;background-color:grey;"> Welcome to SHINE <br> <p style="font-size:.8em"> Sustainable Health Inspired by Nature and Evolution</p></h1> 

    </div>

    <!-- Full Page Image Background Carousel Header -->
    <header id="myCarousel" class="carousel slide">
        <!-- Indicators -->
        <ol class="carousel-indicators">
            <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
            <li data-target="#myCarousel" data-slide-to="1"></li>
            <li data-target="#myCarousel" data-slide-to="2"></li>
        </ol>

        <!-- Wrapper for Slides -->
        <div class="carousel-inner">
            <div class="item active">
                <!-- Set the first background image using inline CSS below. -->
                <div class="fill" style="background-image:url('images/bg1.jpg');"></div>
                <div class="carousel-caption">
                    <h2>Caption 1</h2>
                </div>
            </div>
            <div class="item">
                <!-- Set the second background image using inline CSS below. -->
                <div class="fill" style="background-image:url('images/bg2.jpg');"></div>
                <div class="carousel-caption">
                    <h2>Caption 2</h2>
                </div>
            </div>
            <div class="item">
                <!-- Set the third background image using inline CSS below. -->
                <div class="fill" style="background-image:url('images/bg2.jpg');"></div>
                <div class="carousel-caption">
                    <h2>Caption 3</h2>
                </div>
            </div>
        </div>

        <!-- Controls -->
        <a class="left carousel-control" href="#myCarousel" data-slide="prev">
            <span class="icon-prev"></span>
        </a>
        <a class="right carousel-control" href="#myCarousel" data-slide="next">
            <span class="icon-next"></span>
        </a>

    </header>



    <div class="container contentContainer" id="details">	



        <div class="row  marginBottom">	

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

    </div>	


    <?php 
    //include header template
    require('layout/footer.php'); 
    ?>
