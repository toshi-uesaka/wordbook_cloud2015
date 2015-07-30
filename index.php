<?php

session_start();
//check if is logined
if(isset($_SESSION["u_id"])){
//go to the main page immediately
  echo "
	<meta http-equiv='refresh' content='0;  
		url=main.php'>
	";
}
?>

<html>
  <head>
    <meta charset="UTF-8" />
    <title>Login Page</title>
  </head>
  <body>
	</br>
    <h1>Login</h1> 
    
      <form method="POST" action="login.php">
	<table>
	<tr>
	<td>username:</td>
	<td><input type="text" name="username" /></td>
	</tr>
	<tr>
        <td>password:</td> 
	<td><input type="password" name="password" /></td>
	</tr>
	<tr>
	<td><input type="submit" value="Login" /></td>
	</tr>
	</table>
      </form>
	<div>
		<p>No account? 
		<a href="register.php">register</a>
		</p>
	</div>		   
  </body>
</html>


