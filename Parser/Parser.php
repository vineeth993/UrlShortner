<?php

	include '../config.php';
	include '../UrlShortner.php';

	$code = $_GET["string"];
	if (strlen($code) != 6){
		echo "Page Not found";
		return;
	}
	$urlParser = new UrlShortnerClass($db_host, $db_user, $db_password, $db_name);

	$mainUrl = $urlParser->gerUrl($code);
	if ($mainUrl){
		header("Location: " . $mainUrl);
	}
	else{
		echo "Page Not found";
		return;
	}
?>