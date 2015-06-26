<?php
	include 'config.php';
	$mysqli = new mysqli($hostname,$username,$password,$database);
	
	$table = 'user';
	$sql = 'select * from ' . $table;
	echo $sql;
	$result = mysqli_query($mysqli,$sql);

	if($result){
		echo "result";
		while($row = mysqli_fetch_row($result)){
			printf($row['u_id']);
		}
	}
	
?>
