
<?php
$Enterprises = null;
include "Mysql/connect_to_mysql.php"; //Connect to CMSDB


$enterpriseResult = mysqli_query($dbhandle,"SELECT * FROM Enterprise");
while($row = mysqli_fetch_array($enterpriseResult))
{
  $Enterprises  .= ' <li>
   <a href="Index.php?EId='.$row["id"].'">'.$row["name"].'</a>
   </li>';
}
?>


<!DOCTYPE HTML PUBLIC '-//W3C//DTD HTML 4.01 Transitional//EN' 'http://www.w3.org/TR/html4/loose.dtd'>
<html>
<head>
<title>
Enterprise Page
</title>
<link href="Styles/Style.css" rel="stylesheet" type="text/css" media="screen" />
</head>

<body>
<center>
<div id="MainCompanies">
<h1>All enterprises registered</h1>
 <ul>
<?php echo $Enterprises;?>
 </ul>
</div>
</center>

</body>

</html>