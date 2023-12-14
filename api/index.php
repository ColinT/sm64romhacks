
<?php

include($_SERVER['DOCUMENT_ROOT'] . "/_includes/includes.php");

if(isset($_GET['hack_name'])) {
    $hack_name = getURLDecodedName($_GET['hack_name']);
    if($hack_name == 'all') {
        print(json_encode(getAllUniqueHacksFromDatabase($pdo)));
    }
    else {
        print(json_encode(getHackFromDatabase($pdo, $hack_name)));
    }
}

if(isset($_GET['images'])) {
    $hack_name = $_GET['images'];
    $images = (glob($_SERVER['DOCUMENT_ROOT'] . "/_assets/_img/hacks/img_" . stripChars(getURLEncodedName($hack_name)) . "_*.{png,jpg}", GLOB_NOSORT|GLOB_BRACE));
    $images = array_map(fn($image) => explode("/",$image)[sizeof(explode("/",$image)) - 1], $images);
    print(json_encode($images));
}

if(isset($_GET['check'])) {
    $user_id = $_SESSION['userData']['discord_id'];
    if(in_array($user_id, ADMIN_SITE)) {print(json_encode(true));} else {print(json_encode(false));}
}


?>
