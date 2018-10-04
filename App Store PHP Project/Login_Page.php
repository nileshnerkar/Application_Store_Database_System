
<!DOCTYPE html>
<html>

<body style="width: 25%;margin: auto;margin-top:5%;text-align: center; background-image: url('./background.jpg');background-size: 2050px; background-repeat: no-repeat,">
<div style= "background : MediumSeaGreen  ">
<br>
<h2>Select the user role</h2>
<br>
<div >
<form name="role" action="login_action.php" method="post">
  <select name="role">
    <option value="user">User</option>
    <option value="admin">Admin</option>
  </select>
<br><br>
</div>

Username: <input class="form" type="username" name="username"><br /><br>
Password: <input class="form" type="password" name="password"><br /><br>
<input name="submit" type="submit" value="submit">
<br>
<br>
</form>
</div>
</body>
</html>
