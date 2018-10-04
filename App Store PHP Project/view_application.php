<html>
<body style="border: 2px solid black;width: 45%;margin: auto;margin-top: 5%;text-align: center; background-image: url('./background.jpg');background-size: 2050px; background-repeat: no-repeat,">
<!-- form for tower selection -->
<form action="view_application_details.php" method="POST">
<br><br>
<h2> All the Application under the selected Category</h2>
<?php

$serverName = "ANUJA\SQL17NEW"; 
$connInfo = array("Database"=>"AppStoreVersion2", "UID"=>"nilesh", "PWD"=>"nilesh");
$conn = sqlsrv_connect($serverName, $connInfo);


if($conn){
    echo '';
}else{
    echo 'Connection failure<br />';
die(print_r(sqlsrv_errors(),TRUE));
}

$searchtext = $_REQUEST['category'];


$sql = "SELECT * FROM Category_Applications
WHERE Category = '$searchtext'";
/*
$sql = "SELECT DISTINCT A.name FROM Categories C
INNER JOIN Application_Categories AC
ON (C.category_id = AC.category_id)
INNER JOIN Applications A
ON (AC.application_id = A.application_id)
AND (AC.version_id = A.version_id)
WHERE C.category_name = '$searchtext'";
*/

$result = sqlsrv_query($conn,$sql) or die("Couldn't execut query");

while ($row = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC)){

?>


<br><br>
<table cellpadding=2 cellspacing=2 border="2" align = center>
<input type="hidden" name="app_name" value="<?php echo $row['name']; ?>" >

<tr>
<td style="background: lightblue"><input style="background: lightgreen" name="name" type="text" value="<?php echo $row['name']; ?>"></td>
<td style="background: lightblue"><input style="background: lightgreen" name="rating" type="text" value="<?php echo $row['Ratings']; ?>"></td>
<td>
<a href="view_application_details.php?name=<?php echo $row ['name'];?>">View the Appication</a></td>
</tr>	  
</table>
<?php
}
?>

<br><br>
<button>
<a href="view_application_details.php?name=<?php echo $row ['name'];?>">View All Applications</a>
</button>

</form>
</body>
</html>
