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

if (isset($_POST['Category_name'])) {
	
	 $Category_name = mysqli_real_escape_string($dbhandle,$_POST['Category_name']);

	$details = mysqli_real_escape_string($dbhandle,$_POST['details']);
$Company = mysqli_real_escape_string($dbhandle,$_SESSION['Companyid']);
$pid= mysqli_real_escape_string($dbhandle,$_POST['targetid']);
	$query = "UPDATE category SET CategoryName ='$Category_name', CategoryDescription='$details' WHERE CategoryId ='$pid'"; 
	
	  $sql = mysqli_query($dbhandle,$query);//$sql = mysql_query("UPDATE products SET Name='$product_name', Price='$price', Details='$details', category='$category', subcategory='$subcategory' WHERE id='$pid'");
	

header("location: CategoryEdit.php?Compid=$Company"); 
    exit();
}
?>
<?php 

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
<?php 
	$Category_name ="";
	    $details ="";
		 $id ="";
	

if (isset($_GET['pid'])) {
	$targetID = $_GET['pid'];

	
    $sql = mysqli_query($dbhandle,"SELECT * FROM category WHERE CategoryId='$targetID' LIMIT 1");
    $productCount = mysqli_num_rows($sql);
    if ($productCount > 0) {
	    while($row = mysqli_fetch_array($sql)){
	     
		$id = $row["CategoryId"];
			 $Category_name = $row["CategoryName"];
			 $details = $row["CategoryDescription"];
		
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
			&darr; Update Category form &darr;
			</h3></center>
			 
				<hr/>
				 <form action="CategoryEdit.php?Compid=<?php echo $Company?>" enctype="multipart/form-data" name="myForm" id="myform" method="post">
			
		   <div> *<label>  Category Name</label>  <input name="Category_name" type="text" id="product_namep" size="20" class="textbx" value="<?php echo $Category_name;?>"/> </div> 
			
			 
			*<label>  Category Details</label>  <div> 	   <textarea name="details" id="detailsp" cols="30" rows="5"><?php echo $details;?></textarea></div> 
			
			 <input type="hidden" name="targetid" id="button" value="<?php echo $id;?>" />
			 <input type="hidden" name="Post" id="button" value="pass" />
				<div>     <input type="submit" name="button" id="button" value="Update This Item Now" /></div> 

			</form>
		
	
	</fieldset>
	</div>
	
</div>
</div>
<?php 
 require  "Admin_footer.php";
 ?>