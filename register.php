<?php
//https://team-lab.github.io/skillup/2/2.html
include 'config.php';

$mysqli = new mysqli($hostname, $username, $password, $database);

if($mysqli->connect_error){
	print($mysqli->connect_error);
	exit();
}

$status = "none";

if(!empty($_POST["username"]) && !empty($_POST["password"])){
  //パスワードはハッシュ化する
  $passmd5 = md5($_POST["password"] . $salt);

  //ユーザ入力を使用するのでプリペアドステートメントを使用
  $sql = 'select from user where username = "' .$_POST['username']. '"';
  $result = mysqli_query($mysqli,$sql);
  if (sizeof($result) > 0){
    echo '
    <script type="text/javascript">alert("Username has been used!!")</script>
    ';
    $status = "failed";
  }else{
    $sql = 'insert into user values ("", "'.$_POST["username"].'", "'.$passmd5.'")';
    mysqli_query($mysqli,$sql);
    $sql = 'create table '.$_POST["username"].' (
	id int(4) not null primary key auto_increment,
	word char(32) not null,
	trans char(200) not null
	)';
    mysqli_query($mysqli,$sql);
    $status = "ok";
  }
 // $stmt = $mysqli->prepare("INSERT INTO user VALUES ('', ?, ?)");
//  $stmt->bind_param('ss', $_POST["username"], $passmd5);

//  if($stmt->execute())
//    $status = "ok";
// else
    //既に存在するユーザ名だった場合INSERTに失敗する
//    $status = "failed";
}

?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8" />
    <title>新規登録</title>
  </head>
  <body>
    <h1>新規登録</h1>
    <?php if($status == "ok"): ?>
      <p>登録完了</p>
    <?php elseif($status == "failed"): ?>
      <p>エラー：既に存在するユーザ名です。</p>
    <?php else: ?>
      <form method="POST" action="register.php">
        ユーザ名：<input type="text" name="username" />
        パスワード：<input type="password" name="password" />
        <input type="submit" value="登録" />
      </form>
    <?php endif; ?>
  </body>
</html>

