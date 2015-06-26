<?php
session_start();
$u_id = $_SESSION["word"];

include 'wordlist.html';

include 'config.php';

$con = mysql_connect($hostname, $username, $password);
if (!$con) {
  exit('データベースに接続できませんでした。');
}

$result = mysql_select_db($database, $con);
if (!$result) {
  exit('データベースを選択できませんでした。');
}

$result = mysql_query('SET NAMES utf8', $con);
if (!$result) {
  exit('文字コードを指定できませんでした。');
}

$result = mysql_query('SELECT * FROM '.$u_id, $con);
while ($data = mysql_fetch_array($result)) {
  echo '<p>' . $data['no'] . ':' . $data['name'] . ':' . $data['tel'] . "</p>\n";
}

$con = mysql_close($con);
if (!$con) {
  exit('データベースとの接続を閉じられませんでした。');
}

?>
