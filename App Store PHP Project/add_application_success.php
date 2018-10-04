<html>
<center>
<body style="border: 2px solid black;width: 25%;margin: auto;margin-top: 5%;
text-align: center; background-image: url('./background.jpg'); background-repeat: no-repeat,">
<br><br>
<h2>Succesfully added the application</h2>

<?php

$serverName = "ANUJA\SQL17NEW"; 
$connInfo = array("Database"=>"AppStoreVersion2", "UID"=>"nilesh", "PWD"=>"nilesh");
$conn = sqlsrv_connect($serverName, $connInfo);

if (!$conn){
  die('Could not connect: ' . sqlsrv_errors());
}
  
$query= ("INSERT INTO Applications(application_id,version_id,name,description,version_fix,created_date,updated_date,
         price,age_restriction,is_verified,is_advertised,application_files_id,app_support_id,developer_id)
		 VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?) ");

$current_date = date('Y-m-d');
$params = array("{$_POST['application_id']}","{$_POST['version']}","{$_POST['name']}","{$_POST['description']}","{$_POST['version_fix']}",
         "{$current_date}","{$current_date}","{$_POST['price']}","","1","1","{$_POST['app_files_id']}","{$_POST['app_support_id']}",
		 "{$_POST['developer_id']}");

 
$stmt = sqlsrv_query($conn, $query, $params);  
if( $stmt === false) {
    die( print_r( sqlsrv_errors(), true) );
}  

/* Free statement and connection resources. */  
sqlsrv_free_stmt($stmt);

echo "<a href='dropdown.php'>Home</a><br/>";
?>
</body>
</center>
</html>