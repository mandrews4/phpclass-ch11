<!doctype html>
<html>
<head>
    <title>Add a Quotation</title>
</head>
<body>
  <?php // Script 11.2 - add_quote.php
	$file = '../../../../quotes.txt';
	if ($_SERVER['REQUEST_METHOD'] == 'POST') {
		if ( !empty($_POST['quote']) && ($_POST['quote'] != 'Enter your quotation here.') ) {
			if ( !empty($_POST['attribution'])) {
				if (file_exists($file)) {
					if (is_writable($file)) {
						/*
						 * Append the user-provided quotation & attribution to the quotes file, separated by a tab.
						 *
						 * Both the quotation and attribution are encoded in base64 to remove all spaces and ease
						 * parsing of the file
						*/
						file_put_contents($file, base64_encode($_POST['quote']) . "\t", FILE_APPEND | LOCK_EX);
						file_put_contents($file, base64_encode($_POST['attribution']) . PHP_EOL, FILE_APPEND | LOCK_EX);
						print '<p>Your quotation has been stored.</p>';
					} else { // Could not open the file.
						print '<p style="color: red;">Your quotation could not be stored due to a system error.</p>';
					}
				} else { // file does not exist
					print '<p style="color: red;">Your quotation could not be stored due to a system error.</p>';
				}
			} else { // Failed to enter an attribution
				print '<p style="color: red;">Please enter a attribution!</p>';
			}
		} else { // Failed to enter a quotation.
					print '<p style="color: red;">Please enter a quotation!</p>';
		}
	} // End of submitted IF.
	?>

	<form action="add_quote.php" method="post">
	<textarea name="quote" rows="5" cols="30"><?php if (!empty($_POST['quote'])) { print $_POST['quote']; } else { print "Enter your quotation here."; } ?></textarea><br />
	Who said it?: <input type="text" name="attribution" size="30"></input><br />
	<input type="submit" name="submit" value="Add This Quote!" />
	<input type="hidden" name="submitted" value="true" />
	</form>
</body>
</html>
