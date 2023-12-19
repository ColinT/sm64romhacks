<?php

include $_SERVER['DOCUMENT_ROOT'].'/_includes/includes.php';

$hack_name = stripChars(getURLDecodedName($_GET['hack_name']));
$hack_id = intval($_GET['hack_id']);

$is_author = str_contains(getPatchFromDatabase($pdo, $hack_id)[0]['hack_author'], $_SESSION['userData']['discord_id']) || str_contains(getHackFromDatabase($pdo, $hack_name)[0]['hack_author'], $_SESSION['userData']['discord_id']);
if(strlen($hack_name) == 0 && $hack_id == 0 || strlen($hack_name) != 0 && $hack_id != 0 || !$_SESSION['logged_in'] || (!$is_author && !in_array($_SESSION['userData']['discord_id'], ADMIN_SITE))) {
	header("Location: /404.php");
	die();
}

if(strlen($hack_name) != 0) {
	$data = getHackFromDatabase($pdo, $hack_name);
	$img_name = stripChars(getURLDecodedName($hack_name));
    $img_name = str_replace(':', '_', $img_name);
    $images = (glob($_SERVER['DOCUMENT_ROOT'] . "/_assets/_img/hacks/img_" . $img_name . "_*.{png,jpg}", GLOB_NOSORT|GLOB_BRACE));
    $images = array_map(fn($image) => explode("/",$image)[sizeof(explode("/",$image)) - 1], $images);

	foreach($images as $image) {
		unlink($_SERVER['DOCUMENT_ROOT'] . '/_assets/_img/hacks/' . $image);
	}


	foreach($data as $entry) {
		deleteHackAuthorFromDatabase($pdo, $entry['hack_id']);
		unlink($_SERVER['DOCUMENT_ROOT'] . '/patch/' . $entry['hack_patchname'] . '.zip');
		deletePatchFromDatabase($pdo, $entry['hack_id']);
	}	
	unlink($_SERVER['DOCUMENT_ROOT'] . '/_assets/_img/hacks/logo_' . getURLEncodedName($hack_name) . '.jpg');
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