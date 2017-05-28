<?php
require 'Classes/Page.inc';

$homepage = new Pagina();


include_once 'includes/Header.php';

/////////////////////////////////////////////Get Top Products voor home page////////////////////////////////////////////////////////////////////////
 $result3 = mysqli_query($dbhandle,"SELECT * FROM Products where CompanyID = $CompayId order by Prod_Id limit 8");
while($row = mysqli_fetch_array($result3))
{
  $Product  .= ' <li> 
		     <div class="product_title">'.$row["Product_Name"].'</div> 
		 <a href="Page.php?CId='.$CompayId.'&DetID='.$row["Prod_Id"].'"><img style="border:#666 1px solid;" src="Images/Products/'.$row["Prod_Id"].'.jpg" alt="" width="132" height="132" border="1" /></a>
		<div class="prod_price"><span class="reduce">$</span> <span class="price">'.$row["Product_Price"].'</span></div>
		<div class="prod_details_tab">  <a href="Page.php?CId='.$CompayId.'&DetID='.$row["Prod_Id"].'">View details</a> </div>
		  </li>';
	$newProduct1 = $row["Prod_Id"];
    $newProduct2 = $row["Prod_Id"] - 1;
}
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////	 
	
$TopProduct = '<div  id="topprod"><ul>'.$Product.'</ul></div>';
	 
	 //$LinksHead = '<ul><li><a href="#">HOME</a></li><li><a href="#">ABOUT US</a></li><li><a href="#">CONTACT US</a></li></ul>';
$homepage -> SetProductCategory('
<img src="Images/Site/button.png" width="184" height="32" class="menu_class" />
<ul class="the_menu">
<li><form action="ADMIN/Admin_login.php" method="POST">User:  <input type="text" name="AdminCMS"/><br/>
Login:<input type="password" name="pass"/><br/>
<input type="SUBMIT" Value="Login"/>
</form></li>
</ul>
<ul>
<li>CATEGORY</li>
'.$Category.'
</ul>');
$homepage -> Setcontent1('<img src="Images/Products/'.$newProduct1.'.jpg" alt="'.$newProduct1.'" width="335px" height="300px"/>');
$homepage -> Setcontent2('<img src="Images/Products/'.$newProduct2.'.jpg" alt="'.$newProduct1.'" width="335px" height="300px"/>');
$homepage -> Setcontent3($TopProduct);
$homepage ->SetScreen($Events);
$homepage ->SetPageStyle($Style_Name);
$homepage -> SetSlogon($Slogon);
$homepage ->SetLogo($Logo,$logoUrl);
$homepage ->SetHeaderLinks($LinksHead);
$homepage ->SetTitle($CompanyName);
$homepage ->SetKeywords("test");

$homepage -> Display();

?>