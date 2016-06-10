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




    // this is not a submit so we collect info and populate fields
    //        $stmt = $db->prepare('SELECT username FROM members WHERE username = :username');
$memberid=$_SESSION['memberid'];
    
echo "This is member id " .$memberid;

//$stmt = $db->prepare('SELECT first_name, last_name, email FROM contacts WHERE MemberID = :memberid');
echo "SELECT first_name, last_name, username, email FROM contacts WHERE MemberID = :memberid";

$stmt = $db->prepare('SELECT contacts.first_name, contacts.last_name,members.username, members.email FROM contacts INNER JOIN members ON contacts.MemberID = members.memberID WHERE members.memberID = :memberid');
//
$stmt->bindParam(':memberid',$memberid,PDO::PARAM_INT);

try{
    $stmt->execute();
    echo "still ok";


}catch(PDOException $e){
    echo ErrorHandle($e);
    
}

$result = $stmt->fetchAll(PDO::FETCH_ASSOC);
$arrlength=count($result);
echo "<br/><br/>";

echo $arrlength;
echo "<br/><br/>";
print_r($result);
echo "<br/><br/>";
var_dump($result);
echo "<br/><br/>";
//echo "what !!";
//
//echo "<br/><br/>";

echo $result [0]["first_name"];
echo "<br/><br/>";
echo $result [0]["last_name"];
echo "<br/><br/>";
echo $result [0]["email"];





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