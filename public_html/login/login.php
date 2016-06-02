<?php

defined('SITE_ROOT')? null: define('SITE_ROOT',$_SERVER['DOCUMENT_ROOT']);
// set up error handling
include(SITE_ROOT.'/global/class.error_handler.php');
$handler = new error_handler(NULL,1,1,'colin-h@dircon.co.uk',SITE_ROOT.'global/error_logs/test.com.txt');
set_error_handler(array(&$handler, "handler"));

//include config
require_once(SITE_ROOT.'/login/includes/config.php');
// echo 'this is login php';
//check if already logged in move to home page
if( $user->is_logged_in() ){ header('Location: memberpage.php'); } 

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
$title = 'TheSHINEModel Login';

//include header template
require('layout/header.php'); 
?>

<div class="container_bg">	<!-- this is the image container-->
    <div class="form_container">
        <div class="container">

            <div class="row">
                <div id="loginbox" style="margin-top:20px;margin-left:20px;" class="mainbox col-md-12 col-md-offset-1 col-sm-12 col-sm-offset-1">
                    <div class="panel panel-default" style="width:600px; height:400px;margin:10px;">
                        <div class="col-xs-8 col-sm-8 col-md-6 col-sm-offset-3 col-md-offset-2">
                            <form role="form" method="post" action="" autocomplete="off">
                                <h2 >Please Login</h2>
                                <div class="backhome">
                                    <p><a style="color:#5C5CD7" href='index.php'>Back to sign-up page</a>
                                        <a href='../index.php'><b>HOME</b></a></p>
                                </div>
                                <hr>

                                <?php
                                //check for any errors
                                if(isset($error)){
                                    foreach($error as $error){
                                        echo '<p class="bg-danger"; style="opacity:0.8;color:red">'.$error.'</p>';
                                    }
                                }

                                if(isset($_GET['action'])){

                                    //check the action
                                    switch ($_GET['action']) {
                                        case 'active':
                                            echo "<h2 class='bg-success'>Your account is now active you may now log in.</h2>";
                                            break;
                                        case 'reset':
                                            echo "<h2 class='bg-success'>Please check your inbox for a reset link.</h2>";
                                            break;
                                        case 'resetAccount':
                                            echo "<h2 class='bg-success'>Password changed, you may now login.</h2>";
                                            break;
                                    }

                                }


                                ?>

                                <div class="form-group">
                                    <input type="text" name="username" id="username" class="form-control input-lg" placeholder="User Name" value="<?php if(isset($error)){ echo $_POST['username']; } ?>" tabindex="1">
                                </div>

                                <div class="form-group">
                                    <input type="password" name="password" id="password" class="form-control input-lg" placeholder="Password" tabindex="3">
                                </div>

                                <div class="row">
                                    <div class="col-xs-9 col-sm-9 col-md-9">
                                        <a href='reset.php'>Forgot your Password?</a>
                                    </div>
                                </div>

                                <hr>
                                <div class="row">
                                    <div class="col-xs-6 col-md-6"><input type="submit" name="submit" value="Login" class="btn btn-primary btn-block btn-lg" tabindex="5"></div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>


<?php 
//include footer template
require('layout/footer.php'); 
?>
