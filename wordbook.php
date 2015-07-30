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

$validity = true;

if($_GET and $_GET['title']){
	$title=$_GET['title'];
	$conn = new mysqli($hostname,$username,$password,$database);
	$conn->set_charset('utf8');
	$sql = "select privacy from user where username = '$title'";
	$result = mysqli_query($conn, $sql);
	if($result->num_rows == 0){
		$validity = false;
	}else{
		$data = mysqli_fetch_row($result);
		if($data[0]!=0)
				$validity = false;
	}
	$conn->close();

}else{
	$title = $user;
}
if($validity):
?>


<!DOCTYPE>

<head>
	<title>Wordbook</title>
	<meta http-equiv="Content-Type" content="text/html;charset=UTF-8" />
	<meta http-equiv="Content-Type" content="text/javascript" />
	<link type="text/css" href="wordbook.css" rel="stylesheet" media="screen" />
	<style type="text/css">
	p {margin-top:10}
	</style>
</head>

<body>
	<h1>Wordbook&nbsp;&nbsp;<a href="main.php">home</a>&<a href="list.php">list</a>&<a href="search.php">search</a>&<a href="logout.php">logout</a></h1>
	<div id="book">
		<canvas id="pageflip-canvas"></canvas>
		<div id="pages">

<?php

$conn = new mysqli($hostname,$username,$password,$database);
//mysqli_query($conn, 'SET NAMES utf8');
$conn->set_charset('utf8');

$sql = "select count(*) from $title";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_row($result);
$count = $row[0];

if($count==0){
	echo "<section><div><p>"
         ."You haven't add any word yet!"."</p></div></section>
		<section><div><p>"
         ."Please add some words at list first.". "</p></div></section>";

}
else{
$sql = 'select * from '.$title.';';
$result = mysqli_query($conn, $sql);

while ($data = mysqli_fetch_row($result)) {
    echo "<section><div><h2>Question</h2><p>"
    	 . $data[1] . "</p></div></section><section><div><h2>Answer</h2><p>"
	 . $data[2] . "</p></div></section>";
}
}
?>

		</div>
	</div>
	<script type="text/javascript" src="pageflip.js"></script>

</body>

<?php else: ?>
        <http-equiv='refresh' content='0;  
                url=error.php?type=5'>
        
<?php endif	?>
