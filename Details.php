<?php 
$product_name ="";
// Check to see the URL variable is set and that it exists in the database
if (isset($_GET['id'])) {
	// Connect to the MySQL database  
    include "../scripts/connect_to_mysql.php"; 
	$id = preg_replace('#[^0-9]#i', '', $_GET['id']); 
	// Use this var to check to see if this ID exists, if yes then get the product 
	// details, if no then exit this script and give message why
	$sql = mysqli_query($dbhandle,"SELECT *, case SubidCategory when 1 then 'Medical' when 2 then 'Accesosaries' end as Category  FROM products  a inner join category b on a.Sub_idCategory = b.idCategory WHERE idProducts='$id' LIMIT 1");
	$productCount = mysqli_num_rows($sql); // count the output amount
    if ($productCount > 0) {
		// get all the product details
		while($row = mysqli_fetch_array($sql)){
			 $product_name = $row["Name"];
			 $price = $row["Price"];
			 $details = $row["Details"];
			 $category = $row["Category"];
			 $subcategory = $row["NameC"];
			 $date_added = strftime("%b %d, %Y", strtotime($row["DateAdded"]));
         }
		
	} else {
		echo "That item does not exist.";
	    exit();
	}
		
} else {
	echo "Data to render this page is missing.";
	exit();
}
mysqli_close();
?>