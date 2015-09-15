<?php
/*
 * Copyright (c) 2015 Daniel Flam of NewYorkBrass.com
 *
 * Permission is hereby granted, free of charge, to any person obtaining a copy
 * of this software and associated documentation files (the "Software"), to deal
 * in the Software without restriction, including without limitation the rights
 * to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 * copies of the Software, and to permit persons to whom the Software is
 * furnished to do so, subject to the following conditions:
 *
 * The above copyright notice and this permission notice shall be included in
 * all copies or substantial portions of the Software.
 *
 * The software and/or its derivatives are used in a non-commercial manner.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
 * THE SOFTWARE.
 */
define ( 'SENDERELLA', true );

require_once 'common.php';

require ("Login.class.php"); // pull in file
$login = new Login (); // create object login

$login->authorize (); // make user login

?>
<html>
<head>
<link rel="stylesheet" href="css/dropzone.css" />
<link rel="stylesheet" href="css/style.css" />
<link rel="stylesheet" href="css/960_12_col.css" />
<link rel="stylesheet" href="css/tagmanager.css" />
<link rel="stylesheet" href="css/senderella.css" />

<script src="js/jquery-2.1.4.min.js"></script>
<script type="text/javascript" src="js/tagmanager.js"></script>
<script src="js/dropzone.js"></script>
<script> 		
	Dropzone.options.myAwesomeDropzone = {
	  init: function() {

		    var thisDropzone = this;
		      
		    this.on("queuecomplete", function(file) { 
				$( "#reset_files" ).prop("disabled",false);
				$( "#submit_files" ).prop("disabled",false);				
			});
	      
		    this.on("addedfile", function(file) { 
				$( "#reset_files" ).prop("disabled",true);
				$( "#submit_files" ).prop("disabled",true);
			});
			
		    $.getJSON('listfiles.php', function(data) {
			  $.each(data, function(index, val) {
			    var mockFile = { name: val.name, size: val.size };
			    console.log(val);
			    thisDropzone.options.addedfile.call(thisDropzone, mockFile);
			    thisDropzone.emit("complete", mockFile);
			    //thisDropzone.options.thumbnail.call(thisDropzone, mockFile, val.fullname);
			  });
			});		
			    
		  }
		};
</script>




</head>
<body>
	<div class="container_12">
		<div class="grid_9">
			<p class="logo_css">Senderella</p>
			<p class="logo_css_tagline">Sending files made easy</p>
		</div>
		<div class="grid_3">
			<p>
				<img src="img/envelope-clipart-envelope_clip_art_16131.jpg" />
			</p>
			<p>
				<a href="<?=ADMINURL?>/logoff.php?action=clear_login">logout</a>
			</p>
		</div>
		<div class="clear"></div>
		<form action="send_files.php">
			<div class="grid_9">
				Email Address: <input type="text" id="email" name="email"
					style="width: 100%" class="tm-input tm-input-info tm-input-01" />
			</div>
			<div class="clear"></div>
			<div class="grid_9">
				Subject: <input type="text" name="subject" style="width: 100%" />
			</div>
			<div class="clear"></div>
			<div class="grid_9">
				Description:<br />

				<textarea rows="4" style="width: 100%" name="desc"></textarea>
			</div>
			<div class="clear"></div>
			<div class="grid_12">
				<input type="submit" value="Send files" id="submit_files" /> <input
					type="button" id="reset_files" value="reset" />
			</div>
			<div class="clear"></div>
		</form>
		<div class="grid_12">&nbsp;</div>
		<div class="clear"></div>
		<div class="grid_12">
			<form action="file-upload.php" class="dropzone"
				id="my-awesome-dropzone"></form>
		</div>
		<div class="clear"></div>
		<div class="grid_12">
			<br />
			<p
				style="font-weight: normal; color: #000000; letter-spacing: 1pt; word-spacing: 2pt; font-size: 12px; text-align: left; font-family: arial, helvetica, sans-serif; line-height: 1;">
				(C) 2015 <a href="http://blog.NewYorkBrass.com">NewYorkBrass.com</a>
				- code released under MIT license for non-commercial use. Commercial license available
			</p>
		</div>
		<div class="clear"></div>
	</div>

	<script type="text/javascript">
	
	  $(function() {

		$( "#reset_files" ).prop("disabled",true);
		$( "#submit_files" ).prop("disabled",true);
	  
	    $( "#reset_files" ).on( "click", function() {
			window.location.href="reset.php";       
		});		
	    $( "#email" ).tagsManager({
		    hiddenTagListName: "email_tags",
			blinkBGColor_1: '#FFFF9C',
	        blinkBGColor_2: '#CDE69C'
		});    
	  });
	</script>
</body>
</html><?php

session_write_close();
