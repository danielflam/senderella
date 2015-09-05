<?php
define ('SENDERELLA', true);

require_once 'common.php';

require("Login.class.php"); // pull in file
$login = new Login; // create object login

$login->authorize(); // make user login


?>
<html>
<head>
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
<script src="js/jquery-2.1.4.min.js"></script>
<link rel="stylesheet" href="css/dropzone.css" />
<link rel="stylesheet" href="css/style.css" />
<link rel="stylesheet" href="css/960/code/css/960_12_col.css" />

<style type="text/css">
.logo_css {
	font-weight: normal;
	color: #000000;
	letter-spacing: 3pt;
	word-spacing: 2pt;
	font-size: 4.6em;
	text-align: left;
	font-family: arial black, sans-serif;
	line-height: 0.8;
}

.logo_css_tagline {
	font-weight: normal;
	color: #000000;
	/* 	letter-spacing: 3pt; */
	word-spacing: 2pt;
	font-size: 2em;
	text-align: left;
	font-family: arial black, sans-serif;
	line-height: 0.8;
}
</style>

</head>
<body>
	<div class="container_12">
		<div class="grid_9">
			<p class="logo_css">Senderella</p>
			<p class="logo_css_tagline">Sending files made easy</p>
		</div>
		<div class="grid_3">
			<p> <img src="img/envelope-clipart-envelope_clip_art_16131.jpg" /> </p>
			<p><a href="http://download.newyorkbrass.com/dropsend/logoff.php?action=clear_login">logout</a></p>
		</div>
		<div class="clear"></div>
		<form action="send_files.php">
			<div class="grid_9">Email Address: <input type="text" name="email" style="width:100%" /></div>
			<div class="clear"></div>
			<div class="grid_9">
				Subject: <input type="text" name="subject" style="width:100%" />
			</div>
			<div class="clear"></div>
			<div class="grid_9">
				Description:<br />

				<textarea rows="4" style="width:100%" name="desc"></textarea>
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
				- code released under GPL. Commercial license available
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
	  });
	</script>
</body>
</html><?php 

session_write_close();