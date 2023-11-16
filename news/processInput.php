<?php

include $_SERVER['DOCUMENT_ROOT'].'/_includes/includes.php';


session_start();

$post_author = $_SESSION['userData']['discord_id'];
$post_title = stripChars($_POST['post_title']);
$post_text = stripChars($_POST['post_text']);

if(!$_SESSION['logged_in'] || !in_array($_SESSION['userData']['discord_id'], ADMIN_NEWS) || !isset($post_title) || !isset($post_text)) {
    header("Location: /login/error.php");
    die();
}


addNewspostToDatabase($pdo, $post_title, $post_text, $post_author);

header("Location: /");
die();
?>

