<?php

include $_SERVER['DOCUMENT_ROOT'].'/_includes/includes.php';



session_start();

$post_id = intval($_GET['id']);

if($post_id == 0 || !$_SESSION['logged_in'] || !in_array($_SESSION['userData']['discord_id'], ADMIN_SITE)) {
	header("Location: /login/error.php");
	die();
}

deleteNewspostFromDatabase($pdo, $post_id);

header("Location: /news");

?>