<?php
//////////////////////////////////////////////Get All header Links//////////////////////////////////////////////////////////////////////////////
include "Mysql/connect_to_mysql.php"; 
$CompayId ="";
$Slogon ="";
$Logo ="";
$logoUrl ="";
$Category ="";
$Product ="";
$newProduct1 ="";
$newProduct2 ="";
$LinksHead ="";
if (!isset($_REQUEST ['CId'])) {
      header("location: Index.php"); 
                exit();
}
else
{
$CompayId = preg_replace('#[^0-9]#i', '',$_REQUEST ['CId']);
}

/////////////////////////////////////////////Get Company Slogan//////////////////////////////////////////////////////////////////////////////////

 $result2 = mysqli_query($dbhandle,"SELECT * FROM Company where CompanyId = $CompayId");
// ------- MAKE SURE Company EXISTS IN DATABASE ---------
$existCount = mysqli_num_rows($result2); // count the row nums
if ($existCount == 0) { // evaluate the count
     header("location:Index.php"); 
     exit();
}
while($row = mysqli_fetch_array($result2))
{
	$CompanyName  = $row["CompanyName"];
  $Slogon  = $row["Company_Slogon"];
  $Logo = $row["CompanyId"];
  $logoUrl = $row["Company_LogoUrl"];
}

/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
	
	
 $result1 = mysqli_query($dbhandle,"SELECT * FROM links where CompanyId = $CompayId ORDER BY LinkID asc");
while($row = mysqli_fetch_array($result1))
{
  $LinksHead .= '<li><a href="'.$row["LinkUrl"].'">'.$row["LinkName"].'</a></li>';
}
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

 
/////////////////////////////////////////////Get Company Product Category////////////////////////////////////////////////////////////////////////
 $result3 = mysqli_query($dbhandle,"SELECT * FROM Category where CompanyId = $CompayId");
while($row = mysqli_fetch_array($result3))
{
  $Category  .= '<li><a href="Page.php?CatId='.$row["CategoryId"].'&CId='.$CompayId.'">'.$row["CategoryName"].'</a></li>';
}
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////	 

/////////////////////////////////////////////Get Company Events ////////////////////////////////////////////////////////////////////////
 $Events ="";
 $Skip = 0;
 $result3 = mysqli_query($dbhandle,"SELECT * FROM events where CompanyID = $CompayId");
while($row = mysqli_fetch_array($result3))
{
	if($Skip != 1)
	{
         $Events  .= '<img src="Images/Events/'.$row["EventID"].'.jpg" alt="" />';
		 $Skip = 1;
	}
	else {
		$Events  .= '<a href="'.$row["EventUrl"].'"><img src="Images/Events/'.$row["EventID"].'.jpg" alt="" title="'.$row["EventTitle"].'" /></a>';
		$Skip = 0;
	}
}//  
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////	 



////////////////////////selecteer Companies huidige style theme////////////////////////////////////
$Style_Name = "";
$sql = mysqli_query($dbhandle,"SELECT Style_Name FROM company_styles a inner join styles b on a.Company_Style_Id = b.StyleId where a.CompanyID= $CompayId;");
$productCount = mysqli_num_rows($sql); // count the output amount
if ($productCount > 0) {
	while($row = mysqli_fetch_array($sql)){ 
         
			 $Style_Name = $row["Style_Name"];
	}
} else {
	$Style_Name = "Classic";
}

////////////////////////////////////////////////////////////////////////////////////////////








?>