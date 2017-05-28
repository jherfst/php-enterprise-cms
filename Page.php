<?php
require 'Classes/Products.inc';

$productpage = new Products();


require 'includes/PageHead.inc';

$productpage -> SetProductCategory('
<img src="Images/Site/button.png" width="184" height="32" class="menu_class" />
<ul class="the_menu">
<li><form action="ADMIN/Admin_login.php" method="post">
User:  <input type="text" name="AdminCMS"/><br/>
Login:<input type="password" name="pass"/><br/>
<input type="SUBMIT" Value="Login"/>
</form></li>
</ul>
<ul>
<li>CATEGORY</li>
'.$Category.'
</ul>');
$productpage ->SetScreen($Events);
$productpage ->SetPageStyle($Style_Name);
$productpage -> Setcontent3($Products);
$productpage -> SetSlogon($Slogon);
$productpage ->SetLogo($Logo,$logoUrl);
$productpage ->SetHeaderLinks($LinksHead);
$productpage ->SetTitle($CompanyName);
$productpage ->SetKeywords("test");
$productpage -> Display();

?>