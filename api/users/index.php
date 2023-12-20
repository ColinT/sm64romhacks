<?php	

	include($_SERVER['DOCUMENT_ROOT'] . "/_includes/includes.php");

    if(isset($_GET['user_name'])) {
        $user_name = $_GET['user_name']; 
        print(json_encode(getHacksByUserFromDatabase($pdo, $user_name)));
    }

    else {
        if(!filter_var($_COOKIE['logged_in'], FILTER_VALIDATE_BOOLEAN) || !in_array($_COOKIE['discord_id'], ADMIN_SITE)) {
            print(json_encode(http_response_code(403)));
        }
        else {
            print(json_encode(getAllUsersFromDatabase($pdo)));
        }
    }
