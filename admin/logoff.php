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

define ( 'SENDERELLA', true );

require_once 'common.php';

require ("Login.class.php"); // pull in file
function truncate($string, $max = 50, $rep = '...') {
	$leave = $max - strlen ( $rep );
	return substr_replace ( $string, $rep, $leave );
}
function reset_upload() {
	$fstats = @stat ( $storeFolder );
	if ($fstats [mode] & 040000) {
		system ( '\\rm -R ' . $storeFolder );
	}
}

$login = new Login (); // create object login

if (! isset ( $_GET ['action'] ) || $_GET ['action'] != "clear_login") {
	$_GET ['action'] = "clear_login";
}
$login->authorize ( 'reset_upload' ); // make user login

?><html>
<body>
	<script type="text/javascript">
setTimeout( function(){ window.location.href = '<?=ADMINURL?>'; }  , 100 );
</script>
</body>
</html>

