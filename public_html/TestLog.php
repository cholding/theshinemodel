<?php

// test


	require_once('includes/Log.php');
	
	$Log= new cLog();
	$Log-> Write('Test.txt',date("Y-m-d H:i:s") . ' This is the piece of text ' );
	echo "<pre>";
	echo $Log->Read('Test.txt');

?>