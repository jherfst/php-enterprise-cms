
<?php
$EnterpriseId = preg_replace('#[^0-9]#i', '',$_REQUEST ['EId']);
$Product ="";
$Companies = null;
$enterpriseName = null;
include "Mysql/connect_to_mysql.php"; //Connect to CMSDB

if (!isset($_REQUEST ['EId'])) {
      header("location: Enterprise.php");
      exit();
}

$enterpriseResult = mysqli_query($dbhandle,"SELECT * FROM Enterprise where id = $EnterpriseId");
while($row = mysqli_fetch_array($enterpriseResult))
{
  $enterpriseName  = $row["name"];

}

$result4 = mysqli_query($dbhandle,"SELECT * FROM Company where Enterprise = $EnterpriseId");
while($row = mysqli_fetch_array($result4))
{
  $Companies  .= ' <li>
 <a href="Home.php?CId='.$row["CompanyId"].'&pid=1?"><img src="Images/Companies/'.$row["CompanyId"].'.png" alt="" width="132" height="132" border="1" /><br/>'.$row["CompanyName"].'</a>
 </li>';

}
?>


<!DOCTYPE HTML PUBLIC '-//W3C//DTD HTML 4.01 Transitional//EN' 'http://www.w3.org/TR/html4/loose.dtd'>
<html>
<head>
<title>
Landing Page
</title>
<link href="Styles/Style.css" rel="stylesheet" type="text/css" media="screen" />
</head>

<body>
<center>
<div id="MainCompanies">
<h1>Welcome To <?php echo $enterpriseName;?> </h1>
 <ul>
<?php echo $Companies;?>
 </ul>
</div>
</center>

</body>

</html>