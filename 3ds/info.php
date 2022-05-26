
<?php
include("../detect.php");
?>
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
</head>
<?php
echo phpinfo();
?>