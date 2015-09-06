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


