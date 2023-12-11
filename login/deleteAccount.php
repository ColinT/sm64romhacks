<?php

include $_SERVER['DOCUMENT_ROOT'].'/_includes/includes.php';


$patches = getPatchesByUserFromDatabase($pdo, $_SESSION['userData']['discord_id']);

foreach($patches as $patch) {
    $hack_id = $patch['hack_id'];
    $hack_name = $patch['hack_name'];
    $hack_version = $patch['hack_version'];
    $hack_author = $patch['hack_author'];
    $hack_starcount = $patch['hack_starcount'];
    $hack_release_date = $patch['hack_release_date'];
    $hack_verified = $patch['hack_verified'];

    $hack_author = str_replace($_SESSION['userData']['discord_id'], $_SESSION['userData']['global_name'], $hack_author);

    updatePatchInDatabase($pdo,$hack_id,$hack_name,$hack_version,$hack_author,$hack_starcount,$hack_release_date,$hack_verified);
}

deleteUserFromDatabase($pdo, $_SESSION['userData']['discord_id']);
session_destroy();
header("Location: " . $_SESSION['redirect']);
die();
?>
