<?php 
 include_once 'authorize.php';
?>
<?php 
// Script Error Reporting
error_reporting(E_ALL);
ini_set('display_errors', '1');
?>

<?php

$Product ="";
$Companies = null;
include "../Mysql/connect_to_mysql.php"; //Connect to CMSDB
$result4 = mysqli_query($dbhandle,"SELECT * FROM Company");
while($row = mysqli_fetch_array($result4))
{
  $Companies  .= ' <li>
 <a href="Product.php?Compid='.$row["CompanyId"].'"><img src="../Images/Companies/'.$row["CompanyId"].'.png" alt="" width="132" height="132" border="1" /><br/>'.$row["CompanyName"].'</a>
 </li>';

}
?>
<!DOCTYPE HTML PUBLIC '-//W3C//DTD HTML 4.01 Transitional//EN' 'http://www.w3.org/TR/html4/loose.dtd'>
<html>
<head>
<title>
Landing Page
</title>
<link href="../Styles/Style.css" rel="stylesheet" type="text/css" media="screen" />
</head>

<body>
<center>
<div id="MainCompanies">
<h1>Welcome <?php echo $manager?>, which company you want to managed today?</h1>
 <ul>
<?php if(is_null($Companies)){ echo "There No Companies Set up Jet! Add New Company<a href='Company.php?Compid=$Company'>Here</a>";} echo $Companies?>
 
 </ul>
</div>
</center>

</body>

</html>