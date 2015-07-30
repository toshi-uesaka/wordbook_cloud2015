<?php
	// missed username or password
	// wrong username or password
	// and these 2 of register.
	// additional error about unlogin
	// invalid access to wordbook
	// invalid username
	// 2 passwd not the same
	$tp = $_GET["type"];
	if($tp == 0): ?>
		<p> Login Failed</p>
		<p> Please type both username and password</p>
		<a href='index.php'>Try again</a>
	<?php elseif($tp == 1): ?>
		<p> Login Failed</p>
		<p> Wrong username or password</p>
		<a href='index.php'>Try again</a>
	<?php elseif($tp == 2): ?>
		<p> Register Failed</p>
		<p> Please type both username and password</p>
		<a href='register.php'>Try again</a>
	<?php elseif($tp == 3): ?>
		<p> Register Failed</p>
		<p> Username has been used</p>
		<a href='register.php'>Try again</a>		
	<?php elseif($tp == 4): ?>
		<p> You haven't login yet! </p>
		<p> Please <a href='index.php'>login</a></p>
	<?php elseif($tp == 5): ?>
		<p> Invalid Access to Wordbook</p>
		<a href='index.php'>Return to Top</a>
	<?php elseif($tp == 6): ?>
		<p> Register Failed</p>
		<p> Username must consists of only alphabet or number</p>
		<a href='register.php'>Try again</a>
	<?php elseif($tp == 7): ?>
		<p> Register Failed</p>
		<p> the 2 password is not the same</p>
                <a href='register.php'>Try again</a>
	<?php endif ?>
