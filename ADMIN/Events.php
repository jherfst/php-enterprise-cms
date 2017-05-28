<?php 
 include_once 'authorize.php';
?><?php 
// Script Error Reporting
error_reporting(E_ALL);
ini_set('display_errors', '1');
?>

<?php 
 include  "Admin-header.php";
 $Company = mysqli_real_escape_string($dbhandle,$_SESSION['Companyid']);
 ?>
 

 <?php 

if (isset($_POST['EventName'])) {
	
    $EventName = mysqli_real_escape_string($dbhandle,$_POST['EventName']);
	$EventUrl = mysqli_real_escape_string($dbhandle,$_POST['EventUrl']);
	$EventTitle = mysqli_real_escape_string($dbhandle,$_POST['EventTitle']);
$Company = mysqli_real_escape_string($dbhandle,$_SESSION['Companyid']);
	
	
	$sql = mysqli_query($dbhandle,"SELECT EventName FROM events WHERE EventName='$EventName' and CompanyId = $Company  LIMIT 1");
	$count = mysqli_num_rows($sql); // count the output amount
    if ($count > 0) {
		echo 'Sorry you tried to place a duplicate "Event Name" into the system, <a href="Events.php?Compid='.$Company.'">click here</a>';
		exit();
	}

	$sql = mysql_query("INSERT INTO events (EventName,EventUrl,EventTitle,CompanyId) 
        VALUES('$EventName','$EventUrl','$EventTitle',$Company);") or die (mysql_error());
     $pid = mysql_insert_id();

	$newname = "$pid.jpg";
	move_uploaded_file( $_FILES['fileField']['tmp_name'], "../Images/Events/$newname");
	header("location: Events.php?Compid=$Company"); 
    exit();
}
?>
 <?php 

if (isset($_GET['deleteid'])) {
	echo 'Do you really want to delete Category with ID of ' . $_GET['deleteid'] . '? <a href="Events.php?yesdelete=' . $_GET['deleteid'] . '&Compid='.$Company.'">Yes</a> | <a href="Events.php?Compid='.$Company.'">No</a>';
	exit();
}
if (isset($_GET['yesdelete'])) {

	$id_to_delete = $_GET['yesdelete'];
	$sql = mysqli_query($dbhandle,"DELETE FROM events WHERE EventID='$id_to_delete' LIMIT 1") or die (mysql_error());
	    $pictodelete = ("../Images/Events/$id_to_delete.jpg");
	 if (file_exists($pictodelete)) {
       		    unlink($pictodelete);
    }
	
	header("location:Events.php?Compid=$Company"); 
    exit();
}
?>
<?php 

$Event_list = "";
$sql = mysqli_query($dbhandle,"SELECT * FROM events where CompanyId = $Company order by EventID DESC");
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
			&darr; New Event form &darr;
			</h3></center>
			 
				<hr/>
				 <form action="Events.php?Compid=<?php echo $Company?>" enctype="multipart/form-data" name="myForm" id="myform" method="post">
			
		   <div> *<label>  Event Name</label>  <input name="EventName" type="text" id="product_namep" size="20" class="textbx"/> </div> 
			
			 
			<div><label>   Event Url</label>  	  <input name="EventUrl" type="text" id="product_namep" size="20" class="textbx"/></div> 
			
			<div> <label>  Event Title</label>  	   <input name="EventTitle" type="text" id="product_namep" size="20" class="textbx"/></div> 
						<div>  *<label> Event Image</label> <input type="file" name="fileField" id="fileField" /></div> 
				<div>     <input type="submit" name="button" id="button" value="Add This Item Now" /></div> 

			</form>
		
	
	</fieldset>
	</div>
	
</div>
</div>
<?php 
 require  "Admin_footer.php";
 ?>