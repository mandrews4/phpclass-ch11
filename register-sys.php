<!doctype html>
<html>
<head>
  <title>Register</title>
	<style type="text/css" media="screen"> .error { color: red; }</style>
</head>
<body>
<h1>Register</h1>
<?php // Script 11.6 - register.php
session_start();
$registered = FALSE;
$dir = '../../../../uploads/users/';
$file = $dir . 'users.txt';
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
	$problem = FALSE;
	if (empty($_POST['username'])) {
		$problem = TRUE;
		print '<p class="error">Please enter a username!</p>';
	}
	if (empty($_POST['password1'])) {
		$problem = TRUE;
		print '<p class="error">Please enter a password!</p>';
	}
	if ($_POST['password1'] != $_POST['password2']) {
		$problem = TRUE;
		print '<p class="error">Your password did not match your confirmed password!</p>';
	}
	if (!$problem) {
		if (is_writable($file)) {
			$subdir = time() . rand(0, 4596);
			$data = $_POST['username'] . "\t" . md5(trim($_POST['password1'])) . "\t" . $subdir . PHP_EOL;
			/*
			 * Before adding the entry for the specified user to the file, ensure that that user is not
			 * already registered:
			 *
			 * 1. Read the contents of the file into a string variable
			 * 2. Search for an instance of the specified username at the beginning of a line that is also
			 *    followed by a tab.
			 * 
			 *    If such an instance is found, inform the user and ask them to choose another username.
			 *
			 *    Otherwise, add the users entry to the file.
			 */
			$contents = file_get_contents($file);
			$pattern = '/^' . $_POST['username'] . "\t/m";
			if (preg_match($pattern, $contents)) {
				print '<p class="error">That username is already taken. Please choose another username and try again.</p>';
			} else {
				file_put_contents($file, $data, FILE_APPEND | LOCK_EX);
				mkdir ($dir . $subdir);
				$registered = TRUE;
				$_SESSION['Registered'] = time();
				$_SESSION['UserName'] = $_POST['username'];
				$_SESSION['TypeOfAccess'] = 'register';
				include("showtime-sys.php");
				exit();
			}
		} else { // Couldn't write to the file.
			print '<p class="error">You could not be registered due to a system error.</p>';
		}
	} else { // Forgot a field.
		print '<p class="error">Please try again!</p>';
	}
}

/*
 * If the user was not able to register, present them with another form ready to take their
 * information.
 */

if (!$registered) {
?>
	<form action="register-sys.php" method="post">
	<p>Username: <input type="text" name="username" size="20" /></p>
	<p>Password: <input type="password" name="password1" size="20" /></p>
	<p>Confirm Password: <input type="password" name="password2" size="20" /></p>
	<input type="submit" name="submit" value="Register" />
	</form>
	<!-- Allow the user the option of logging into the system -->
	<p>If you would you would rather login to the system, click <a href="login-sys.php">here</a></p>
<?php } // End of submission IF. ?>

</body>
</html>
