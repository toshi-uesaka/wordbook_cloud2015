<?php
	session_start();
//check if is logined
if(!isset($_SESSION["username"])){
//if haven't login, go to error page
   echo "
        <meta http-equiv='refresh' content='0;  
                url=error.php?type=4'>
        ";
}
	$user = $_SESSION["username"];
	
	include 'config.php';
	
	$conn = new mysqli($hostname,$username,$password,$database);
	$conn->set_charset('utf8');
	$sql = "select privacy from user where username = '$user'";
	$result = mysqli_query($conn, $sql);
	$data = mysqli_fetch_row($result);
	if($data[0]==0){
		$sql = "update user set privacy=1 where username = '$user'";	
	}
	else{
		$sql = "update user set privacy=0 where username = '$user'";	
	}
	$result = mysqli_query($conn, $sql);
	$conn->close();
	echo "
        <meta http-equiv='refresh' content='0;  
                url=main.php'>
        ";
?>
