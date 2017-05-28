<?php 
 include_once 'authorize.php';
?>
<?php 
// Script Error Reporting
error_reporting(E_ALL);
ini_set('display_errors', '1');
?>

<?php 
 require "Admin-header.php";
  $Company = mysqli_real_escape_string($dbhandle,$_SESSION['Companyid']);
 ?>
 <?php 
// Parse the form data and add inventory item to the system
if (isset($_POST['themes'])) {
	
    $company_theme = mysqli_real_escape_string($dbhandle,$_POST['themes']);

$Company = mysqli_real_escape_string($dbhandle,$_SESSION['Companyid']);
	
	
	$sql = mysqli_query($dbhandle,"update company_styles set Company_Style_Id = $company_theme where CompanyID =$Company");
	
	header("location: Themes.php?Compid=$Company"); 
    exit();
}
?>

<?php 

$Style_Name = "";
$sql = mysqli_query($dbhandle,"SELECT Style_Name FROM company_styles a inner join styles b on a.Company_Style_Id = b.StyleId where a.CompanyID= $Company;");
$productCount = mysqli_num_rows($sql);
if ($productCount > 0) {
	while($row = mysqli_fetch_array($sql)){
         
			 $Style_Name = $row["Style_Name"];
	}
} else {
	$Style_Name = "Classic";
}
?>
<div id="Content">
	<div id="Overzicht">
		<fieldset>
		<legend></legend>
		<a name="inventoryForm" id="inventoryForm"></a>
		<center>	<h3>
			&darr; Current Theme &darr;
			</h3></center>
					<hr/>
 <center><img src="../Images/Site/<?php echo $Style_Name;?>.jpg" alt=""  height="300" width="300"/></center>
		</fieldset>
		</div>
	<div id="Invoer">
	<fieldset>
		<legend></legend>

		
		<a name="inventoryForm" id="inventoryForm"></a>
		<center>	<h3>
			&darr; New Theme form &darr;
			</h3></center>
			 
				<hr/>
			
				<form action="Themes.php?Compid=<?php echo $Company?>" method="POST">
				<div class="theme">Classic Theme<img src="../Images/Site/Classic.jpg" alt=""  height="40" width="50"/><input type="radio" name="themes" value="1" ></div>
				<div class="theme">Srefidentie Theme<img src="../Images/Site/Srefidentie.jpg" alt=""  height="40" width="50"/><input type="radio" name="themes" value="2"></div>
				<div class="theme">Kerst Theme<img src="../Images/Site/Kerst.jpg" alt=""  height="40" width="50"/><input type="radio" name="themes" value="3"></div>
				<div class="theme">Paqwua Theme<img src="../Images/Site/Paqwa.jpg" alt=""  height="40" width="50"/><input type="radio" name="themes" value="4"></div>
				<div class="theme">Kitie Kotie Theme<img src="../Images/Site/Ketikoti.jpg" alt=""  height="40" width="50"/><input type="radio" name="themes" value="5"></div>
				<div class="theme">Music Store Theme<img src="../Images/Site/Shop.jpg" alt=""  height="40" width="50"/><input type="radio" name="themes" value="6"></div>
				<div ><input type="submit" name="submit" value="Save" id="sub"></li>
					</form>				
			
		
	
	</fieldset>
	</div>
	
</div>
</div>
<?php 
 require  "Admin_footer.php";
 ?>