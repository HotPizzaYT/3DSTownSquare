<?php
session_start();
include("../../detect.php");
if($isDSi){
	$cheight = "132";
} else {
	$cheight = "240";
}
?>
<!DOCTYPE html>
<html>
	<head>
		<meta name="viewport" content="width=<?php echo $width; ?>">
		<style>
			body {
				width: <?php echo $width; ?>px;
			}
			.main {
				width: <?php echo $width; ?>px;
			}
		</style>
		<script></script>
	</head>
	<body>
	<h1>Coming Soon</h1>
	<span style="color: grey">LiveType is coming soon...</span>
	<br>
	<span style="font-weight: bold;"><strong>Test</strong></span>
	</body>
</html>