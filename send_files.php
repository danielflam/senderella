<?php
define ( 'SENDERELLA', true );

require_once 'common.php';

require ("Login.class.php"); // pull in file
$login = new Login (); // create object login

$login->authorize (); // make user login
function truncate($string, $max = 50, $rep = '...') {
	$leave = $max - strlen ( $rep );
	return substr_replace ( $string, $rep, $leave );
}

$validfiles = FALSE;

$count = 0;

if (is_dir ( $storeFolder )) {
	$fi = new FilesystemIterator ( $storeFolder, FilesystemIterator::SKIP_DOTS );
	$count = iterator_count ( $fi );
	if ($count > 0) {
		$validfiles = TRUE;
	}
}

unset ( $_SESSION ['dirname'] );
session_write_close ();

?>

<?php
if ($validfiles) {
	echo "<pre>";
	chdir ( $storeFolder );
	system ( 'zip -r ' . OUTPUTDIR . DS . $storeFolderName . ".zip *" );
	chdir ( ".." );
	system ( '\\rm -R ' . $storeFolder );
	echo "</pre>";
	
	?>

<br />
<?= $_REQUEST['email']?>


<br />
<?= $_REQUEST['desc']?>
<br />



<?php
	
	$subject = SUBJECT_MESSAGE . " " . truncate ( trim ( $_REQUEST ["subject"] ), 50, "..." );
	$to = trim ( $_REQUEST ['email'] );
	
	$external_link = EXTERNAL_LINK;
	
	$body = <<<BODY
<html xmlns:v="urn:schemas-microsoft-com:vml" xmlns:o="urn:schemas-microsoft-com:office:office" xmlns:w="urn:schemas-microsoft-com:office:word" xmlns:m="http://schemas.microsoft.com/office/2004/12/omml" xmlns="http://www.w3.org/TR/REC-html40">

<head>
<META HTTP-EQUIV="Content-Type" CONTENT="text/html; charset=us-ascii">
<meta name=Generator content="Microsoft Word 12 (filtered medium)">
<style>
<!--
 /* Font Definitions */
 @font-face
	{font-family:Calibri;
	panose-1:2 15 5 2 2 2 4 3 2 4;}
 /* Style Definitions */
 p.MsoNormal, li.MsoNormal, div.MsoNormal
	{margin:0in;
	margin-bottom:.0001pt;
	font-size:11.0pt;
	font-family:"Calibri","sans-serif";}
a:link, span.MsoHyperlink
	{mso-style-priority:99;
	color:blue;
	text-decoration:underline;}
a:visited, span.MsoHyperlinkFollowed
	{mso-style-priority:99;
	color:purple;
	text-decoration:underline;}
span.EmailStyle17
	{mso-style-type:personal-compose;
	font-family:"Calibri","sans-serif";
	color:windowtext;}
.MsoChpDefault
	{mso-style-type:export-only;}
@page Section1
	{size:8.5in 11.0in;
	margin:1.0in 1.0in 1.0in 1.0in;}
div.Section1
	{page:Section1;}
-->
</style>
<!--[if gte mso 9]><xml>
 <o:shapedefaults v:ext="edit" spidmax="1026" />
</xml><![endif]--><!--[if gte mso 9]><xml>
 <o:shapelayout v:ext="edit">
  <o:idmap v:ext="edit" data="1" />
 </o:shapelayout></xml><![endif]-->
</head>

<body lang=EN-US link=blue vlink=purple>

<div class=Section1>

<p class=MsoNormal>Hi {$_REQUEST['email']}!<o:p></o:p></p>

<p class=MsoNormal><o:p>&nbsp;</o:p></p>

<p class=MsoNormal>Your files(s) are ready to download. You can get them here: </p>
<p><a href="{$external_link}{$storeFolderName}.zip">{$external_link}{$storeFolderName}.zip</a></p>

 <p class=MsoNormal>Notes:</p>
 <p class=MsoNormal>{$_REQUEST['desc']}</p>
			
<a href="https://twitter.com/NewYorkBrass" class="twitter-follow-button" data-show-count="false" data-size="large">Follow Us On Twitter! @NewYorkBrass</a>

</div>

</body>

</html>

BODY;
	
	echo $body;
	$email_to = trim ( $_REQUEST ['email'] );
	
	mail ( $email_to, $subject, $body, "From: " . FROM_EMAIL . "\nContent-Type: text/html; charset=iso-8859-1" );
} else {
	echo "Nothing to do";
}

?>

<br/><br/>
<a href="<?=BASEDIR?>">SEND MORE FILES</a>