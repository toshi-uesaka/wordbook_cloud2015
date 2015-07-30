<?php
//https://team-lab.github.io/skillup/2/2.html
include 'config.php';

$mysqli = new mysqli($hostname, $username, $password, $database);
// check the connection of database
if($mysqli->connect_error){
	print($mysqli->connect_error);
	exit();
}


if(!empty($_POST["username"]) && !empty($_POST["password"] && !empty($_POST["pasword"]))){
  // if both username and password are filled

  // if 2 passwords is not equivalent
  if($_POST["pasword"] != $_POST["password"]){
  // go to the error page type = 7
	echo "
        <meta http-equiv='refresh' content='0;  
                url=error.php?type=7'>
        ";
		exit(1);
  }
  //username must consists of alphabet or number
  if(ctype_alnum($_POST['username']) == false){
       echo "
        <meta http-equiv='refresh' content='0;  
                url=error.php?type=6'>
        ";
  		exit(1);
  }
  
  // firstly, check whether the username has been used or not
  $sql = 'select * from user where username = "' .$_POST['username']. '"';
  $result = mysqli_query($mysqli,$sql);
  $row = mysqli_fetch_row($result);
  if (!empty($row[0])){
    // if the username has been USED
    // go to the error page , type = 3
      echo "
        <meta http-equiv='refresh' content='0;  
                url=error.php?type=3'>
        ";

  }else{
    // if the username is USABLE
    // then register the user
    $passmd5 = md5($_POST["password"] . $salt);
    $sql = 'insert into user values ("", "'.$_POST["username"].'", "'.$passmd5.'",1)';
    mysqli_query($mysqli,$sql);

    // and create a new table of WORD, set default charset as UTF-8 here.
    $sql = 'create table '.$_POST["username"].' (
	id int(4) not null primary key auto_increment,
	word varchar(200) not null,
	trans varchar(200) not null
	) charset=utf8';
    mysqli_query($mysqli,$sql);
    
    // finally, go to the login page in 3s
    echo "
        <meta http-equiv='refresh' content='3;  
                url=index.php'>
	<h1>Register Successfully</h1>
	<p>going to <a href='index.php'>login</a> in 3s</p>
        ";
  }
}else{
// if missed username or password
// go to the error page with type = 2
  echo "
        <meta http-equiv='refresh' content='0;  
                url=error.php?type=2'>
        ";
}

?>


