<!doctype html>
<html>
<head>
  <title>View a Quotation</title>
</head>
<body>
	<h1>Random Quotation</h1>
	<?php // Script 11.3 - view_quote.php
	$data = file('../../../../quotes.txt');
	$n = count($data);
	$rand = rand(0, ($n - 1));
	/*
	 * After reading the contents of the file into the $data array,
	 * retrieve a random line from the array and explode/split into
	 * the $quotation and $attribution scalars.
	 *
	 * Each of those variables is encoded in base64, so we decode each
	 * back to normal text and print the value.
	 */
	list($quotation, $attribution) = explode("\t", $data[$rand]);
	print '<p>Quotation: ' . base64_decode($quotation) . '<br/>';
	print 'Attribution: ' . base64_decode($attribution) . '</p>';
	?>
</body>
</html>
