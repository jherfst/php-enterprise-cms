<?php 
 include_once 'authorize.php';
?><?php 
// Script Error Reporting
error_reporting(E_ALL);
ini_set('display_errors', '1');
?>
<?php 
 require "Admin-header.php";
  $Company = mysql_real_escape_string($_SESSION['Companyid']);
  include "../Mysql/connect_to_mysql.php";
 ?>

<?php 

if (isset($_POST['EventName'])) {
	
	 $EventName = mysqli_real_escape_string($dbhandle,$_POST['EventName']);
	$EventUrl = mysqli_real_escape_string($dbhandle,$_POST['EventUrl']);
		$EventTitle = mysqli_real_escape_string($dbhandle,$_POST['EventTitle']);
		$Company = mysqli_real_escape_string($dbhandle,$_SESSION['Companyid']);
      $pid= mysqli_real_escape_string($dbhandle,$_POST['targetId']);
	$query = "UPDATE events SET EventName ='$EventName', EventUrl='$EventUrl',EventTitle='$EventTitle' WHERE EventID ='$pid'"; 
	
	  $sql = mysqli_query($dbhandle,$query);
	if ($_FILES['fileField']['tmp_name'] != "") {
	    // Place image in the folder 
	    $newname = "$pid.jpg";
	    move_uploaded_file($_FILES['fileField']['tmp_name'], "../Images/Events/$newname");
	}

header("location: Events.php?Compid=$Company"); 
    exit();
}
?>
<?php 

$Event_list = "";
$sql = mysqli_query($dbhandle,"SELECT * FROM events  where CompanyID =$Company  order by EventID DESC");
$productCount = mysqli_num_rows($sql); // count the output amount
if ($productCount > 0) {
	while($row = mysqli_fetch_array($sql)){
             $id = $row["EventID"];
			 $EventName = $row["EventName"];
			 $EventTitle = $row["EventTitle"];
			
			
			 $Event_list .=  '
        <tbody>
		 <tr>
          <td > '.$id.'</td>
          <td><strong>'.$EventName.'</strong> </td>
		   <td >'.$EventTitle.' </td>
	
		  <td ><a href="EventsEdit.php?pid='.$id.'&Compid='.$Company.'">edit</a></td>
		  <td> <a href="Events.php?deleteid= '.$id.'&Compid='.$Company.'">delete</a> </td>

        </tr>
        </tbody>';

	
	}
} else {
	$Event_list = "You have no Events listed yet";
}
?>

<?php 
	$EventName ="";
	    $EventUrl ="";
		 $EventTitle ="";
		 $targetID ="";

if (isset($_GET['pid'])) {
	$targetID = $_GET['pid'];

	
    $sql = mysqli_query($dbhandle,"SELECT * FROM events WHERE EventID='$targetID' LIMIT 1");
    $Count = mysqli_num_rows($sql); // count the output amount
    if ($Count > 0) {
	    while($row = mysqli_fetch_array($sql)){
	     
		$EventName =$row['EventName'];
	    $EventUrl =$row['EventUrl'];
		 $EventTitle =$row['EventTitle'];
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
			&darr; Event List&darr;
			</h3></center>
					<hr/>
		<table width="100%" border="1" cellspacing="0" >
        <thead>
          <tr>
				  <th>
				  Event ID
				  </th>
				  <th>
				  Event Name
				  </th>
				  <th>
				  Event Description
				  </th>
				 
				  <th>
				  EDIT
				  </th>
				  <th>
				  DELETE
				  </th>
				
		  </tr>
        </thead>
		<?php echo $Event_list; ?><br/>	
   </table>
		</fieldset>
		</div>
	<div id="Invoer">
	<fieldset>
		<legend></legend>

		
		<a name="inventoryForm" id="inventoryForm"></a>
		<center>	<h3>
			&darr; Update Event form &darr;
			</h3></center>
			 
				<hr/>
				 <form action="EventsEdit.php?Compid=<?php echo $Company?>" enctype="multipart/form-data" name="myForm" id="myform" method="post">
			
		   <div> *<label>  Event Name</label>  <input name="EventName" type="text" id="product_namep" size="20" class="textbx" value="<?php echo $EventName?>"/> </div> 
			
			 
			<div><label>   Event Url</label>  	  <input name="EventUrl" type="text" id="product_namep" size="20" class="textbx" value="<?php echo $EventUrl?>"/></div> 
			
			<div> <label>  Event Title</label>  	   <input name="EventTitle" type="text" id="product_namep" size="20" class="textbx" value="<?php echo $EventTitle?>"/></div> 
						<div>  *<label> Event Image</label> <input type="file" name="fileField" id="fileField" /></div> 
						<input type="hidden" name="targetId" id="" value="<?php echo $targetID;?>" />
				<div>     <input type="submit" name="button" id="button" value="Update This Item Now" /></div> 

			</form>
		
	
	</fieldset>
	</div>
	
</div>
</div>
<?php 
 require  "Admin_footer.php";
 ?>