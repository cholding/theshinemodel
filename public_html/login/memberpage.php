<?php 

//set up the error handler
defined('SITE_ROOT')? null: define('SITE_ROOT', $_SERVER['DOCUMENT_ROOT']);
include(SITE_ROOT."/global/class.error_handler.php");
$handler = new error_handler(NULL,1,1,'colin-h@dircon.co.uk',SITE_ROOT.'/global/error_logs/test.com.txt');
set_error_handler(array(&$handler, "handler"));


require(SITE_ROOT."/login/includes/config.php"); 
require_once(SITE_ROOT. '/login/classes/shine_email.php');

//require_once('../includes/PHPMailer/class.phpmailer.php');
//include("class.smtp.php"); // optional, gets called from within class.phpmailer.php if not already loaded

//if the user is not logged in - send them   to the login page
if( !$user->is_logged_in() ){ header('Location: login.php'); } 



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
                <a class="navbar-brand kimage"><img src="/images/shine.png" alt="SHINE" style="height:20px;margin-top:0,background-color:grey"></a>	
            </div>	

            <div class="collapse navbar-collapse">	
                <ul class="nav navbar-nav">		
                    <li class="active"><a href="#topContainer">Home</a></li>	
                    <li><a href="#details">About</a></li>	
                    <li><a href="http://www.theshinemodel.com/blog/" target="_blank">Goto blog</a></li>	
                    <li><a class="btn btn-info btn-outline" href="/login/profilepage.php">Profile</a></li>	
                </ul>	
                <form class="navbar-form navbar-right" Method="post" action="/login/logout.php">	
                    <div class="form-group">	
                        Welcome <?php echo $_SESSION['firstname']; ?>

                    </div>	
                    <button name="submit" type="submit" class="btn btn-success">Log Out</ button>	

                </form>	

            </div>	
        </div>	<!-- END container -->
    </div> <!-- END navbar -->
</nav>	
<div class="container_bg">	<!-- this is the image container-->
    <div class="form_container">
        <div class="container">

            <div class="row">
                <div id="loginbox" style="margin-top:20px;margin-left:20px;" class="mainbox col-md-12 col-md-offset-4 col-sm-12 col-sm-offset-6">
                    <!--                    <div class="panel panel-default" style="width:400px; height:400px;margin:10px;">-->


 
                    <img src="..\images\Where1.png" width="1080" height="501" border="0" usemap="#map" />

                    <map name="map">
                       
                        <area shape="rect" coords="51,7,272,174" alt="Nature" href="http://www.brainyquote.com/quotes/topics/topic_nature.html" target="_blank" />
                        <area shape="rect" coords="736,376,962,466" alt="TED" href="https://www.ted.com/" target="_blank" />
                        <area shape="rect" coords="846,75,1070,193" alt="Courses" href="https://www.udemy.com/document-your-thoughts-like-a-genius-mind-mapping-xmind/?couponCode=FRIENDSFAMILIY" target="_blank" />
                        <area shape="rect" coords="7,362,230,496" alt="PLAY" href="https://www.ted.com/playlists/383/the_importance_of_play" target="_blank" />
                    </map>
                    <!--                    </div>-->
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