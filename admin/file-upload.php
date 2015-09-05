<?php

define ('SENDERELLA', true);

require_once 'common.php';

require("Login.class.php"); // pull in file
$login = new Login; // create object login

$login->authorize(); // make user login

if (!is_dir($storeFolder))
{
	mkdir($storeFolder);
}

if (!empty($_FILES)) {
	 
	$tempFile = $_FILES['file']['tmp_name'];          

	//$targetPath = dirname( __FILE__ ) . $ds. $storeFolder . $ds;  
	$targetPath = $storeFolder . DS;  
	 
	$targetFile =  $targetPath. $_FILES['file']['name'];  

	move_uploaded_file($tempFile,$targetFile); 
}
