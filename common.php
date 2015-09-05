<?php

defined('SENDERELLA')||(header("HTTP/1.1 403 Forbidden")&die('403.14 - Directory listing denied.'));

require_once 'config.php';
require_once 'genid.php';

//if (! session_id ())
	@ session_start ();

if (!isset($_SESSION['dirname']))
{
	$_SESSION['dirname'] = generateUniqueId(48);
}

$storeFolderName = $_SESSION['dirname'];
$storeFolder = dirname ( __FILE__ ) . DS . UPLOADDIR . DS . $_SESSION['dirname'];
