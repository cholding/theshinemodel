<?php
defined('SITE_ROOT')? null: define('SITE_ROOT',$_SERVER['DOCUMENT_ROOT']);
echo SITE_ROOT;
include(SITE_ROOT.'/global/class.error_handler.php');
$handler = new error_handler(NULL,1,1,'colin-h@dircon.co.uk',SITE_ROOT.'/global/error_logs/test.com.txt');
set_error_handler(array(&$handler, "handler"));
//


    //define page title
    $title = 'Member Page';

    //include header template
    require(SITE_ROOT.'/login/layout/header.php'); 


?>

<h1> This is a test</h1>
<?php 
    //include header template
    require(SITE_ROOT.'/login/layout/footer.php'); 
?>