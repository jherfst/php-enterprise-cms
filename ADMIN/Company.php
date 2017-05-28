<?php 
 include_once 'authorize.php';
?>

<?php 

// Script Error Reporting
error_reporting(E_ALL);
ini_set('display_errors', '1');
?>
<?php 
 include  "Admin-header.php";
 $Company = mysqli_real_escape_string($dbhandle,$_SESSION['Companyid']);
 ?>
 

 <?php 
////////////////////////Bouw Company
if (isset($_POST['Companyname'])) {
	
    $Companyname = mysqli_real_escape_string($dbhandle,$_POST['Companyname']);
	$CompanyMission = mysqli_real_escape_string($dbhandle,$_POST['CompanyMission']);
		$CompanyVission = mysqli_real_escape_string($dbhandle,$_POST['CompanyVission']);
		$CompanySlogan = mysqli_real_escape_string($dbhandle,$_POST['CompanySlogan']);
	
	
	
	$sql = mysqli_query($dbhandle,"SELECT CompanyId FROM company WHERE CompanyName='$Companyname'LIMIT 1");
	$productMatch = mysqli_num_rows($sql);
    if ($productMatch > 0) {
		echo 'Sorry you tried to place a duplicate "Company Name" into the system, <a href="Company.php?Compid='.$Company.'">click here</a>';
		exit();
	}
	//////////insert company
	$sql = mysqli_query($dbhandle,"INSERT INTO company (CompanyName,Company_Mission, Company_Vission, Company_Slogon)
        VALUES('$Companyname','$CompanyMission','$CompanyVission','$CompanySlogan');") or die (mysqli_error());
     $pid = mysqli_insert_id($dbhandle);
	//////////Update company url met nieuw company Id
	$sql2 = mysqli_query($dbhandle,"Update company set Company_LogoUrl = 'Home.php?CId=$pid&pid=1' where CompanyId = $pid") or die (mysqli_error($dbhandle));
	$newname = "$pid.png";
	move_uploaded_file( $_FILES['fileField']['tmp_name'], "../Images/Companies/$newname");
		//////////geef company een nieuwe theme
		$sql3 = mysqli_query($dbhandle,"INSERT INTO company_styles (CompanyID,Company_Style_Id)
        VALUES($pid,1);") or die (mysqli_error());
        //////////geef company een Home link
	    $sql4 = mysqli_query($dbhandle,"INSERT INTO links (LinkName,LinkUrl,LinkDescription,LinkVisible,CompanyId)
        VALUES('HOME','Home.php?CId=$pid&pid=1','Home Page',1,$pid);") or die (mysqli_error());
        $pid4 = mysqli_insert_id($dbhandle);
		$sql7 = mysqli_query($dbhandle,"Update links set LinkUrl = 'Home.php?CId=$pid&pid=$pid4' where CompanyId = $pid and LinkID = $pid4") or die (mysqli_error($dbhandle));
	 //////////geef company een About us link
         $sql5 = mysqli_query($dbhandle,"INSERT INTO links (LinkName,LinkUrl,LinkDescription,LinkVisible,CompanyId)
          VALUES('ABOUT US','Page.php?CId=$pid&pid=1','Ons Missie Is: $CompanyMission <br/> En Vissie:$CompanyVission',1,$pid);") or die (mysqli_error());
           $pid5 = mysqli_insert_id($dbhandle);
		$sql8 = mysqli_query($dbhandle,"Update links set LinkUrl = 'Page.php?CId=$pid&pid=$pid5' where CompanyId = $pid and LinkID = $pid5") or die (mysqli_error($dbhandle));
	
        	 //////////geef company een Contact us link  
         $sql6 =   mysqli_query($dbhandle,"INSERT INTO links (LinkName,LinkUrl,LinkDescription,LinkVisible,CompanyId)
            VALUES('CONTACT US','Home.php?CId=$pid&pid=1','CONTACT Page',1,$pid);") or die (mysqli_error($dbhandle));
             $pid6 = mysqli_insert_id($dbhandle);
		$sql9 = mysqli_query($dbhandle,"Update links set LinkUrl = 'Page.php?CId=$pid&pid=$pid6' where CompanyId = $pid and LinkID = $pid6") or die (mysqli_error($dbhandle));
	 
	

	header("location: Company.php?Compid=$Company"); 
    exit();
}
?>
 <?php 

if (isset($_GET['deleteid'])) {
	echo 'Do you really want to delete this Company with ID of ' . $_GET['deleteid'] . '? This wil delete al products and category and events!!! <a href="Company.php?yesdelete=' . $_GET['deleteid'] . '&Compid='.$Company.'">Yes</a> | <a href="Company.php?Compid='.$Company.'">No</a>';
	exit();
}
if (isset($_GET['yesdelete'])) {

	// delete van database
	$id_to_delete = $_GET['yesdelete'];
	$sql = mysqli_query($dbhandle,"DELETE FROM company WHERE CompanyID='$id_to_delete' LIMIT 1") or die (mysqli_error($dbhandle));
	$sqla = mysqli_query($dbhandle,"DELETE FROM company_styles WHERE CompanyID='$id_to_delete' LIMIT 1") or die (mysqli_error($dbhandle));
	$sqlb = mysqli_query($dbhandle,"DELETE FROM links WHERE CompanyID='$id_to_delete' LIMIT 1") or die (mysqli_error($dbhandle));
		$sqlc = mysqli_query($dbhandle,"DELETE FROM events WHERE CompanyID='$id_to_delete' LIMIT 1") or die (mysqli_error($dbhandle));
		$sqld = mysqli_query($dbhandle,"DELETE FROM category WHERE CompanyID='$id_to_delete' LIMIT 1") or die (mysqli_error($dbhandle));
		$sqle = mysqli_query($dbhandle,"DELETE FROM products WHERE CompanyID='$id_to_delete' LIMIT 1") or die (mysqli_error($dbhandle));

	// delete The Pic -------------------------------------------
    $pictodelete = ("../Images/Companies/$id_to_delete.jpg");
    if (file_exists($pictodelete)) {
       		    unlink($pictodelete);
    }
	header("location: Index.php?Compid=$Company"); 
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
				 <form action="Company.php?Compid=<?php echo $Company?>" enctype="multipart/form-data" name="myForm" id="myform" method="post">
			
		   <div> *<label>Company Name</label>  <input name="Companyname" type="text" id="product_namep" size="20" class="textbx"/> </div> 
			  
			    *<label>Company Mission </label>  <div> <textarea name="CompanyMission" id="detailsp" cols="30" rows="5"></textarea></div>
			     *<label>Company Vission </label>  <div> <textarea name="CompanyVission" id="detailsp" cols="30" rows="5"></textarea> </div>
			      *<label>Company Slogan </label>  <div> <textarea name="CompanySlogan" id="detailsp" cols="30" rows="5"></textarea> </div>

			<div>  *<label>Company Logo</label> <input type="file" name="fileField" id="fileField" /></div> 
			 
				<div>     <input type="submit" name="button" id="button" value="Build Company Now" /></div> 

			</form>
		
	
	</fieldset>
	</div>
	
</div>
</div>
<?php 
 require  "Admin_footer.php";
 ?>