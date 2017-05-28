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
// Parse the form data and add inventory item to the system
if (isset($_POST['Category_name'])) {
	
    $Category_name = mysqli_real_escape_string($dbhandle,$_POST['Category_name']);
	$details = mysqli_real_escape_string($dbhandle,$_POST['details']);
$Company = mysqli_real_escape_string($dbhandle,$_SESSION['Companyid']);
	
	
	$sql = mysqli_query($dbhandle,"SELECT CategoryId FROM category WHERE CategoryName='$Category_name' and CompanyId = $Company  LIMIT 1");
	$count = mysqli_num_rows($sql); // count the output amount
    if ($count > 0) {
		echo 'Sorry you tried to place a duplicate "Product Name" into the system, <a href="inventory_list.php">click here</a>';
		exit();
	}
	// Add this product into the database now
	$sql = mysqli_query($dbhandle,"INSERT INTO category (CategoryName,CategoryDescription,CompanyId)
        VALUES('$Category_name','$details',$Company);") or die (mysql_error());

	header("location: Category.php?Compid=$Company"); 
    exit();
}
?>
 <?php 
// Delete Item Question to Admin, and Delete Product if they choose
if (isset($_GET['deleteid'])) {
	echo 'Do you really want to delete Category with ID of ' . $_GET['deleteid'] . '? <a href="Category.php?yesdelete=' . $_GET['deleteid'] . '&Compid='.$Company.'">Yes</a> | <a href="Category.php?Compid='.$Company.'">No</a>';
	exit();
}
if (isset($_GET['yesdelete'])) {
	// remove item from system and delete its picture
	// delete from database
	$id_to_delete = $_GET['yesdelete'];
	$sql = mysqli_query($dbhandle,"DELETE FROM category WHERE CategoryId='$id_to_delete' LIMIT 1") or die (mysql_error());
	
	header("location: Category.php?Compid=$Company"); 
    exit();
}


?>
<?php 
// This block grabs the whole list for viewing
$category_list = "";
$sql = mysqli_query($dbhandle,"SELECT * FROM category where CompanyID =$Company  order by CategoryId DESC");
$productCount = mysqli_num_rows($sql); // count the output amount
if ($productCount > 0) {
	while($row = mysqli_fetch_array($sql)){
             $id = $row["CategoryId"];
			 $Category_name = $row["CategoryName"];
			 $details = $row["CategoryDescription"];
			
			
			 $category_list .=  '
        <tbody>
		 <tr>
          <td > '.$id.'</td>
          <td><strong>'.$Category_name.'</strong> </td>
		   <td >'.$details.' </td>
	
		  <td ><a href="CategoryEdit.php?pid='.$id.'&Compid='.$Company.'">edit</a></td>
		  <td> <a href="Category.php?deleteid= '.$id.'&Compid='.$Company.'">delete</a> </td>

        </tr>
        </tbody>';

	
	}
} else {
	$category_list = "You have no products listed in your store yet";
}
?>
<div id="Content">
	<div id="Overzicht">
		<fieldset>
		<legend></legend>
		<a name="inventoryForm" id="inventoryForm"></a>
		<center>	<h3>
			&darr; Category List&darr;
			</h3></center>
					<hr/>
	<table width="100%" border="1" cellspacing="0" >
        <thead>
          <tr>
				  <th>
				  Category ID
				  </th>
				  <th>
				  Category Name
				  </th>
				  <th>
				  Category Description
				  </th>
				 
				  <th>
				  EDIT
				  </th>
				  <th>
				  DELETE
				  </th>
				
		  </tr>
        </thead>
		<?php echo $category_list; ?><br/>	
   </table>
		</fieldset>
		</div>
	<div id="Invoer">
	<fieldset>
		<legend></legend>

		
		<a name="inventoryForm" id="inventoryForm"></a>
		<center>	<h3>
			&darr; New Category form &darr;
			</h3></center>
			 
				<hr/>
				 <form action="Category.php?Compid=<?php echo $Company?>" enctype="multipart/form-data" name="myForm" id="myform" method="post">
			
		   <div> *<label>  Category Name</label>  <input name="Category_name" type="text" id="product_namep" size="20" class="textbx"/> </div> 
			
			 
			*<label>  Category Details</label>  <div> 	   <textarea name="details" id="detailsp" cols="30" rows="5"></textarea></div> 
			
			 
				<div>     <input type="submit" name="button" id="button" value="Add This Item Now" /></div> 

			</form>
		
	
	</fieldset>
	</div>
	
</div>
</div>
<?php 
 require  "Admin_footer.php";
 ?>