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
<html>
<head>
	<title>Word List</title>
	<meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
	<meta http-equiv="Content-Type" content="text/javascript">
	<link rel="stylesheet" type="text/css" href="style.css">

	<script type="text/javascript">
	
	function check(){
		if(document.form1.add_word.value==""){
			window.alert("追加する単語を入力してください");
			return false;	
		}
		else if (document.form1.add_def.value==""){
			window.alert("訳を入力してください");
			return false;
		}
		else{
			return true;
		}
	}

	function delete_word(){
		var box_name='select[]';
		var check_len=document.form2.elements[box_name].length;
		if(check_len){
			for(var i=0; i < check_len ; i++){
				if(document.form2.elements[box_name][i].checked==true){
					return true;
				}
			}
		}else if(document.form2.elements[box_name].checked){
			return true;
		}
		window.alert("削除する単語をチェックしてください");
		return false;
	}	
</script>
<style typ = "text/css">
h1{
  text-align:left
}
</style>
</head>

<body>

<div id="listWrapper">

<h1 >Word List&nbsp;&nbsp;<a href="main.php">home</a>&<a href="wordbook.php">record</a>&
<a href="search.php">search</a>&
<a href="logout.php">logout</a></h1>

<form action="add.php" name="form1" method="POST" 
		onSubmit="return check()" entype="multipart/form-date">
	<table>
	<tr>
	<td>word : </td>
	<td><input type="text" name="add_word"></td>
	</tr>
	<tr>
	<td>definition : </td>
	<td><input type="text" name="add_def"></td>
	</tr>
	<tr><td></td>
	<td><input type="submit" value="add"></td>
	</tr>
	</table>
</form>


<?php

$conn = new mysqli($hostname,$username,$password,$database);
$conn->set_charset('utf8');

// check whether the table is empty
// if is, show error message,
// else show the list.
$sql = "select count(*) from $user";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_row($result);
$count = $row[0];
if($count == 0){
	echo "
	<h2>You haven't added any word yet!</h2>.
	";
}
else{

$sql = 'select * from '.$user.' order by word;';
$result = mysqli_query($conn, $sql);

echo '<form action="delete.php" name="form2" method=POST onSubmit="return delete_word()">';
echo '<table align="center" border="1" id="table1">
	<th colspan="2">Word</th><th>Definition</th>';

while ($data = mysqli_fetch_row($result)) {
echo "<tr align='center'><td><input type='checkbox' name='select[]' value='$data[0]'></td><td>"
 . $data[1] . '</td><td>' . $data[2] . "</td></tr>";
}

echo '</table><input type="submit" value="delete"></form>';
}
?>

</div>
</body>
</html>

