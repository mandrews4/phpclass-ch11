<!doctype html>
<html>
<head>
  <title>Directory Contents</title>
</head>
<body>
	<?php // Script 11.5 - list_dir.php
	$search_dir = '../../../../uploads';
	if (is_writable($search_dir)) {
		$contents = scandir($search_dir);
		print '<h2>Directories</h2><ul>';
		foreach ($contents as $item) {
			if ( (is_dir($search_dir . '/' . $item)) AND (substr($item, 0, 1) != '.') ) {
				print "<li>$item</li>\n";
			}
		}
		print '</ul>';
		print '<hr /><h2>Files</h2><table cellpadding="2" cellspacing="2" align="left">
		<tr>
		<td>Name</td>
		<td>Size</td>
		<td>Last Modified</td>
		<td>Last Accessed</td>
		<td>Permissions</td>
		</tr>';
		foreach ($contents as $item) {
			if ( (is_file($search_dir . '/' . $item)) AND (substr($item, 0, 1) != '.') ) {
				$fs = filesize($search_dir . '/' . $item);
				$lm = date('F j, Y', filemtime($search_dir . '/' . $item));
				$la = date('F j, Y', fileatime($search_dir . '/' . $item));
				$fp = fileperms($search_dir . '/' . $item);
				print "<tr>
				<td>$item</td>
				<td>$fs bytes</td>
				<td>$lm</td>
				<td>$la</td>
				<td>$fp</td>

				</tr>\n";
			}
		}
		print '</table>';
	} else {
		print '<p style="color: red;">The contents of the directory could not be listed due to a system error.</p>';
	}
	?>
</body>
</html>
