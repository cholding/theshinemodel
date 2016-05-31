<?php
ob_start();
session_start();
defined('SITE_ROOT')? null: define('SITE_ROOT', dirname(__FILE__));

//set timezone
date_default_timezone_set('Europe/London');

//database credentials
define('DBHOST','localhost');
define('DBUSER','cl57-shine');
define('DBPASS','Lang@t@266');
define('DBNAME','cl57-shine');

//application address
define('DIR','http://www.theshinemodel.com/login/');
define('SITEEMAIL','colin@theshinemodel.com');

try {

	//create PDO connection 
	$db = new PDO("mysql:host=".DBHOST.";dbname=".DBNAME, DBUSER, DBPASS);
	$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

} catch(PDOException $e) {
	//show error
    
    echo '<p class="bg-danger">'.$e->getMessage().'</p>';


//include the user class, pass in the database connection
    
    exit;
}

include(SITE_ROOT .'/login/classes/user.php');

 $user = new User($db); 


?>
