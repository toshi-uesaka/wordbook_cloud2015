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
	
	$privacy = true;	
	$conn = new mysqli($hostname,$username,$password,$database);
	$conn->set_charset('utf8');
	$sql = "select privacy from user where username = '$user'";
	$result = mysqli_query($conn, $sql);
	$data = mysqli_fetch_row($result);
	if($data[0] == 0)
		$privacy = false;
	$conn->close();

?>


<html>
<head>
<link href="style.css" rel="stylesheet" type="text/css"/>
<title>Test Page for Cloud</title>
</head>
<body>
<div id="contentsWrapper">
<a href="list.php">list</a>&
<a href="wordbook.php">record</a>&
<a href="search.php">search</a>&
<a href="logout.php">logout</a><br>
<p>Hello <?php echo $_SESSION["username"]; ?>!!!</p>
<?php if($privacy): ?>
<p>Now your wordbook is private. Others cannot see the contents.</p>
<a href="switch_privacy.php">Make it public</a>
<?php else: ?>
<p>Now your wordbook is public. Others can see the contents.</p>
<a href="switch_privacy.php">Make it private</a>
<?php endif ?>
</div>
</body>
</html>
