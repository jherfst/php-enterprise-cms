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

if (isset($_POST['CompanyName'])) {
	
	 $CompanyName = mysqli_real_escape_string($dbhandle,$_POST['CompanyName']);

	$CompanyMission = mysqli_real_escape_string($dbhandle,$_POST['CompanyMission']);
	$CompanyVission = mysqli_real_escape_string($dbhandle,$_POST['CompanyVission']);
		$CompanySlogon = mysqli_real_escape_string($dbhandle,$_POST['CompanySlogan']);
$Company = mysqli_real_escape_string($dbhandle,$_SESSION['Companyid']);
$url = "Home.php?CId=$Company&pid=1";
	$query = "UPDATE Company SET CompanyName ='$CompanyName',Company_Vission='$CompanyVission', Company_Mission='$CompanyMission',Company_Slogon ='$CompanySlogon', Company_LogoUrl='$url'  WHERE CompanyId ='$Company'"; 
	
	  $sql = mysqli_query($dbhandle,$query);
	  	if ($_FILES['fileField']['tmp_name'] != "") {
	
	    $newname = "$Company.png";
	    move_uploaded_file($_FILES['fileField']['tmp_name'], "../Images/Companies/$newname");
	}
	

header("location: MyCompany.php?Compid=$Company"); 
    exit();
}
?>

<?php 
	$CompanyName ="";
	    $CompanyMission ="";
		 $id ="";
	$CompanyVission="";
	$CompanySlogon ="";

if (isset($_SESSION['Companyid'])) {
$Company = mysqli_real_escape_string($dbhandle,$_SESSION['Companyid']);

	
    $sql = mysqli_query($dbhandle,"SELECT * FROM company WHERE CompanyId='$Company' LIMIT 1");
    $Count = mysqli_num_rows($sql); // count the output amount
    if ($Count > 0) {
	    while($row = mysqli_fetch_array($sql)){
	
		     $id = $row["CompanyId"];
			 $CompanyName = $row["CompanyName"];
			 $CompanyMission = $row["Company_Mission"];
			  $CompanyVission = $row["Company_Vission"];
			 $CompanySlogon = $row["Company_Slogon"];
		
        }
    } else {
	    echo "Sorry dont exist.";
		exit();
    }
}
?>


<div id="Content">
	<div id="Overzicht">
		<fieldset>
		<legend></legend>
		<a name="inventoryForm" id="inventoryForm"></a>
		<center>	<h3>
			&darr; My Company &darr;
			</h3></center>
					<hr/>
		 <center><img src="../Images/Companies/<?php echo $Company?>.png" alt=""  height="300" width="300"/></center>
		</fieldset>
		</div>
	<div id="Invoer">
	<fieldset>
		<legend></legend>

		
		<a name="inventoryForm" id="inventoryForm"></a>
		<center>	<h3>
			&darr; Update My Company form &darr;
			</h3></center>
			 
				<hr/>
				 <form action="MyCompany.php?Compid=<?php echo $Company?>" enctype="multipart/form-data" name="myForm" id="myform" method="post">
			
		   <div> *<label>  Company Name</label>  <input name="CompanyName" type="text" id="product_namep" size="20" class="textbx" value="<?php echo $CompanyName?>"/> </div> 
			  
			    *<label>  Company Mission </label>  <div> <textarea name="CompanyMission" id="detailsp" cols="30" rows="5"><?php echo $CompanyMission?></textarea></div>
			     *<label>  Company Vission </label>  <div> <textarea name="CompanyVission" id="detailsp" cols="30" rows="5"><?php echo $CompanyVission?></textarea> </div>
			      *<label>  Company Slogan </label>  <div> <textarea name="CompanySlogan" id="detailsp" cols="30" rows="5"><?php echo $CompanySlogon?></textarea> </div>

			<div>  *<label> Company Logo</label> <input type="file" name="fileField" id="fileField" /></div> 
			 
				<div>     <input type="submit" name="button" id="button" value="Update This Item Now" /></div> 

			</form>
		
	
	</fieldset>
	</div>
	
</div>
</div>
<?php 
 require  "Admin_footer.php";
 ?>