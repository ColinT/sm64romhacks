<?php

include $_SERVER['DOCUMENT_ROOT'].'/_includes/includes.php';

$hack_name = stripChars(getURLDecodedName($_GET['hack_name']));
$hack_id = intval($_GET['hack_id']);

$twitch_handle = strtolower($_COOKIE['twitch_handle']);
$name = strtolower($_COOKIE['name']);
$authors_patch = strtolower(getPatchFromDatabase($pdo, $hack_id)[0]['authors']);
$authors_hack = strtolower(getHackFromDatabase($pdo, $hack_name)[0]['authors']);

$is_author = isUserAuthor($authors_patch) || isUserAuthor(($authors_hack));
if(strlen($hack_name) == 0 && $hack_id == 0 || strlen($hack_name) != 0 && $hack_id != 0 || !filter_var($_COOKIE['logged_in'], FILTER_VALIDATE_BOOLEAN) || (!$is_author && !in_array($_COOKIE['discord_id'], ADMIN_SITE))) {
    header("Location: /hacks/" . getURLEncodedName($hack_name));
	die();
}

if(strlen($hack_name) != 0) {
	$data = getHackFromDatabase($pdo, $hack_name);
	$img_name = stripChars(getURLDecodedName($hack_name));
    $img_name = str_replace(':', '_', $img_name);
    $images = (glob($_SERVER['DOCUMENT_ROOT'] . "/api/images/img_" . $img_name . "_*.{png,jpg}", GLOB_NOSORT|GLOB_BRACE));
    $images = array_map(fn($image) => explode("/",$image)[sizeof(explode("/",$image)) - 1], $images);

	foreach($images as $image) {
		unlink($_SERVER['DOCUMENT_ROOT'] . '/api/images/' . $image);
	}


	foreach($data as $entry) {
		deleteHackAuthorFromDatabase($pdo, $entry['hack_id']);
		unlink($_SERVER['DOCUMENT_ROOT'] . '/patch/' . $entry['hack_patchname'] . '.zip');
		deletePatchFromDatabase($pdo, $entry['hack_id']);
	}	
	unlink($_SERVER['DOCUMENT_ROOT'] . '/api/images/logo_' . getURLEncodedName($hack_name) . '.jpg');
	header("Location: /hacks");
}

else {
	$data = getPatchFromDatabase($pdo, $hack_id);
	$hack_patchname = $data[0]['hack_patchname'];
	unlink($_SERVER['DOCUMENT_ROOT'] . '/patch/' . $hack_patchname . '.zip');
	deleteHackAuthorFromDatabase($pdo, $hack_id);
	deletePatchFromDatabase($pdo, $hack_id);
	header("Location: /hacks/" .  getURLEncodedName($data[0]['hack_name']));
}
?>