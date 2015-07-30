<?php

session_start();

//check if is logined
if(!isset($_SESSION["u_id"])){
//go to the error page immediately
  	echo "
        <meta http-equiv='refresh' content='0;  
                url=error.php?type=4'>
        ";
}else{
	$user = $_SESSION["username"];
	$u_id = $_SESSION["u_id"];
}

include 'config.php';

$select=$_POST['select'];

$conn = new mysqli($hostname,$username,$password,$database);

mysqli_query($conn,'SET NAMES utf8');

// delete all checked words
foreach ($select as $w_id) {
	$sql = "delete from $user where id = $w_id;";
	mysqli_query($conn, $sql);
}

echo '<meta http-equiv="Refresh" content="0;url=list.php">';


?>
