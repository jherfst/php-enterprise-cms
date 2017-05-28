
<?php
/////////////////////////////////////Get current Company name////////////////////////////
$CurrentCompanyName = "";
$Companyid = "";
if (isset($_GET['Compid'])) {
	$_SESSION["Companyid"] =  preg_replace('#[^0-9]#i', '', $_GET['Compid']);
$Companyid= $_SESSION["Companyid"];
include "../Mysql/connect_to_mysql.php"; //Connect to CMSDB
$result1 = mysqli_query($dbhandle,"SELECT * FROM Company where CompanyId = $Companyid");
$count = mysqli_num_rows($result1); // count the output amount
    if ($count > 0 ) {
   
		while($row = mysqli_fetch_array($result1))
			{
			  $CurrentCompanyName = $row["CompanyName"];
			}
        	
	}
	else {
		   header("location: Index.php"); 
            exit();
	}


}
else if(!isset($_POST['Post'])){
	  header("location: Index.php"); 
            exit();
}
?>

<?php
//////////////////////////////////////get Links//////////////////////////////////////////
$managerID = preg_replace('#[^0-9]#i', '', $_SESSION["id"]); 
$manager = preg_replace('#[^A-Za-z0-9]#i', '', $_SESSION["AdminCMS"]); 
$RechtName = "";
$RechtImage = "";
$RechtUrl = "";
$menu = "";
include "../Mysql/connect_to_mysql.php"; //Connect to CMSDB
$result2 = mysqli_query($dbhandle,"select c.RechtName,c.RechtImage,c.RechtUrl from users as a inner join Role_Rechten as b on a.RoleId = b.RoleId
inner join Rechten as c on c.idRechten = b.RechtId where User_Login ='$manager' and User_ID = $managerID");

while($row = mysqli_fetch_array($result2))
{
  $RechtName = $row["RechtName"];
  $RechtImage = $row["RechtImage"];
  $RechtUrl = $row["RechtUrl"];
  $menu .='<div><a href="'.$RechtUrl.''.$_SESSION["Companyid"].'">'.$RechtName.'<img src="'.$RechtImage.'" alt=""  /></a></div>';
}
////////////////////////////////////////////////////////////////////////////////////////////
?>



<!DOCTYPE HTML PUBLIC '-//W3C//DTD HTML 4.01 Transitional//EN' 'http://www.w3.org/TR/html4/loose.dtd'>
<html>
<head>
<title>
Admin Page
</title>
<link href="../Styles/AdminStyle.css" rel="stylesheet" type="text/css" media="screen" />
<link href="../Styles/table.css" rel="stylesheet" type="text/css" media="screen" />
</head>

<body>
<div id="header">
				<div id="headerWrapper">
				<div id="logo">
			<a href="Index.php"><img src="../Images/Admin/logpo.png" alt=""  /></a>
			     </div>
			     <div id="Logout">
				Welkom <?php echo $_SESSION["AdminCMS"]?>, <a href="Logout.php">Log out</a>
			     </div>
			     <div id="Current">
				<a href="../Home.php?CId=<?php echo $Companyid?>&pid=1"><?php if(isset($CurrentCompanyName)) echo $CurrentCompanyName?> <img src="../Images/Admin/com.png" alt=""  /></a>
			     </div>
			     
			     </div>
</div>
<div id="Wrapper">
<div id="nav">
	
	<?php echo $menu;?>

</div>