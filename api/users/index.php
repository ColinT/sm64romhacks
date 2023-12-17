<?php	

	include($_SERVER['DOCUMENT_ROOT'] . "/_includes/includes.php");

    print(json_encode(getAllUsersFromDatabase($pdo)));
