
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
 require "Admin-header.php";
  $Company = mysqli_real_escape_string($dbhandle,$_SESSION['Companyid']);
 ?>

<?php 

if (isset($_POST['product_name'])) {
	
	 $product_name = mysqli_real_escape_string($dbhandle,$_POST['product_name']);
	$price = mysqli_real_escape_string($dbhandle,$_POST['price']);
		$korting = mysqli_real_escape_string($dbhandle,$_POST['korting']);
		$category = mysqli_real_escape_string($dbhandle,$_POST['category']);
	$details = mysqli_real_escape_string($dbhandle,$_POST['details']);
$Company = mysqli_real_escape_string($dbhandle,$_SESSION['Companyid']);
$pid= mysqli_real_escape_string($dbhandle,$_POST['targetID']);
	$query = "UPDATE products SET Product_Discount =$korting, Product_Name='$product_name',CategoryId=$category, Product_Description='$details',Product_Price=$price WHERE Prod_Id ='$pid'"; 
	
	  $sql = mysqli_query($dbhandle,$query);
	if ($_FILES['fileField']['tmp_name'] != "") {
	  
	    $newname = "$pid.jpg";
	    move_uploaded_file($_FILES['fileField']['tmp_name'], "../Images/Products/$newname");
	}

header("location: Product.php?Compid=$Company"); 
    exit();
}
?>
<?php 

$product_list = "";
$Company = mysqli_real_escape_string($dbhandle,$_SESSION['Companyid']);
$sql = mysqli_query($dbhandle,"SELECT * FROM products a inner join category b on a.CategoryId = b.CategoryId where a.CompanyID = $Company  ORDER BY a.Prod_Id DESC");
$productCount = mysqli_num_rows($sql); // count the output amount
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
?>
<?php 
	$product_name ="";
	    $price ="";
		 $korting ="";
		
		$details = "";
		$CategoryId = "";

if (isset($_GET['pid'])) {
	$targetID = $_GET['pid'];

	
    $sql = mysqli_query($dbhandle,"SELECT * FROM products WHERE Prod_Id='$targetID' LIMIT 1");
    $productCount = mysqli_num_rows($sql); // count the output amount
    if ($productCount > 0) {
	    while($row = mysqli_fetch_array($sql)){
	     
		$product_name =$row['Product_Name'];
	    $price =$row['Product_Price'];
		 $korting =$row['Product_Discount'];
		
		$details = $row['Product_Description'];
		$CategoryId = $row['CategoryId'];
		
        }
    } else {
	    echo "Sorry dont exist.";
		exit();
    }
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
			if($CategoryId == $idCategory)
			{
			 $Category_list .=  "<option value='$idCategory' selected ='true'>$CategoryName</option>";	
			}
			else
			{
				 $Category_list .=  "<option value='$idCategory' >$CategoryName</option>";
			}
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
			&darr; Edit Products form &darr;
			</h3></center>
			 
				<hr/>
				 <form action="ProductEdit.php?Compid=<?php echo $Company?>" enctype="multipart/form-data" name="myForm" id="myform" method="post">
		
		   <div> *<label>  Product Name</label>  <input name="product_name" type="text" id="product_namep" value="<?php echo $product_name;?>" ="20" class="textbx"/> </div> 
			  
			  <div>   *<label>  Product Price </label> $<input name="price" type="text" id="pricep" size="20" value="<?php echo $price;?>" class="textbx"/></div> 
			    <div>   *<label>  Product korting </label> $<input name="korting" type="text" id="pricep"  value="<?php echo $korting;?>" size="20" class="textbx"/></div> 
			   
			 <div>    *<label>Category</label>  
				  <select class="textbx" name="category" id="categoryp"  value="<?php echo $CategoryId?>" >
			<?php echo $Category_list; ?>

				  </select ></div> 
			 
			*<label>  Product Details</label>  <div> 	   <textarea name="details" id="detailsp" cols="30" rows="5"><?php echo $details;?></textarea></div> 
			<div>  *<label> Product Image</label> <input type="file" name="fileField" id="fileField" /></div> 
			 <input type="hidden" value="<?php echo $targetID?>"" name="targetID" />
				<div>     <input type="submit" name="button" id="button" value="Update This Item Now" /></div> 

			</form>
		
	
	</fieldset>
	</div>
	
</div>
</div>
<?php 
 require  "Admin_footer.php";
 ?>