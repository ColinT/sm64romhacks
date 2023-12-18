<?php	

	include($_SERVER['DOCUMENT_ROOT'] . "/_includes/includes.php");

    if(isset($_GET['user_name'])) {
        $user_name = $_GET['user_name']; 
        print(json_encode(getHacksByUserFromDatabase($pdo, $user_name)));
    }

    else {
        print(json_encode(getAllUsersFromDatabase($pdo)));
    }
