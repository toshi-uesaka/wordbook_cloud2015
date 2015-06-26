<?php
	include 'config.php';
		
	echo "<p>this is a test of PHP-mysql</p>";

	$conn = mysql_connect($hostname, $username, $password) or die("connect failed" . mysql_error());	
	mysql_select_db('word');

	$sql = "select * from `word`";
	$result = mysql_query($sql,$conn);
	
	if($result){
		echo '<table border="2">
			<tr>
				<td>id</td>
				<td>word</td>
			</tr>';
		while($row = mysql_fetch_row($result)){
			echo "<tr>";
			echo "<td>" . $row[0].'</td><td>'.$row[1] . "</td>";
			echo "</tr>";
		}
		echo '</table>';
	}	
	else{
		echo "no data";
	}

?>
