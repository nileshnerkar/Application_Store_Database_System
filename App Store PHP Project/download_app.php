<html>
<body style="border: 2px solid black;width: 75%;margin: auto;margin-top: 5%;text-align: center; background-image: url('./background.jpg');background-size: 2050px; background-repeat: no-repeat,">
<center>
<br><br>
<?php

$serverName = "ANUJA\SQL17NEW"; 
$connInfo = array("Database"=>"AppStoreVersion2", "UID"=>"nilesh", "PWD"=>"nilesh");
$conn = sqlsrv_connect($serverName, $connInfo);

if (!$conn){
  die('Could not connect: ' . sqlsrv_errors());
}
 
$query= ("INSERT INTO Downloads(download_id,download_date,application_id,version_id,device_id)
		 VALUES (?,?,?,?,?)");

$current_date = date('Y-m-d');
$params = array("102","{$current_date}","{$_POST['application_id']}","{$_POST['version_id']}","21");

 
$stmt = sqlsrv_query($conn, $query, $params);  
if ($stmt) {  
    echo "Row successfully inserted.\n";  
} else {  
    echo "Row insertion failed.\n";  
    die(print_r(sqlsrv_errors(), true));  
}  

/* Free statement and connection resources. */  
sqlsrv_free_stmt($stmt);


echo "<a href='dropdown.php'>Home</a><br/>";
?>
</center>
</body>
</html>