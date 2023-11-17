<?php

include $_SERVER['DOCUMENT_ROOT'].'/_includes/includes.php';



session_start();

$hack_name = $_GET['hack_name'];

if(!isset($hack_name) || !$_SESSION['logged_in'] || !in_array($_SESSION['userData']['discord_id'], ADMIN_SITE)) {
	header("Location: /login/error.php");
	die();
}

$data = getHackFromDatabase($pdo, $hack_name);
foreach($data as $entry) {
	unlink($_SERVER['DOCUMENT_ROOT'] . '/patch/' . $entry['hack_patchname'] . '.zip');
}

deleteHackFromDatabase($pdo, $hack_name);

header("Location: /hacks");

?>