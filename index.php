<?php

include 'config.php';

//セッション開始
session_start();

$mysqli = new mysqli($hostname, $username, $password, $database);

$status = "none";

//セッションにセットされていたらログイン済み
if(isset($_SESSION["u_id"])){
  //echo $_SESSION["u_id"];
  $status = "logged_in";
}
else if(!empty($_POST["username"]) && !empty($_POST["password"])){
  //ユーザ名、パスワードが一致する行を探す
  $passmd5 = md5($_POST["password"] . $salt);
  $sql = 'select * from user where username = "' .$_POST["username"]. '" and passmd5 = "' .$passmd5. '"';
//  $stmt = $mysqli->prepare("SELECT * FROM user WHERE username = ? AND passmd5 = ?");
//  $stmt->bind_param('ss', $_POST["username"], $password);
//  $stmt->execute();
  $result = mysqli_query($mysqli,$sql);
  if(sizeof($result)>0){
    $status = "ok";
    while($row = mysqli_fetch_row($result)){
      $_SESSION["username"] = $row[1];
      $_SESSION["u_id"] = $row[0]; 
    }
  }else{
    $status = "failed";
  }

  //結果を保存
  //$stmt->store_result();
  //結果の行数が1だったら成功
  //if($stmt->num_rows == 1){
   // $status = "ok";
    //セッションにユーザ名を保存
  //  $_SESSION["username"] = $_POST["username"];
  //}else
  //  $status = "failed";
}

?>

<?php if($status == "logged_in" or $status == "ok"):
   include 'main.html';

   else: ?>
<html>
  <head>
    <meta charset="UTF-8" />
    <title>ログイン</title>
  </head>
  <body>
    <h1>ログイン</h1> 
    <?php if($status == "failed"): ?>
      <p>ログイン失敗</p>
    <?php else: ?>
      <form method="POST" action="index.php">
        ユーザ名：<input type="text" name="username" />
        パスワード：<input type="password" name="password" />
        <input type="submit" value="ログイン" />
      </form>
    <?php endif; ?>
  </body>
</html>
<?php endif; ?>

