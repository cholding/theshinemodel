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
require('layout/header_member.php'); 
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
                    <li><a href="http://www.theshinemodel.com/blog/">Goto blog</a></li>	
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
<div class="container_st">	 <!--this is the image container -->
    <!-- Content -->
    <section id="wrapper">
        <hgroup>
            <h1 style="color:white";>Sustainable Health Inspired by Nature and Evolution</h1>
        </hgroup>
        <div id="container">
            <div class="grid">
                <div class="imgholder">
                    <a href="http://theshinemodel.com" target="_blank">
                        <img src="/images/bg5.jpg" alt="HTML tutorial" >
                    </a>

                </div>
                <strong>RELAX</strong>
                <p>In awe of Nature...</p>

            </div>
            <div class="grid">
                <div class="imgholder">
                    <img src="/images/bg3.jpg" />
                </div>
                <strong>Bridge to Heaven</strong>
                <p>Where is the bridge lead to?</p>
                <div class="meta">by SigitEko</div>
            </div>
            <div class="grid">
                <div class="imgholder">
                    <img src="http://www.inwebson.com/demo/blocksit-js/demo2/images/img15.jpg" />
                </div>
                <strong>Autumn</strong>
                <p>The fall of the tree...</p>
                <div class="meta">by Lars van de Goor</div>
            </div>
            <div class="grid">
                <div class="imgholder">
                    <img src="http://www.inwebson.com/demo/blocksit-js/demo2/images/img23.jpg" />
                </div>
                <strong>Winter Whisper</strong>
                <p>Winter feel...</p>
                <div class="meta">by Andrea Andrade</div>
            </div>
            <div class="grid">
                <div class="imgholder">
                    <img src="http://www.inwebson.com/demo/blocksit-js/demo2/images/img17.jpg" />
                </div>
                <strong>Light</strong>
                <p>The only shinning light...</p>
                <div class="meta">by Lars van de Goor</div>
            </div>
            <div class="grid">
                <div class="imgholder">
                    <img src="http://www.inwebson.com/demo/blocksit-js/demo2/images/img22.jpg" />
                </div>
                <strong>Rooster's Ranch</strong>
                <p>Rooster's ranch landscape...</p>
                <div class="meta">by Andrea Andrade</div>
            </div>
            <div class="grid">
                <div class="imgholder">
                    <img src="http://www.inwebson.com/demo/blocksit-js/demo2/images/img16.jpg" />
                </div>
                <strong>Autumn Light</strong>
                <p>Sun shinning into forest...</p>
                <div class="meta">by Lars van de Goor</div>
            </div>
            <div class="grid">
                <div class="imgholder">
                    <img src="http://www.inwebson.com/demo/blocksit-js/demo2/images/img21.jpg" />
                </div>
                <strong>Yellow cloudy</strong>
                <p>It is yellow cloudy...</p>
                <div class="meta">by Zsolt Zsigmond</div>
            </div>
            <div class="grid">
                <div class="imgholder">
                    <img src="http://www.inwebson.com/demo/blocksit-js/demo2/images/img28.jpg" />
                </div>
                <strong>Herringfleet Mill</strong>
                <p>Just a herringfleet mill...</p>
                <div class="meta">by Ian Flindt</div>
            </div>
            <div class="grid">
                <div class="imgholder">
                    <img src="http://www.inwebson.com/demo/blocksit-js/demo2/images/img2.jpg" />
                </div>
                <strong>Battle Field</strong>
                <p>Battle Field for you...</p>
                <div class="meta">by Andrea Andrade</div>
            </div>
            <div class="grid">
                <div class="imgholder">
                    <img src="http://www.inwebson.com/demo/blocksit-js/demo2/images/img24.jpg" />
                </div>
                <strong>Sundays Sunset</strong>
                <p>Beach view sunset...</p>
                <div class="meta">by Robert Strachan</div>
            </div>
            <div class="grid">
                <div class="imgholder">
                    <img src="http://www.inwebson.com/demo/blocksit-js/demo2/images/img19.jpg" />
                </div>
                <strong>Sun Flower</strong>
                <p>Good Morning Sun flower...</p>
                <div class="meta">by Zsolt Zsigmond</div>
            </div>
            <div class="grid">
                <div class="imgholder">
                    <img src="http://www.inwebson.com/demo/blocksit-js/demo2/images/img5.jpg" />
                </div>
                <strong>Beach</strong>
                <p>Something on beach...</p>
                <div class="meta">by unknown</div>
            </div>
            <div class="grid">
                <div class="imgholder">
                    <img src="http://www.inwebson.com/demo/blocksit-js/demo2/images/img25.jpg" />
                </div>
                <strong>Flowers</strong>
                <p>Hello flowers...</p>
                <div class="meta">by R A Stanley</div>
            </div>
            <div class="grid">
                <div class="imgholder">
                    <img src="http://www.inwebson.com/demo/blocksit-js/demo2/images/img20.jpg" />
                </div>
                <strong>Alone</strong>
                <p>Lonely plant...</p>
                <div class="meta">by Zsolt Zsigmond</div>
            </div> 
        </div>

    </section>
</div>
<?php 
//include header template
require('layout/footer.php'); 
?>