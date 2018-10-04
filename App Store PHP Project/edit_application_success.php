<html>
<body style="border: 2px solid black;width: 70%;margin: auto;margin-top: 5%;
text-align: center; background-image: url('./background.jpg'); background-repeat: no-repeat,">
<?php
$serverName = "ANUJA\SQL17NEW"; 
$connInfo = array("Database"=>"AppStoreVersion2", "UID"=>"nilesh", "PWD"=>"nilesh");
$conn = sqlsrv_connect($serverName, $connInfo);
if (!$conn){
  die('Could not connect: ' . sqlsrv_errors());
}

$query  = "
UPDATE Applications
SET name = (?)
WHERE application_id= (?)";


$params = array("{$_POST['name']}","{$_POST['app_id']}");


$stmt = sqlsrv_query( $conn, $query, $params );
if( $stmt === false) {
    die( print_r( sqlsrv_errors(), true) );
}

echo "Application Updated<br>";
echo "<a href='home.php'>Home</a><br/>";
?>
</body>
</html>