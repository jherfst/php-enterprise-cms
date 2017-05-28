<?php
include_once 'includes/Header.php';
/////////////////////////////////////////////Get Products////////////////////////////////////////////////////////////////////////
if (isset($_GET['CId']) && isset($_GET['CatId'])) {
$CompId = preg_replace('#[^0-9]#i', '', $_GET['CId']); 
	$CatId = preg_replace('#[^0-9]#i', '', $_GET['CatId']); 
 $result4 = mysqli_query($dbhandle,"SELECT * FROM Products where CompanyID = $CompId and CategoryId = $CatId  order by Prod_Id ");
while($row = mysqli_fetch_array($result4))
{
  $Product  .= ' <li> 
		     <div class="product_title">'.$row["Product_Name"].'</div> 
		 <a href="Page.php?CId='.$CompId.'&DetID='.$row["Prod_Id"].'"><img style="border:#666 1px solid;" src="Images/Products/'.$row["Prod_Id"].'.jpg" alt="" width="132" height="132" border="1" /></a>
		<div class="prod_price"><span class="reduce">$</span> <span class="price">'.$row["Product_Price"].'</span></div>
		<div class="prod_details_tab">  <a href="Page.php?CId='.$CompId.'&DetID='.$row["Prod_Id"].'">View details</a> </div>
		  </li>';
	$newProduct1 = $row["Prod_Id"];
    $newProduct2 = $row["Prod_Id"] + 1;
}

$Products = '<div  id="prod"><ul>'.$Product.'</ul></div>';
}
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////	 
	
//////////////////////////////////////get Home or About or Contact page, dus header links///////////////////////////////////////////////////////////
elseif (isset($_GET['CId']) && isset($_GET['pid'])) {
	$CompId = preg_replace('#[^0-9]#i', '', $_GET['CId']); 
	$pid = preg_replace('#[^0-9]#i', '', $_GET['pid']); 
 $result4 = mysqli_query($dbhandle,"SELECT * FROM links where CompanyId = $CompId and LinkID = $pid limit 1 ");
while($row = mysqli_fetch_array($result4))
{
  $Product  .= '<div id="content"><h1>'. $row["LinkDescription"].'</h1></div> ';
}
$Products =  $Product;
}
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

///////////////////////////////////////Get product details///////////////////////////////////////////////////////////////////////////
elseif (isset($_GET['CId']) && isset($_GET['DetID'])) {
	$CompId = preg_replace('#[^0-9]#i', '', $_GET['CId']); 
	$Detialid = preg_replace('#[^0-9]#i', '', $_GET['DetID']); 
 $result5 = mysqli_query($dbhandle,"SELECT * FROM Products where CompanyID = $CompId and Prod_Id = $Detialid limit 1 ");
while($row = mysqli_fetch_array($result5))
{
  $Product  .= '
  <div id="content"><div><h1>'.$row["Product_Name"].'</h1></div><img style="border:#666 1px solid;" src="Images/Products/'.$row["Prod_Id"].'.jpg" alt="" width="532" height="532" border="1" /><div><h1>'.$row["Product_Description"].'</h1></div></div> 
                      ';
}
$Products =  $Product;
}
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

////////////////////////////////////////////else ga na Home///////////////////////////////////////////////////////////////////////
ELSE
{
		header("location: HOME.php?CId='.$CompayId.'&pid=1"); 
                exit();
}

?>