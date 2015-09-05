<?php
define ( 'SENDERELLA', true );

require_once 'common.php';

require ("Login.class.php"); // pull in file
$login = new Login (); // create object login

$login->authorize (); // make user login

$result = array ();

$fstats = @stat ( $storeFolder );

if ($fstats [mode] & 040000) {
	$files = scandir ( $storeFolder ); // 1
	if (false !== $files) {
		foreach ( $files as $file ) {
			if ('.' != $file && '..' != $file) { // 2
				$obj ['fullname'] = $storeFolder . DS . $file;
				$obj ['name'] = $file;
				$obj ['size'] = filesize ( $storeFolder . DS . $file );
				$result [] = $obj;
			}
		}
	}
}

header ( 'Content-type: text/json' ); // 3
header ( 'Content-type: application/json' );
echo json_encode ( $result );