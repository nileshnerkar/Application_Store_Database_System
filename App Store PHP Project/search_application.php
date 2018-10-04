<?php

$serverName = "ANUJA\SQL17NEW"; 
$connInfo = array("Database"=>"AppStoreVersion2", "UID"=>"nilesh", "PWD"=>"nilesh");
$conn = sqlsrv_connect($serverName, $connInfo);
?>

<html>
<center>
<br>
<h2> Following are different versions of the applications searched </h2>
<body style="border: 2px solid black;width: 70%;margin: auto;margin-top: 5%;
text-align: center; background-image: url('./background.jpg'); background-repeat: no-repeat,">	


<?php

if( $conn === false ) {
    die( print_r( sqlsrv_errors(), true));
}

$searchtext = $_GET['searchtext'];
$query = "SELECT * FROM Applications where name like '%$searchtext' ";


$stmt = sqlsrv_query( $conn, $query );
if( $stmt === false) {
    die( print_r( sqlsrv_errors(), true) );
}

while( $row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_NUMERIC) ) {
	  
  
	  
?>	
 <form action="delete_application.php" method="POST">
<table cellpadding=2 cellspacing=2 border="2" align = center>
<input type="hidden" name="name" value="<?php echo $row[2]; ?>" >

<tr>
<td><input name="app_id" type="text" value="<?php echo $row[0]; ?>"></td>
<td><input name="version_id" type="text" value="<?php echo $row[1]; ?>"></td>
<td><input name="description" type="text" value="<?php echo $row[3]; ?>"></td>
<td><input name="price" type="text" value="<?php echo $row[7]; ?>"></td>
</tr>	  
</table>	  

<input type="submit" value="DELETE" />
</body>
</center>
</html>
<?php
}
?>	  `