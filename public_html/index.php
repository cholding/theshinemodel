	
    <?php
    defined('SITE_ROOT')? null: define('SITE_ROOT',$_SERVER['DOCUMENT_ROOT']);

    include(SITE_ROOT.'/global/class.error_handler.php');
    $handler = new error_handler(NULL,1,1,'colin-h@dircon.co.uk',SITE_ROOT.'/global/error_logs/test.com.txt');
    set_error_handler(array(&$handler, "handler"));
    //

    
    // echo 'this is login php';
    //check if already logged in move to home page
    header('location: login/index.php'); 

    ?>

