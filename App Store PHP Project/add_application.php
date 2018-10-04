<?php
?>
<html>
<body style="border: 2px solid black;width: 25%;margin: auto;margin-top: 5%;
text-align: center; background-image: url('./background.jpg'); background-repeat: no-repeat,">
<form action="add_application_success.php" method="post">
<br><br>
<h2> Insert the new values below </h2>

<h4>Application ID:</h4><input   type = 'text' name='application_id'>
<h4>Version:</h4><input    type = 'text' name='version'>
<h4>Name :</h4><input   type = 'text' name='name'>
<h4>Description:</h4><input type = 'text' name='description'>
<h4>Version Fix:</h4><input type = 'text' name='version_fix'>
<h4>Price:</h4><input    type = 'text' name='price'>
<h4>Application Files ID:</h4><input   type = 'text' name='app_files_id'>
<h4>Application Support ID:</h4><input type = 'text' name='app_support_id'>
<h4>Developer ID:</h4><input type = 'text' name='developer_id'><br><br>
<input type = 'submit'>
</form>
</body>
</html>