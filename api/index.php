
<?php

include($_SERVER['DOCUMENT_ROOT'] . "/_includes/includes.php");

if(isset($_GET['hack_name'])) {
    $hack_name = getURLDecodedName($_GET['hack_name']);
    $user_id = $_SESSION['userData']['discord_id'];
    $is_Admin = in_array($user_id, ADMIN_SITE) ? true : false;

    if($hack_name == 'all') {
        print(json_encode(array("hacks" => getAllUniqueHacksFromDatabase($pdo), "tags" => getAllTagsFromDatabase($pdo), "user" => array("logged_in" => $_SESSION['logged_in'] ,"admin" => $is_Admin))));
    }
    else {
        $images = (glob($_SERVER['DOCUMENT_ROOT'] . "/_assets/_img/hacks/img_" . stripChars(getURLDecodedName($hack_name)) . "_*.{png,jpg}", GLOB_NOSORT|GLOB_BRACE));
        $images = array_map(fn($image) => explode("/",$image)[sizeof(explode("/",$image)) - 1], $images);
    
        print(json_encode(array("patches" => getHackFromDatabase($pdo, $hack_name), "images" => $images, "admin" => $is_Admin)));
    }
}

else if(isset($_GET['hack_id'])) {
    $hack_id = intval($_GET['hack_id']);
    print(json_encode(getPatchFromDatabase($pdo, $hack_id)));
}

?>
