<?php

include $_SERVER['DOCUMENT_ROOT'].'/_includes/includes.php';

if(!isset($_POST['post_id'])) {
    header("Location: /");
    die();
}
$post_title = stripChars($_POST['post_title']);
$post_text = stripChars($_POST['post_text']);
$post_id = intval($_POST['post_id']);

updateNewspostInDatabase($pdo,$post_id,$post_title,$post_text);

header("Location: /");
die();
?>