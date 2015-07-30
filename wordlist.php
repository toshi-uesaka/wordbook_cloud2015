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

?>


<!DOCTYPE>

<head>
	<title>Wordbook</title>
	<meta http-equiv="Content-Type" content="text/html;charset=UTF-8" />
	<meta http-equiv="Content-Type" content="text/javascript" />
	<link type="text/css" href="main.css" rel="stylesheet" media="screen" />
</head>

<body>
	<h2>Wordbook  <a href="logout.php">logout</a></h2>
	<div id="book">
		<canvas id="pageflip-canvas"></canvas>
		<div id="pages">

<?php

$conn = new mysqli($hostname,$username,$password,$database);
//mysqli_query($conn, 'SET NAMES utf8');
$conn->set_charset('utf8');

$sql = 'select * from '.$user.';';
$result = mysqli_query($conn, $sql);

while ($data = mysqli_fetch_row($result)) {
    echo "<section><div><h2>Question</h2><p>" . $data[1] . "</p></div></section><section><div><h2>Answer</h2><p>" . $data[2] . "</p></div></section>";

?>

		</div>
	</div>
	<script type="text/javascript" src="pageflip.js"></script>
</body>


