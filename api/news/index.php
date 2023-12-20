<?php

include($_SERVER['DOCUMENT_ROOT'] . "/_includes/includes.php");

if(isset($_GET['id'])) {
    print(json_encode(getNewspostFromDatabase($pdo, intval($_GET['id']))));
}

else {
    print(json_encode(array("news" => getAllNewspostsFromDatabase($pdo), "admin" => filter_var($_COOKIE['logged_in'], FILTER_VALIDATE_BOOLEAN) && in_array($_COOKIE['discord_id'], ADMIN_NEWS), "user_id" => $_COOKIE['discord_id'])));
}


?>