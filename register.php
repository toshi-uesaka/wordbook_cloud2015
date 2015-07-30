<?php
//https://team-lab.github.io/skillup/2/2.html
include 'config.php';
session_start();
//check if is logined
if(isset($_SESSION["u_id"])){
//go to the main page immediately
  echo "
        <meta http-equiv='refresh' content='0;  
                url=main.html'>
        ";
}
?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8" />
    <title>Register</title>
  </head>
  <body>
    <h1>Regeister</h1>
      
      <form method="POST" action="register_process.php">
	<table>
	<tr>
	<td>username</td>
        <td><input type="text" name="username" /></td>
	<tr>
	<td>password</td>
        <td><input type="password" name="pasword"/></td>
	<tr>
	<td>one more time</td>
	<td><input type="password" name="password"/></td>
	<tr>
        <td><input type="submit" value="Register" /></td>
	</tr>
	</table>
      </form>
      <div>
        <p>Already have an account? <a href="index.php">login</a></p>
      </div>
  </body>
</html>

