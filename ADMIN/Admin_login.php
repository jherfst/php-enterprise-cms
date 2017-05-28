<?php 

session_start();

if (isset($_SESSION["AdminCMS"])) {
    header("location: Index.php"); 
    exit();
}
?>
<?php 

if (isset($_POST["AdminCMS"]) && isset($_POST["pass"])) {

$Mess ='';
	$manager = preg_replace('#[^A-Za-z0-9]#i', '', $_POST["AdminCMS"]); 
    $password = preg_replace('#[^A-Za-z0-9]#i', '', $_POST["pass"]); 

    include ("../Mysql/connect_to_mysql.php"); 
    $sql = mysqli_query($dbhandle,"SELECT User_ID,User_password FROM users WHERE User_Login='$manager' AND User_password='$password' LIMIT 1");

    $existCount = mysqli_num_rows($sql);
    if ($existCount == 1) { 
    mysqli_query($dbhandle,"update users set User_LastLogin = now() where User_Login='$manager' AND User_password='$password'");
	     while($row = mysqli_fetch_array($sql)){
             $id = $row["User_ID"];
			 $passworddb = $row["User_password"];
		 }
		 if($passworddb ==$password)
		 {
		 $_SESSION["id"] = $id;
		 $_SESSION["AdminCMS"] = $manager;
	 $_SESSION["password"] = $password;
		 header("location: Index.php");
         exit();
	}
		 else
		 	{
				$Mess ==  'That information is incorrect, try again';
				
		 	}
    } else {
		$Mess = 'That information is incorrect, try again';

	}
}
?>
<!DOCTYPE HTML PUBLIC '-//W3C//DTD HTML 4.01 Transitional//EN' 'http://www.w3.org/TR/html4/loose.dtd'>
<html>
<head>
<title>
Landing Page
</title>
<link href="../Styles/Style.css" rel="stylesheet" type="text/css" media="screen" />
<link href="../Styles/AdminStyle.css" rel="stylesheet" type="text/css" media="screen" />
</head>

<body>
<center>
<div id="MainCompanies">
	<form action="Admin_login.php" method="post">
		 <div class="login"><h2>Please Login</h2></div>
 <div id="username"> <label>User Name</label><input type="text" name="AdminCMS" id="name" /></div>
 <div id="password">  <label>Password</label> <input type="password" name="pass" /></div>
      <div><input type="submit" name="sub" value="LOG IN" id="subm" /></div>
      <?php if(isset($Mess)) echo $Mess;?>
    </form>
</div>
</center>

</body>

</html>