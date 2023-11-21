<?php

include $_SERVER['DOCUMENT_ROOT'].'/_includes/includes.php';

$hack_name = $_GET['hack_name'];
$hack_id = intval($_GET['hack_id']);

if(!isset($hack_name) && $hack_id == 0 || (isset($hack_name) && $hack_id != 0) || !$_SESSION['logged_in'] || !in_array($_SESSION['userData']['discord_id'], ADMIN_SITE)) {
	header("Location: /login/error.php");
	die();
}

if(isset($hack_name)) {
	$data = getHackFromDatabase($pdo, $hack_name);
	foreach($data as $entry) {
	unlink($_SERVER['DOCUMENT_ROOT'] . '/patch/' . $entry['hack_patchname'] . '.zip');
	}	
	deleteHackFromDatabase($pdo, $hack_name);
	header("Location: /hacks");

}

else {
	$data = getPatchFromDatabase($pdo, $hack_id);
	$hack_patchname = $data[0]['hack_patchname'];
	unlink($_SERVER['DOCUMENT_ROOT'] . '/patch/' . $hack_patchname . '.zip');
	deletePatchFromDatabase($pdo, $hack_id);
	header("Location: /hacks/" .  getURLEncodedName($data[0]['hack_name']));
}


?>