
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


if($_POST){
	$word=$_POST['add_word'];
	$def=$_POST['add_def'];
}


$conn = new mysqli($hostname,$username,$password,$database);

$conn->set_charset('utf8');
print_r($word);

$sql = "insert into ".$user." values('','$word','$def')";
$result = mysqli_query($conn, $sql);

if($result) echo '<meta http-equiv="Refresh" content="0;url=list.php">';
else echo 'failed<br>'.mysql_error().'<br><a href="list.php">back</a>';

?>
