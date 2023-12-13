
<?php

include($_SERVER['DOCUMENT_ROOT'] . "/_includes/includes.php");

if(isset($_GET['hack_name'])) {
    $hack_name = $_GET['hack_name'];
    if($hack_name == 'all') {
        print(json_encode(getAllUniqueHacksFromDatabase($pdo)));
    }
    else {
        print(json_encode(getHackFromDatabase($pdo, $hack_name)));
    }
}

$user_id = $_GET['user_id'];
if(isset($user_id)) print(json_encode(getUserFromDatabase($pdo, $user_id)));


?>
