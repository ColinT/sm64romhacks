<?php

include($_SERVER['DOCUMENT_ROOT'] . "/_includes/includes.php");

print(json_encode(array("news" => getAllNewspostsFromDatabase($pdo), "admin" => $_SESSION['logged_in'] && in_array($_SESSION['userData']['discord_id'], ADMIN_NEWS), "user_id" => $_SESSION['userData']['discord_id'])));

?>