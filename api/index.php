
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

if(isset($_GET['images'])) {
    $hack_name = $_GET['images'];
    $images = (glob($_SERVER['DOCUMENT_ROOT'] . "/_assets/_img/hacks/img_" . stripChars($hack_name) . "_*.{png,jpg}", GLOB_NOSORT|GLOB_BRACE));
    $image =explode("/",$image)[sizeof(explode("/",$image)) - 1];
    $images = array_map(fn($image) => explode("/",$image)[sizeof(explode("/",$image)) - 1], $images);
    print(json_encode($images));
}

$user_id = $_GET['user_id'];
if(isset($user_id)) print(json_encode(getUserFromDatabase($pdo, $user_id)));


?>
