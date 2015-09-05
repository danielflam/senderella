<?php

// username to login into page
define('LOGIN_USER', "admin");

// password to login into page
define('LOGIN_PASS', "secret");

define('DS',  DIRECTORY_SEPARATOR); 


// dont touch
define('UPLOADDIR', "uploads");

// This is the admin console path (where you send files from)
define ('BASEDIR', "http://your.site.here/senderella/");

// This is the local path on server where the files will be 
// stored and served
define('OUTPUTDIR',  "/var/www/local path to web directory of filedrop");

// This is the external link to this web directory
// It is recommended to add an empty index.html to this 
// directory to prevent someone from listing the files
define('EXTERNAL_LINK', "http://your.site.here/filedrop/");

// your email address 
define('FROM_EMAIL', 'your.email@wherever.com');

// This prefix will be prepended to the subject line
define ('SUBJECT_MESSAGE', '[Files Are Ready]');

