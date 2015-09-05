<?php

defined('SENDERELLA')||(header("HTTP/1.1 403 Forbidden")&die('403.14 - Directory listing denied.'));

require_once 'config.php';
require_once 'genid.php';

define('DS',  DIRECTORY_SEPARATOR);


//if (! session_id ())
	@ session_start ();

if (!isset($_SESSION['dirname']))
{
	$_SESSION['dirname'] = generateUniqueId(48);
}

if (!defined('ADMINURL'))
{
	//define('ADMINDIR', dirname ( __FILE__ ));
	$myBase =  ( (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] == 'on')
			? 'https://' : 'http://' ) .
			$_SERVER['HTTP_HOST'] . dirname($_SERVER['PHP_SELF']);

	define('ADMINURL', $myBase);
}

if (!defined('UPLOADDIR'))
{
	define('UPLOADDIR', "uploads");
}

if (!defined('OUTPUTDIR'))
{
	define ('OUTPUTDIR', dirname(dirname ( __FILE__ )) . DS . 'senderella' ) ;
}

if (!defined('EXTERNAL_LINK'))
{
	//define('ADMINDIR', dirname ( __FILE__ ));
	$externallink =  ( (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] == 'on')
			? 'https://' : 'http://' ) .
			$_SERVER['HTTP_HOST'] . dirname(dirname($_SERVER['PHP_SELF'])) . '/senderella';

	define('EXTERNAL_LINK', $externallink );
}


$storeFolderName = $_SESSION['dirname'];
$storeFolder = dirname ( __FILE__ ) . DS . UPLOADDIR . DS . $_SESSION['dirname'];


