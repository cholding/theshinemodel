<?php
ob_start();
session_start();

//set timezone
date_default_timezone_set('Europe/London');

//database credentials
define('DBHOST','localhost');
define('DBUSER','web203-kwikendb');
define('DBPASS','Lang@t@266');
define('DBNAME','web203-kwikendb');

//application address
define('DIR','http://www.kwiken.com/login/');
define('SITEEMAIL','colin@kwiken.com');

try {

	//create PDO connection 
	$db = new PDO("mysql:host=".DBHOST.";dbname=".DBNAME, DBUSER, DBPASS);
	$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

} catch(PDOException $e) {
	//show error
    echo '<p class="bg-danger">'.$e->getMessage().'</p>';
    exit;
}

//include the user class, pass in the database connection
include('classes/user.php');
include('classes/kwikens.php');
$user = new User($db); 
?>
