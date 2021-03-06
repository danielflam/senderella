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

/// TODO : BETTER FIELD VALIDATION - SECURITY HOLES AHEAD


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
	
	$subject = SUBJECT_PREFIX . " " . truncate ( trim ( $_REQUEST ["subject"] ), 50, "..." );
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
 p.MsoBold, li.MsoBold, div.MsoBold
	{margin:0in;
	margin-bottom:.0001pt;
	font-size:11.0pt;
	font-family:"Calibri","sans-serif";
	font-weight: bold;}
 p.MsoNormal, li.MsoNormal, div.MsoNormal
	{margin:0in;
	margin-bottom:.0001pt;
	font-size:11.0pt;
	font-family:"Calibri","sans-serif";}
 p.MsoLarger,li.MsoLarger, div.MsoLarger
	{margin:0in;
	margin-bottom:.0001pt;
	font-size:13.0pt;
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
<p><a href="{$external_link}/{$storeFolderName}.zip">{$external_link}/{$storeFolderName}.zip</a></p>

<br/>
 <p class=MsoBold>NOTES:</p>
 
 <p class=MsoLarger><b>{$_REQUEST['desc']}</b></p>
				
<p>Follow Us On Twitter! <a href="https://twitter.com/NewYorkBrass" class="twitter-follow-button" 
			data-show-count="false" data-size="large">@NewYorkBrass</a></p>
<p>Sent using <a href="https://github.com/danielflam/senderella" class="twitter-follow-button" 
			data-show-count="false" data-size="large">SENDERELLA</a></p>
			
</div>

</body>

</html>

BODY;
	
	echo $body;
	
	//$email_to = trim ( $_REQUEST ['email'] );
	
	$emails = explode(",", $_REQUEST['email_tags']);
	foreach ($emails as $email)
	{
		error_log("emailing $email");
		mail ( $email, $subject, $body, "From: " . FROM_EMAIL . "\nContent-Type: text/html; charset=iso-8859-1" );		
	}
	

} else {
	echo "Nothing to do";
}

?>

<br />
<br />
<a href="<?=ADMINURL?>">SEND MORE FILES</a>