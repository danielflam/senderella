<?php
/*
Copyright (c) 2015 Daniel Flam of NewYorkBrass.com

Permission is hereby granted, free of charge, to any person obtaining a copy
of this software and associated documentation files (the "Software"), to deal
in the Software without restriction, including without limitation the rights
to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
copies of the Software, and to permit persons to whom the Software is
furnished to do so, subject to the following conditions:

The above copyright notice and this permission notice shall be included in
all copies or substantial portions of the Software.

The software and/or its derivatives are used in a non-commercial manner.

THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
THE SOFTWARE.
 */

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
