<?php
    include($_SERVER['DOCUMENT_ROOT'] . '/_includes/includes.php');

    if(!$_SESSION['logged_in'] || !in_array($_SESSION['userData']['discord_id'], ADMIN_SITE)) {
        print(json_encode(http_response_code(403)));
    }
    else {
        print(json_encode(getAllPendingHacksFromDatabase($pdo)));
    }
?>