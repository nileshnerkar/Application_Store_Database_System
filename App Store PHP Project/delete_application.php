<html>

<br>

<body style="border: 2px solid black;width: 70%;margin: auto;margin-top: 5%;
text-align: center; background-image: url('./background.jpg'); background-repeat: no-repeat,">
<?php

$serverName = "ANUJA\SQL17NEW"; 
$connInfo = array("Database"=>"AppStoreVersion2", "UID"=>"nilesh", "PWD"=>"nilesh");
$conn = sqlsrv_connect($serverName, $connInfo);
if (!$conn){
  die('Could not connect: ' . sqlsrv_errors());
}

$name= $_REQUEST['app_id'];

 
$query  = " DELETE FROM Applications
WHERE application_id = '$name'" ;

sqlsrv_query($conn ,$query);
?>
<h3> Application has been deleted ! </h3> <br/>

<a href='home.php'>Home</a><br/>
</body>
</html>