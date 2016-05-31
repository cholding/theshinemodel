<?php
//logging file

Class cLog
{
	
	/**
	* Write to a file
	* @param $strFilename - this is the name of the file
	* @param $strData - this is the data we will write to the file
	*/
	Public Function Write($strFileName, $strData)
	{
		//If(!is_writable($strFileName)){
		//	die('Please change permissions for ' .$strFileName );
		//
		$handle=fopen($strFileName, "a+");
		fwrite($handle, "\n" . $strData);
		fclose($handle);
		
	} 
	
	Public function Read($strFileName) 
	{
		
		$handle=fopen($strFileName, "r");
		return file_get_contents($strFileName);
		
		fclose($handle);
	}
	

}


?>