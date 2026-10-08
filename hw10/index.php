<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>PHP Test</title>
</head>
<body>
	<p>Welcome to my php homepage!</p>
	<?php
		$username="admin";
		$password="hiddenpw";
		$host="someHost";
		$today=date("F j, Y");
		echo "<p>Today is $today</p>";
	?>
</body>
</html>