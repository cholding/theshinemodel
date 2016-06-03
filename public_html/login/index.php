<?php 
//set up error handler

defined('SITE_ROOT')? null: define('SITE_ROOT',$_SERVER['DOCUMENT_ROOT']);

include(SITE_ROOT.'/global/class.error_handler.php');
$handler = new error_handler(NULL,1,1,'colin-h@dircon.co.uk',SITE_ROOT.'global/error_logs/test.com.txt');
set_error_handler(array(&$handler, "handler"));

//include config
require_once(SITE_ROOT.'/login/includes/config.php');


//if logged in redirect to members page
if( $user->is_logged_in() ){ header('Location: memberpage.php'); } 

//if form has been submitted process it
if(isset($_POST['submit'])){

    //very basic validation
    if(strlen($_POST['username']) < 3){
        $error[] = 'Username is too short.';
    } else {
        $stmt = $db->prepare('SELECT username FROM members WHERE username = :username');
        $stmt->execute(array(':username' => $_POST['username']));
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        if(!empty($row['username'])){
            $error[] = 'Username provided is already in use.';
        }

    }
    //Password validation
    if(strlen($_POST['password']) < 3){
        $error[] = 'Password is too short.';
    }

    if(strlen($_POST['passwordConfirm']) < 3){
        $error[] = 'Confirm password is too short.';
    }

    if($_POST['password'] != $_POST['passwordConfirm']){
        $error[] = 'Passwords do not match.';
    }

    //email validation
    if(!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)){
        $error[] = 'Please enter a valid email address';
    } else {
        $stmt = $db->prepare('SELECT email FROM members WHERE email = :email');
        $stmt->execute(array(':email' => $_POST['email']));
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        if(!empty($row['email'])){
            $error[] = 'Email provided is already in use.';
        }

    }


    //if no errors have been created carry on
    if(!isset($error)){

        //hash the password
        $hashedpassword = $user->password_hash($_POST['password'], PASSWORD_BCRYPT);

        //create the activasion code
        $activasion = md5(uniqid(rand(),true));

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

            // insert into contacts
            $stmt = $db->prepare('INSERT INTO contacts (MemberID,first_name,last_name,email) VALUES (:memberid,:firstname,:lastname, :email)');

            $stmt->execute(array(
                ':memberid' => $id,
                ':firstname' => $_POST['f_name'],
                ':lastname' => $_POST['l_name'],
                ':email' => $_POST['email']
            ));



            //send email
            $to = $_POST['email'];
            $subject = "Registration Confirmation";
            $body = "Thank you for registering at TheShineModel.com.\n\n Username:".$_POST['username']. "\n\n To activate your account, please click on this link:\n\n ".DIR."activate.php?x=$id&y=$activasion\n\n Regards Site Admin \n\n";
            $additionalheaders = "From: <".SITEEMAIL.">\r\n";
            $additionalheaders .= "Reply-To: $".SITEEMAIL."";
            mail($to, $subject, $body, $additionalheaders);

            //redirect to index page
            header('Location: index.php?action=joined');
            exit;

            //else catch the exception and show the error.
        } catch(PDOException $e) {
            $error[] = $e->getMessage();
        }

    }

}

//define page title
$title = 'SHINE Login';

//include header template
require('layout/header.php'); 
?>

<div class="container_bg">

    <div "form_container">
        <div class="container-fluid">

            <div class="row">

                <div id="loginbox" style="margin-top:50px;margin-left:50px;" class="mainbox col-md-3 col-md-offset-0 col-sm-12 col-sm-offset-1">
                    <div class="panel panel-default" style="width:1200px;margin:15px;">

                        <form role="form" method="post" action="" autocomplete="off">
                            <div style="margin:15px;">
                                <h2>Please Sign Up</h2>
                                <p>Already a member? <a href='login.php'>Login</a> <a href='/index.php'><b>HOME</b></a></p>

                                <?php
                                //check for any errors and then display
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
                            </div>
                            <div class="row">
                                <div class="col-xs-4 col-sm-4 col-md-4">
                                    <div class="form-group" style="margin:15px;">
                                        <input type="text" name="f_name" id="first_name" class="form-control input-lg" placeholder="First Name" value="<?php if(isset($error)){ echo $_POST['f_name']; } ?>" tabindex="1">
                                    </div>
                                </div>
                                <div class="col-xs-4 col-sm-4 col-md-4">
                                    <div class="form-group" style="margin:15px;">
                                        <input type="text" name="m_name" id="middlename" class="form-control input-lg" placeholder="Middle Name" value="<?php if(isset($error)){ echo $_POST['m_name']; } ?>" tabindex="2">
                                    </div>
                                </div>
                                <div class="col-xs-4 col-sm-4 col-md-4">
                                    <div class="form-group" style="margin:15px;">
                                        <input type="text" name="l_name" id="last_name" class="form-control input-lg" placeholder="Last Name" value="<?php if(isset($error)){ echo $_POST['l_name']; } ?>" tabindex="3">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group" style="margin:15px;">
                                <input type="text" name="username" id="username" class="form-control input-lg" placeholder="User Name" value="<?php if(isset($error)){ echo $_POST['username']; } ?>" tabindex="4">
                            </div>
                            <div class="form-group"  style="margin:15px;">
                                <input type="email" name="email" id="email" class="form-control input-lg" placeholder="Email Address" value="<?php if(isset($error)){ echo $_POST['email']; } ?>" tabindex="5">
                            </div>
                            <div class="row">
                                <div class="col-xs-6 col-sm-6 col-md-6">
                                    <div class="form-group" style="margin:15px;">
                                        <input type="password" name="password" id="password" class="form-control input-lg" placeholder="Password" tabindex="6">
                                    </div>
                                </div>
                                <div class="col-xs-6 col-sm-6 col-md-6">
                                    <div class="form-group"  style="margin:15px;">
                                        <input type="password" name="passwordConfirm" id="passwordConfirm" class="form-control input-lg" placeholder="Confirm Password" tabindex="7">
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-xs-6 col-md-6"  style="margin:15px;"><input type="submit" name="submit" value="Register" class="btn btn-primary btn-block btn-lg" tabindex="8"></div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>




    <?php 
    //include header template
    require('layout/footer.php'); 
    ?>