<html>
<center>
<body style="border: 2px solid black;width: 70%;margin: auto;margin-top: 5%;
text-align: center; background-image: url('./background.jpg'); background-repeat: no-repeat,">

<form action="edit_application_success.php" method="POST">
<h2>Enter the new name of the application</h2>
<br>
<?php
/*
$con = mysqli_connect("localhost","root","","student_db");
if (!$con){
  die('Could not connect: ' . mysqli_error());
  }
mysqli_select_db($con,"student_db");
*/

$serverName = "ANUJA\SQL17NEW"; 
$connInfo = array("Database"=>"AppStoreVersion2", "UID"=>"nilesh", "PWD"=>"nilesh");
$conn = sqlsrv_connect($serverName, $connInfo);
if (!$conn){
  die('Could not connect: ' . sqlsrv_errors());
}


//$student_id = isset($_REQUEST['student_id']) ? $_REQUEST['student_id'] :'';
//$student_id= $_REQUEST['student_id'];
$name = $_REQUEST['name'];

//$query = "SELECT * FROM Application_Supports where app_support_id ='$student_id' ";
$query = "SELECT application_id, version_id, name , version_fix, price FROM Applications
			where name ='$name' ";


$stmt = sqlsrv_query( $conn, $query );
if( $stmt === false) {
    die( print_r( sqlsrv_errors(), true) );
}

while ($row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC))    
{



?>


<table cellpadding=2 cellspacing=2 border="2">
<input type="hidden" name="app_id" value="<?php echo $row['application_id']; ?>" >

<tr>
<th>Version </th>
<th>Name </th>
<th>Version Fix </th>
<th>Price</th>
</tr>


<tr>
<td><input name="version" type="text" value="<?php echo $row['version_id']; ?>"></td>
<td><input name="name" type="text" value="<?php echo $row['name']; ?>"></td>
<td><input name="version_fix" type="text" value="<?php echo $row['version_fix']; ?>"></td>
<td><input name="price" type="text" value="<?php echo $row['price']; ?>"></td>
</tr>


<tr>
<td><input type="submit" value="Update Application" /></td>
<td><input type="Reset" value="Reset" /></td>

</tr>

</form>
</body>
</center>
</html>
<?php
}
?>