<?php
mb_internal_encoding("UTF-8"); //内部文字コードを変更
mb_http_input("auto");
mb_http_output("UTF-8");


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

$key = NULL;
if($_POST){
	$key = $_POST['keyword'];
}
?>

<!DOCTYPE>
<html>
<head>
	<title>Word List</title>
	<meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
	<meta http-equiv="Content-Type" content="text/javascript">
	<link rel="stylesheet" type="text/css" href="style.css">
</head>

<body>

<div id="listWrapper">

<h1 >Search&nbsp;&nbsp;<a href="main.php">home</a>&
<a href="list.php">list</a>&
<a href="wordbook.php">record</a>&
<a href="logout.php">logout</a></h1>

<form action="search.php" name="form1" method="POST" entype="multipart/form-date">
	search users <input type="text" name="keyword" value="<?php
		if($key)
			echo $key;
		else
			echo "";
	?>"><br>
	<input type="submit" value="search" >
</form>
<?php
if($key){
	$conn = new mysqli($hostname,$username,$password,$database);
	$sql = "select username from user where username like '". $key ."%' and privacy = 0";
	$result = mysqli_query($conn, $sql);
	if($result->num_rows == 0){
		echo "No applicable.";
	}else{
		echo "<p>".$result->num_rows." wordbook";
		if($result->num_rows == 1)
			echo ' is found.</p>';
		else
			echo 's are found.</p>';

		while ($data = mysqli_fetch_row($result)) {
			echo "<a href='wordbook.php?title=".$data[0]."'>".$data[0]."</a><br>";
		}
		echo "</br>";
	}
}
?>
</body>
</html>

