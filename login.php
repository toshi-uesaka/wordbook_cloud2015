<?php
	session_start();
	include 'config.php';
	$conn = new mysqli($hostname, $username, $password, $database);

	if(!empty($_POST["username"]) && !empty($_POST["password"])){
  	// if both username and password are typed, check it in the database
  	$passmd5 = md5($_POST["password"] . $salt);
  	$sql = 'select * from user where username = "' .$_POST["username"]. '" and passmd5 = "' .$passmd5. '"';

	$result = mysqli_query($conn,$sql);

 	// if there is a result
  	$row = mysqli_fetch_row($result);
  	if(!empty($row[0])){
    		// set up SESSION
    		$_SESSION["username"] = $row[1];
    		$_SESSION["u_id"] = $row[0];
		// go to the main page
		echo "
                <meta http-equiv='refresh' content='0;url=main.php'>
                ";

  	}else{
		// typed wrong user or pass, go to the error page
		echo "
                 <meta http-equiv='refresh' content='0;url=error.php?type=1'>
         	";
	}
	}else{
	
    	// missed username or password.
    	// go to the error page
    	echo "
        	<meta http-equiv='refresh' content='0;url=error.php?type=0'>

        ";
  	}

?>
