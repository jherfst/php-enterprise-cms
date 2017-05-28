<?php  

$dbhost = "localhost"; 

$dbusername = "dbuser";  

$dbpass = "dbuser";  

$dbname = "cmsdb"; 

$dbhandle = mysqli_connect("$dbhost","$dbusername","$dbpass") or die ("could not connect to mysql");
mysqli_select_db($dbhandle,"$dbname") or die ("no database");              
?>