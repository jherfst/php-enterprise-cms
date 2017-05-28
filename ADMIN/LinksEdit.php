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

if (isset($_POST['LinkName'])) {
	
	 $LinkName = mysqli_real_escape_string($dbhandle,$_POST['LinkName']);

	$details = mysqli_real_escape_string($dbhandle,$_POST['details']);
$Company = mysqli_real_escape_string($dbhandle,$_SESSION['Companyid']);
$pid= mysqli_real_escape_string($dbhandle,$_POST['targetId']);
	$query = "UPDATE links SET LinkName ='$LinkName', LinkDescription='$details' WHERE LinkID ='$pid'"; 
	
	  $sql = mysqli_query($dbhandle,$query);

header("location: LinksEdit.php?Compid=$Company"); 
    exit();
}
?>
<?php 

$Link_list = "";
$sql = mysqli_query($dbhandle,"SELECT * FROM links  where CompanyID =$Company  order by LinkID DESC");
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
	$Link_list = "You have no links listed yet";
}
?>
<?php 
	$LinkNamenw ="";
	    $details ="";
		 $id ="";
	

if (isset($_GET['pid'])) {
	$targetID = $_GET['pid'];

	
    $sql = mysqli_query($dbhandle,"SELECT * FROM links WHERE LinkID='$targetID' LIMIT 1");
    $productCount = mysqli_num_rows($sql); // count the output amount
    if ($productCount > 0) {
	    while($row = mysqli_fetch_array($sql)){
	     
		$id = $row["LinkID"];
			 $LinkNamenw = $row["LinkName"];
			 $details = $row["LinkDescription"];
		
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
			&darr; Update Link form &darr;
			</h3></center>
			 
				<hr/>
				 <form action="LinksEdit.php?Compid=<?php echo $Company?>" enctype="multipart/form-data" name="myForm" id="myform" method="post">
			
		   <div> *<label>Link Name</label>  <input name="LinkName" type="text" id="product_namep" size="20" class="textbx" value="<?php echo $LinkNamenw?>"/> </div> 
			  
			    *<label>Link Description </label>  <div> <textarea name="details" id="detailsp" cols="30" rows="5"><?php echo $details?></textarea></div>
			<input type="hidden" name="targetId" id="" value="<?php echo $id?>" />
				<div>     <input type="submit" name="button" id="button" value="Update This Link Now" /></div> 

			</form>
		
	
	</fieldset>
	</div>
	
</div>
</div>
<?php 
 require  "Admin_footer.php";
 ?>