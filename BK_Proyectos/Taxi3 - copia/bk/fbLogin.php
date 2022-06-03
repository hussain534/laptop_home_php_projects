<?php
	require_once __DIR__ . '/fb/src/Facebook/autoload.php';
	session_start();
	$fb = new Facebook\Facebook([
	'app_id' => '1564307063870897', // Replace {app-id} with your app id
	'app_secret' => '8c71460b89a915bc85f77129f7a21e17',
	'default_graph_version' => 'v2.2',
	]);

	$helper = $fb->getRedirectLoginHelper();

	$permissions = ['email']; // Optional permissions
	$loginUrl = $helper->getLoginUrl('http://hutesol.com/fb-callback.php', $permissions);

	echo '<a href="' . htmlspecialchars($loginUrl) . '">Log in with Facebook!</a>';
?>