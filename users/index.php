<?php

include $_SERVER['DOCUMENT_ROOT'].'/_includes/includes.php';

$path = ltrim($_SERVER['REQUEST_URI'], '/');
$user_id = explode('/', $path);
$user_id = $user_id[1];
if(strlen($user_id) == 0) {
	header("Location: /404.php");
	die();
}
else {
	$data = getHackByUserFromDatabase($pdo, $user_id);
	if(sizeof($data) == 0) {
		header("Location: /404.php");
		die();
	}
	include("template.php");
}
?>