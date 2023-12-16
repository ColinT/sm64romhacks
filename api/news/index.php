<?php

include($_SERVER['DOCUMENT_ROOT'] . "/_includes/includes.php");

if(isset($_GET['id'])) {
    print(json_encode(getNewspostFromDatabase($pdo, intval($_GET['id']))));
}

else {
    print(json_encode(array("news" => getAllNewspostsFromDatabase($pdo), "admin" => $_SESSION['logged_in'] && in_array($_SESSION['userData']['discord_id'], ADMIN_NEWS), "user_id" => $_SESSION['userData']['discord_id'])));
}


?>