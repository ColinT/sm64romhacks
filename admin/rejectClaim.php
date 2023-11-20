<?php
include $_SERVER['DOCUMENT_ROOT'].'/_includes/includes.php';
session_start();
if(!$_SESSION['logged_in'] || !in_array($_SESSION['userData']['discord_id'], ADMIN_NEWS)) {
	header("Location: /login/error.php");
	die();
}


$claim_id = intval($_GET['claim_id']);

deleteClaimFromDatabase($pdo, $claim_id);

header("Location: /admin");
die();
?>