
<?php 
 include_once 'authorize.php';
 include "../Mysql/connect_to_mysql.php"; //Connect to CMSDB
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

if (isset($_POST['product_name'])) {
	
    $product_name = mysql_real_escape_string($_POST['product_name']);
	$price = mysql_real_escape_string($_POST['price']);
		$korting = mysql_real_escape_string($_POST['korting']);
		$category = mysql_real_escape_string($_POST['category']);
	$details = mysql_real_escape_string($_POST['details']);
$Company = mysql_real_escape_string($_SESSION['Companyid']);
	
	
	$sql = mysql_query("SELECT Prod_Id FROM products WHERE Product_Name='$product_name'  and CompanyId = $Company LIMIT 1");
	$productMatch = mysql_num_rows($sql); // count the output amount
    if ($productMatch > 0) {
		echo 'Sorry you tried to place a duplicate "Product Name" into the system, <a href="Product.php?Compid='.$Company.'">click here</a>';
		exit();
	}

	$sql = mysql_query("INSERT INTO products (Product_Name,Product_Discount, Product_Price, Product_Description,CategoryId,CompanyID) 
        VALUES('$product_name',$korting,$price,'$details',$category,$Company);") or die (mysql_error());
     $pid = mysql_insert_id();

	$newname = "$pid.jpg";
	move_uploaded_file( $_FILES['fileField']['tmp_name'], "../Images/Products/$newname");
	header("location: Product.php?Compid=$Company"); 
    exit();
}
?>
 <?php 

if (isset($_GET['deleteid'])) {
	echo 'Do you really want to delete product with ID of ' . $_GET['deleteid'] . '? <a href="Product.php?yesdelete=' . $_GET['deleteid'] . '&Compid='.$Company.'">Yes</a> | <a href="Product.php?Compid='.$Company.'">No</a>';
	exit();
}
if (isset($_GET['yesdelete'])) {

	$id_to_delete = $_GET['yesdelete'];
	$sql = mysql_query("DELETE FROM products WHERE Prod_Id='$id_to_delete' LIMIT 1") or die (mysql_error());

    $pictodelete = ("../Images/Products/$id_to_delete.jpg");
    if (file_exists($pictodelete)) {
       		    unlink($pictodelete);
    }
	header("location: Product.php?Compid=$Company"); 
    exit();
}


?>
<?php 

$product_list = "";
$sql = mysqli_query($dbhandle,"SELECT * FROM products a inner join category b on a.CategoryId = b.CategoryId where a.CompanyID = $Company ORDER BY a.Prod_Id DESC");
try{
$productCount = mysqli_num_rows($sql);
if ($productCount > 0) {
	while($row = mysqli_fetch_array($sql)){
             $id = $row["Prod_Id"];
			 $product_name = $row["Product_Name"];
			 $price = $row["Product_Price"];
			  $cat = $row["CategoryName"];
			
			 $product_list .=  '
        <tbody>
		 <tr>
          <td > '.$id.'</td>
          <td><strong>'.$product_name.'</strong> </td>
		   <td >$'.$price.' </td>
			    <td >'.$cat.' </td>
		  <td ><a href="ProductEdit.php?pid='.$id.'&Compid='.$Company.'">edit</a></td>
		  <td> <a href="Product.php?deleteid= '.$id.'&Compid='.$Company.'">delete</a> </td>

        </tr>
        </tbody>';

	
	}
} else {
	$product_list = "You have no products listed in your store yet";
}
}
catch(exception $e)
{
	$product_list = "You have no products listed in your store yet";
}
?>
<?php 
$Category_list = "";
include "../Mysql/connect_to_mysql.php"; //Connect to CMSDB
$sql = mysqli_query($dbhandle,"SELECT * FROM category where CompanyId = $Company");
$Count = mysqli_num_rows($sql); // count the output amount
if ($Count > 0) {
	while($row = mysqli_fetch_array($sql)){
         
			 $idCategory = $row["CategoryId"];
			 $CategoryName = $row["CategoryName"];
			
			 $Category_list .=  "<option value='$idCategory'>$CategoryName</option>";	
			 
	}

} else {
	$Category_list = "categories empty";
}
	
?>


<div id="Content">
	<div id="Overzicht">
		<fieldset>
		<legend></legend>
		<a name="inventoryForm" id="inventoryForm"></a>
		<center>	<h3>
			&darr; Products List&darr;
			</h3></center>
					<hr/>
		<table width="100%" border="1" cellspacing="0" >
        <thead>
          <tr>
				  <th>
				  Product ID
				  </th>
				  <th>
				  Product Name
				  </th>
				  <th>
				  Price
				  </th>
				  <th>
				Category
				  </th>
				  <th>
				  EDIT
				  </th>
				  <th>
				  DELETE
				  </th>
				
		  </tr>
        </thead>
		<?php echo $product_list; ?><br/>	
   </table>

		</fieldset>
		</div>
	<div id="Invoer">
	<fieldset>
		<legend></legend>

		
		<a name="inventoryForm" id="inventoryForm"></a>
		<center>	<h3>
			&darr; New Products form &darr;
			</h3></center>
			 
				<hr/>
				 <form action="Product.php?Compid=<?php echo $Company?>" enctype="multipart/form-data" name="myForm" id="myform" method="post">
			
		   <div> *<label>  Product Name</label>  <input name="product_name" type="text" id="product_namep" size="20" class="textbx"/> </div> 
			  
			  <div>   *<label>  Product Price </label> $<input name="price" type="text" id="pricep" size="20" class="textbx"/></div> 
			    <div>   *<label>  Product korting </label> $<input name="korting" type="text" id="pricep" size="20" class="textbx"/></div> 
			   
			 <div>    *<label>Category</label>  
				  <select class="textbx" name="category" id="categoryp" >
				<?php echo $Category_list; ?>
				  </select></div> 
			 
			*<label>  Product Details</label>  <div> 	   <textarea name="details" id="detailsp" cols="30" rows="5"></textarea></div> 
			<div>  *<label> Product Image</label> <input type="file" name="fileField" id="fileField" /></div> 
			 
				<div>     <input type="submit" name="button" id="button" value="Add This Item Now" /></div> 

			</form>
		
	
	</fieldset>
	</div>
	
</div>
</div>
<?php 
 require  "Admin_footer.php";
 ?>