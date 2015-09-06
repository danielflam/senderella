Senderella
==========

Ever used DropBox, Sendspace, or any other file drop service, and wish you could have something on your server?

This project will allow you to have a similar ability to send lots of (large) files directly from your server.
It has saved me countless of hours and dollars and hopefully will help you too. I have sent gigs of files using this
script.  

You drop your files onto the form, add a recipient email, description, and subject line hit send.
The recipient will receive a link to a zip file he can download
 
Boom. Thats it. 


Screen Shot
===========

![Senderella](http://download.newyorkbrass.com/images/senderella.png "Senderella")

Configuration
=============

If you unzip in a folder and apply the proper file permissions - there is very little to configure.
Copy the "config-initial.php" to "config.php" and edit the file.
Set the admin username and password ( this is a very basic system as it is inteded for personal use ) 
and your email. other than that everything should more or less work. 
Point your browser at www.yoursite.com/admin and send away!!

Currently only works on linux if you need a windows version, feel free to fork the repo and add the functionality.

Notes
=====

Large files : If you cannot upload large files - look at the php and server configurations.

Limitations 
===========
The program is single session - so you can't open multiple browser windows and prepare multiple drops.
*However* it allows you to close the window and return to your work in progress, hence the "reset" button. 
  
The maximum send is limited by what zip can process on the server The basic Zip format has a limit of 4 GB per file. 
If you need larger files - You will need to upgrade your zip tool to one that supports Zip64.


Follow me on twitter [@NewYorkBrass](https://twitter.com/NewYorkBrass) 
 

