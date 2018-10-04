<html>
<body style = "background-image: url('./background.jpg');background-size: 2050px; background-repeat: no-repeat,">
<div style="border: 2px solid black;width: 25%;margin: auto;margin-top: 15%;text-align: center; background : MediumSeaGreen">
<form action="view_application.php" method="POST">
<br><br>Please select the category of the application </br></br>
<select name="category"><option> Choose </option>
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
$sql = "SELECT category_name FROM Categories";
$result = sqlsrv_query($conn,$sql) or die("Couldn't execut query");
while ($data=sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC)){

    echo "<option value=";
    echo $data['category_name'];
    echo ">";
    echo $data['category_name']; 
    echo "</option>";
}
?>
<br><input type="submit" value="category">


</select></br></br>
</form>
</div>
</body>

</html>