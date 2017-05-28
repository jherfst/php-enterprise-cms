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

if (isset($_POST['Link_Name'])) {
	
    $Link_Name = mysqli_real_escape_string($dbhandle,$_POST['Link_Name']);
	$details = mysqli_real_escape_string($dbhandle,$_POST['details']);
$Company = mysqli_real_escape_string($dbhandle,$_SESSION['Companyid']);
	
	
	$sql = mysqli_query($dbhandle,"SELECT LinkName FROM links WHERE LinkName='$Link_Name' and CompanyId = $Company LIMIT 1");
	$count = mysqli_num_rows($sql); // count the output amount
    if ($count > 0) {
		echo 'Sorry you tried to place a duplicate "Link Name" into the system, <a href="Links.php?Compid='.$Company.'?>">click here</a>';
		exit();
	}
	
	$sql = mysqli_query($dbhandle,"INSERT INTO links (LinkName,LinkDescription,LinkVisible,CompanyId)
        VALUES('$Link_Name','$details',1,$Company);") or die (mysqli_error());
     $inserted = mysqli_insert_id();
	 
	$Updatsql = mysqli_query($dbhandle,"Update links set LinkUrl = 'Page.php?id=$inserted' where LinkID =$inserted") or die (mysqli_error());
	header("location: Links.php?Compid=$Company"); 
    exit();
}
?>
 <?php 

if (isset($_GET['deleteid'])) {
	echo 'Do you really want to delete Link with ID of ' . $_GET['deleteid'] . '? <a href="Links.php?yesdelete=' . $_GET['deleteid'] . '&Compid='.$Company.'">Yes</a> | <a href="Links.php?Compid='.$Company.'">No</a>';
	exit();
}
if (isset($_GET['yesdelete'])) {
	
	$id_to_delete = $_GET['yesdelete'];
	$sql = mysqli_query($dbhandle,"DELETE FROM links WHERE LinkID='$id_to_delete' LIMIT 1") or die (mysqli_error());
	
	header("location: Links.php?Compid=$Company"); 
    exit();
}


?>
<?php 

$Link_list = "";
$sql = mysqli_query($dbhandle,"SELECT * FROM links where CompanyId = $Company order by LinkID DESC");
$productCount = mysqli_num_rows($sql); // count the output amount
if ($productCount > 0) {
	while($row = mysqli_fetch_array($sql)){
             $id = $row["LinkID"];
			 $LinkName = $row["LinkName"];
			
			
			
			 $Link_list .=  '
        <tbody>
		 <tr>
          <td > '.$id.'</td>
          <td><strong>'.$LinkName.'</strong> </td>

	
		  <td ><a href="LinksEdit.php?pid='.$id.'&Compid='.$Company.'">edit</a></td>
		  <td> <a href="Links.php?deleteid= '.$id.'&Compid='.$Company.'">delete</a> </td>

        </tr>
        </tbody>';

	
	}
} else {
	$Link_list = "You have no products listed in your store yet";
}
?>
<div id="Content">
	<div id="Overzicht">
		<fieldset>
		<legend></legend>
		<a name="inventoryForm" id="inventoryForm"></a>
		<center>	<h3>
			&darr; Links List&darr;
			</h3></center>
					<hr/>
<table width="100%" border="1" cellspacing="0" >
        <thead>
          <tr>
				  <th>
				  Link ID
				  </th>
				  <th>
				  Link Name
				  </th>
				  
				 
				  <th>
				  EDIT
				  </th>
				  <th>
				  DELETE
				  </th>
				
		  </tr>
        </thead>
		<?php echo $Link_list; ?><br/>	
   </table>
		</fieldset>
		</div>
	<div id="Invoer">
	<fieldset>
		<legend></legend>

		
		<a name="inventoryForm" id="inventoryForm"></a>
		<center>	<h3>
			&darr; New Link form &darr;
			</h3></center>
			 
				<hr/>
				 <form action="Links.php?Compid=<?php echo $Company?>" enctype="multipart/form-data" name="myForm" id="myform" method="post">
			
		   <div> *<label>Link Name</label>  <input name="Link_Name" type="text" id="product_namep" size="20" class="textbx"/> </div> 
			  
			    *<label>Link Description </label>  <div> <textarea name="details" id="detailsp" cols="30" rows="5"></textarea></div>
			
				<div>     <input type="submit" name="button" id="button" value="Add This Link Now" /></div> 

			</form>
		
	
	</fieldset>
	</div>
	
</div>
</div>
<?php 
 require  "Admin_footer.php";
 ?>