
<?Php 

session_start();

session_destroy();
 header("location: Admin_login.php"); 
    exit();
?>