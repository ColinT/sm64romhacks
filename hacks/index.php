<?php

include $_SERVER['DOCUMENT_ROOT'].'/_includes/includes.php';
createHacksDatabase($pdo);
createAuthorsDatabase($pdo);
createHackAuthorsDatabase($pdo);

$path = ltrim($_SERVER['REQUEST_URI'], '/');
$hack_name = explode('/', $path);
$hack_name = $hack_name[1];

if(strlen($hack_name) == 0) {
	include("home.php");
}
else {
	$hack_name = getURLDecodedName($hack_name);
	$data = getHackFromDatabase($pdo, $hack_name);
	if(sizeof($data) == 0) {
		header("Location: /hacks");
		die();
	}
	include("template.php");
}
?>

