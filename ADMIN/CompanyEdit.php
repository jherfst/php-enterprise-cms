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

if (isset($_POST['Companyname'])) {
	
	 $Companyname = mysqli_real_escape_string($dbhandle,$_POST['Companyname']);
	$CompanyMission = mysqli_real_escape_string($dbhandle,$_POST['CompanyMission']);
		$CompanyVission = mysqli_real_escape_string($dbhandle,$_POST['CompanyVission']);
		$CompanySlogan = mysqli_real_escape_string($dbhandle,$_POST['CompanySlogan']);
		$pid = mysqli_real_escape_string($dbhandle,$_POST['targetId']);
	$query = "UPDATE company SET CompanyName ='$Companyname', Company_Mission='$CompanyMission',Company_Vission='$CompanyVission', Company_Slogon='$CompanySlogan'WHERE CompanyId =$pid"; 
	
	  $sql = mysqli_query($dbhandle,$query);//$sql = mysql_query("UPDATE products SET Name='$product_name', Price='$price', Details='$details', category='$category', subcategory='$subcategory' WHERE id='$pid'");
	
	if ($_FILES['fileField']['tmp_name'] != "") {
	  
	    $newname = "$pid.jpg";
	    move_uploaded_file($_FILES['fileField']['tmp_name'], "../Images/Companies/$newname");
	}

header("location: CompanyEdit.php?Compid=$Company"); 
    exit();
}
?>
<?php 

$company_list = "";
$sql = mysqli_query($dbhandle,"SELECT * FROM company ORDER BY CompanyId DESC");
$productCount = mysqli_num_rows($sql); // count the output amount
if ($productCount > 0) {
	while($row = mysqli_fetch_array($sql)){
             $id = $row["CompanyId"];
			 $CompanyName = $row["CompanyName"];
			 $Company_Slogon = $row["Company_Slogon"];
			
			
			 $company_list .=  '
        <tbody>
		 <tr>
          <td > '.$id.'</td>
          <td><strong>'.$CompanyName.'</strong> </td>
		   <td >'.$Company_Slogon.' </td>
			  
		  <td ><a href="CompanyEdit.php?pid='.$id.'&Compid='.$Company.'">edit</a></td>
	
        </tr>
        </tbody>';

	
	}
} else {
	$company_list = "You have no company listed in your system yet";
}
?>

<?php 
	$CompanyName ="";
	    $CompanyMission ="";
		 $CompanyVission ="";
		
		$CompanySlogon = "";
		$targetID = "";

if (isset($_GET['pid'])) {
	$targetID = $_GET['pid'];

	
    $sql = mysqli_query($dbhandle,"SELECT * FROM company WHERE CompanyId='$targetID' LIMIT 1");
    $Count = mysqli_num_rows($sql); // count the output amount
    if ($Count > 0) {
	    while($row = mysqli_fetch_array($sql)){
	     
		$CompanyName =$row['CompanyName'];
	    $CompanyMission =$row['Company_Mission'];
		 $CompanyVission =$row['Company_Vission'];
		
		$CompanySlogon = $row['Company_Slogon'];
	
		
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
			&darr; Company List&darr;
			</h3></center>
					<hr/>
		<table width="100%" border="1" cellspacing="0" >
        <thead>
          <tr>
				  <th>
				  Company ID
				  </th>
				  <th>
				  Company Name
				  </th>
				  <th>
				 Company Slogan
				  </th>
				 
				  <th>
				  EDIT
				  </th>
				
				
		  </tr>
        </thead>
		<?php echo $company_list; ?><br/>	
   </table>
   <center><img src="../Images/Companies/<?php echo $targetID?>.png" alt=""  height="300" width="300"/></center>
		</fieldset>
		</div>
	<div id="Invoer">
	<fieldset>
		<legend></legend>

		
		<a name="inventoryForm" id="inventoryForm"></a>
		<center>	<h3>
			&darr; New Company form &darr;
			</h3></center>
			 
				<hr/>
				 <form action="CompanyEdit.php?Compid=<?php echo $Company?>" enctype="multipart/form-data" name="myForm" id="myform" method="post">
			
		   <div> *<label>Company Name</label>  <input name="Companyname" type="text" id="product_namep" size="20" class="textbx" value="<?php echo $CompanyName?>"</div> 
			  
			    *<label>Company Mission </label>  <div> <textarea name="CompanyMission" id="detailsp" cols="30" rows="5"><?php echo $CompanyMission?></textarea></div>
			     *<label>Company Vission </label>  <div> <textarea name="CompanyVission" id="detailsp" cols="30" rows="5"><?php echo $CompanyVission?></textarea> </div>
			      *<label>Company Slogan </label>  <div> <textarea name="CompanySlogan" id="detailsp" cols="30" rows="5"><?php echo $CompanySlogon?></textarea> </div>
<input type="hidden" name="targetId" id="" value="<?php echo $targetID?>" />
			<div>  *<label>Company Logo</label> <input type="file" name="fileField" id="fileField" /></div> 
			 
				<div>     <input type="submit" name="button" id="button" value="Update Company Now" /></div> 

			</form>
		
	
	</fieldset>
	</div>
	
</div>
</div>
<?php 
 require  "Admin_footer.php";
 ?>