<?php

include $_SERVER['DOCUMENT_ROOT'].'/_includes/includes.php';

$post_author = $_SESSION['userData']['discord_id'];
$post_title = stripChars($_POST['post_title']);
$post_text = $_POST['post_text'];
$post_text = str_replace("\r\n", " <br/>", $post_text);
$post_text = stripChars($post_text);
$post_text = str_replace("&lt;br/&gt;", "<br/>", $post_text);


if(!$_SESSION['logged_in'] || !in_array($_SESSION['userData']['discord_id'], ADMIN_NEWS) || !isset($post_title) || !isset($post_text)) {
    header("Location: /");
    die();
}


addNewspostToDatabase($pdo, $post_title, $post_text, $post_author);

header("Location: /");
die();
?>

