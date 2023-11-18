<?php

include $_SERVER['DOCUMENT_ROOT'].'/_includes/includes.php';

$hack_id = intval($_POST['hack_id']);
$hack_description = $_POST['hack_description'];


if(!isset($hack_description) && $hack_id == 0) {
    header("Location: /login/error.php");
    die();
}

if(isset($hack_description)) {
    $hack_name = ($_POST['hack_name']);
    $hack_description = str_replace("\r\n", "<br/>", $hack_description);
    $hack_description = stripChars($hack_description);
    $hack_description = str_replace("&lt;br/&gt;", "<br/>", $hack_description);
    updateHackInDatabase($pdo,$hack_name,$hack_description);

}
else {
    $hack_name = $_POST['hack_name'];
    $hack_version = $_POST['hack_version'];
    $hack_author = $_POST['hack_author'];
    $hack_starcount = $_POST['hack_starcount'];
    $hack_release_date = $_POST['hack_release_date'];
    $hack_tags = $_POST['hack_tags'];

    updatePatchInDatabase($pdo, $hack_id, $hack_name, $hack_version, $hack_author, $hack_starcount, $hack_release_date, $hack_tags);

}

header("Location: /hacks/" . getURLEncodedName($hack_name));
die();
?>