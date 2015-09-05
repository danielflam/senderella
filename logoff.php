<?php
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
setTimeout( function(){ window.location.href = '<?=BASEDIR?>'; }  , 100 );
</script>
</body>
</html>

