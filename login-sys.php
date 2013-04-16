<!doctype html>
<html>
<head>
  <title>Login</title>
</head>
<body>
	<h1>Login</h1>
	<?php // Script 11.8 - login.php
	$loggedin = FALSE;
	session_start();
	$file = '../../../../uploads/users/users.txt';
	if ($_SERVER['REQUEST_METHOD'] == 'POST') {
		ini_set('auto_detect_line_endings', 1);
		$fp = fopen($file, 'rb');
		while ( $line = fgetcsv($fp, 200, "\t") ) {
			if ( ($line[0] == $_POST['username']) AND ($line[1] == md5(trim($_POST['password']))) ) {
				$loggedin = TRUE;
				break;
			}
		}
		fclose($fp);
		if ($loggedin) {
			setcookie('LoggedIn', time());
			setcookie('UserName', $_POST['username']);
			setcookie('TypeOfAccess', 'login');
			$_SESSION['LoggedIn'] = time();
			$_SESSION['UserName'] = $_POST['username'];
			$_SESSION['TypeOfAccess'] = 'login';
			include("showtime-sys.php");
			exit();
		} else {
			print '<p style="color: red;">The username and password you entered do not match those on file.</p>';
		}
	} 

	if (!$loggedin) {
	?>
		<form action="login-sys.php" method="post">
		<p>Username: <input type="text" name="username" size="20" /></p>
		<p>Password: <input type="password" name="password" size="20" /></p>
		<input type="submit" name="submit" value="Login" />
		</form>
		<p>If you would rather register a user, click <a href="register-sys.php">here</a></p>
<?php } // End of submission IF. ?>
</body>
</html>
