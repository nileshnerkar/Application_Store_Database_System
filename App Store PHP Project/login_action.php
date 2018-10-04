<?php

$serverName = "ANUJA\SQL17NEW"; 
$connInfo = array("Database"=>"AppStoreVersion3", "UID"=>"nilesh", "PWD"=>"nilesh");
$conn = sqlsrv_connect($serverName, $connInfo);

if($conn){
    echo '';
}else{
    echo 'Connection failure<br />';
die(print_r(sqlsrv_errors(),TRUE));
}

$role= $_REQUEST['role'];
$username = $_REQUEST['username'];
$password= $_REQUEST['password'];

echo $role;
echo $username;
echo $password;

if ($role == 'admin'){
echo "hello";
$query = "SELECT * FROM Admin_Credentials WHERE username = '$username' and password = '$password'";

$stmt = sqlsrv_query( $conn, $query);
$row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC);

if( $stmt == false) {
    die( print_r( sqlsrv_errors(), true) );
}
else if($row == NULL)
{
	
	echo "hello";
}
else{
header('Location: home.php');}
}
else 
{
$query = "(SELECT account_id FROM dbo.User_Account_Details WHERE user_name ='$username' 
		AND password = HASHBYTES('SHA2_512', '$password' + CAST(password_hash AS VARCHAR(64))))";
$stmt = sqlsrv_query( $conn, $query);
$row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC);
if( $stmt == false) {
    die( print_r( sqlsrv_errors(), true) );
}
else if($row == NULL)
{
		echo "hello";
}
else{
header('Location: dropdown.php');
}
}
?>
