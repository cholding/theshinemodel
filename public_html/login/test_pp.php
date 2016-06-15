<?php 
defined('SITE_ROOT')? null: define('SITE_ROOT',$_SERVER['DOCUMENT_ROOT']);

include(SITE_ROOT.'/global/class.error_handler.php');
$handler = new error_handler(NULL,1,1,'colin-h@dircon.co.uk',SITE_ROOT.'global/error_logs/test.com.txt');
set_error_handler(array(&$handler, "handler"));

//include config
require_once(SITE_ROOT.'/login/includes/config.php');

echo "we are in profile page --- ";

//if not logged in redirect to login page
//if( !$user->is_logged_in() ){ header('Location: login.php'); } 


$Country=$user->getCountry('United States of America','code');


echo "<br/><br/>";

echo "the country is:".$Country;
echo "<br/><br/>";






////    $row = $stmt->fetch(PDO::FETCH_ASSOC);
////
////   $login_firstname =$row['first_name'];
////   $login_lastname =$row['last_name'];
////   $login_userid =$row['username'];
////   $login_email =$row['email'];
//
////
//   
//echo $login_firstname;
//echo "<br>";
//echo $login_lastname;
//echo "<br>";
//echo $login_userid;
//echo "<br>";
//echo $login_email;
//
////
////


                   //define page title
                   $title = 'SHINE Login';

                   //include header template
                   require('layout/header.php'); 
                  
?>





<?php 
               //include header template
               require('layout/footer.php'); 
?>