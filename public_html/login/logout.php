<?php 
defined('SITE_ROOT')? null: define('SITE_ROOT', $_SERVER['DOCUMENT_ROOT']);


require(SITE_ROOT.'/login/includes/config.php');

//logout
$user->logout(); 

//logged in return to index page
header('Location: ../index.php');
exit;
?>