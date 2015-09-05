<?php
define ( 'SENDERELLA', true );

require_once 'common.php';

require ("Login.class.php"); // pull in file
function truncate($string, $max = 50, $rep = '...') {
	$leave = $max - strlen ( $rep );
	return substr_replace ( $string, $rep, $leave );
}

function reset_upload() {
	$fstats = @stat( $storeFolder );
	
	error_log('here i am ');
	
	if ($fstats[mode] & 040000) {
		system ( '\\rm -R ' . $storeFolder );
	}
}

$login = new Login (); // create object login

$login->authorize (); // make user login


reset_upload();

unset ( $_SESSION ['dirname'] );
session_write_close ();

?><html>
<body>
	<script type="text/javascript">
setTimeout( function(){ window.location.href = '<?=ADMINURL?>'; }  , 100 );
</script>
</body>
</html>