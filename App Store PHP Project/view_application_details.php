<?php

$serverName = "ANUJA\SQL17NEW"; 
$connInfo = array("Database"=>"AppStoreVersion2", "UID"=>"nilesh", "PWD"=>"nilesh");
$conn = sqlsrv_connect($serverName, $connInfo);
?>

<html>
<body style="border: 2px solid black;width: 75%;margin: auto;margin-top: 5%;text-align: center; background-image: url('./background.jpg');background-size: 2050px; background-repeat: no-repeat,">
<center>
<br><br>
<h2>Search Results</h2>

 <form action="download_app.php" method="POST">	
<?php

if( $conn === false ) {
    die( print_r( sqlsrv_errors(), true));
}

$searchtext = $_REQUEST['name'];
$query = "SELECT * FROM Applications where name like '%$searchtext'";

$stmt = sqlsrv_query( $conn, $query );
if( $stmt === false) {
    die( print_r( sqlsrv_errors(), true) );
}

while( $row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_NUMERIC) ) {
		
	  
?>	

<table cellpadding=2 cellspacing=2 border="2" align = center>
<input type="hidden" name="app_name" value="<?php echo $row[2]; ?>" >

<tr>
<td><input name="name" type="text" value="<?php echo $row[2]; ?>"></td>
<td><input name="application_id" type="text" value="<?php echo $row[0]; ?>"></td>
<td><input name="version_id" type="text" value="<?php echo $row[1]; ?>"></td>
<td><input name="description" type="text" value="<?php echo $row[3]; ?>"></td>
</tr>	  
</table>	  
<br><br>
<input type="submit" value="Download" />
<br><br>
</center>
</body>
</html>
<?php
}
?>	  