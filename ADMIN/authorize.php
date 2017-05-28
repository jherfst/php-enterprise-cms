<?php

session_start();
if (!isset($_SESSION["AdminCMS"])) {
    header("location: Admin_login.php"); 
    exit();
}

$managerID = preg_replace('#[^0-9]#i', '', $_SESSION["id"]); 
$manager = preg_replace('#[^A-Za-z0-9]#i', '', $_SESSION["AdminCMS"]); 


include "../Mysql/connect_to_mysql.php"; 
 $sql = mysqli_query($dbhandle,"SELECT User_ID,User_password FROM users WHERE User_ID = $managerID and  User_Login='$manager'  LIMIT 1");

$existCount = mysqli_num_rows($sql);
if ($existCount == 0) { 
	 echo "Your login session data is not on record in the database.";
     exit();
}
?>