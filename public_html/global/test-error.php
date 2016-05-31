<?
	//setting error reporting to off appears to be optional...
	//error_reporting(0);
	//ini_set('display_errors','0');

	include("/home/username/global/class.error_handler.php");
	$handler = new error_handler("127.0.0.1",1,6,NULL,'/home/username/global/error_logs/test.com.txt');

	
	set_error_handler(array(&$handler, "handler"));

	//testing...
	// undefined constant, generates a notice
	$t = I_AM_NOT_DEFINED;
	
	//generates a warning
	$v = 7/0;
?>