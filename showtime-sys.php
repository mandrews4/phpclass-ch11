<?php
/*
 * If $_SESSION['TypeOfAccess'] is equal to "login", congratulate the user for logging
 * in using other session data.
 */
  print '<p>Congratuations ';
	if (isset($_SESSION['TypeOfAccess']) AND $_SESSION['TypeOfAccess'] == "login") {
		$time_logged_in = $_SESSION['LoggedIn'];
		$username = $_SESSION['UserName'];
		print "$username, you logged in at " . date(DATE_COOKIE, $time_logged_in) . '.</p>';
	}

/*
 * If $_SESSION['TypeOfAccess'] is equal to "register", congratulate the user for registering
 * with the system, using other session data.
 */
	if (isset($_SESSION['TypeOfAccess']) AND $_SESSION['TypeOfAccess'] == "register") {
		$time_logged_in = $_SESSION['Registered'];
		$username = $_SESSION['UserName'];
		print "$username, you successfully registered at " . date(DATE_COOKIE, $time_logged_in) . '.</p>';
	}
?>

<!-- Offer the user the option of logging into the system or registering another user -->
<p>If you would like to login to the system, click <a href="login-sys.php">here</a></p>
<p>If you would like to register another user, click <a href="register-sys.php">here</a></p>
