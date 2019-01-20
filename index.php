<?php
 	include 'config.php';
 	include 'UrlShortner.php';
 	$shortner = new UrlShortnerClass($db_host, $db_user, $db_password, $db_name);
	if(isset($_POST['submit'])){
		if (isset($_POST['url'])){
			$shortCode = $shortner->generateHashKey($_POST['url'],6, $main_url); 
		}
	}
?>


<html>
	<head>
		<title>Url Shortner</title>
	</head>
	<body>
		<form name="url_shortner" action="" method="post">
			<input type="text" name="url"/>
			<input type="submit" name="submit"/>
		</form>
		<p>Short Url: <strong><?php echo $shortCode?></strong></p>
	</body>
</html>