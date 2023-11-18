<?php

include $_SERVER['DOCUMENT_ROOT'].'/_includes/includes.php';


if(!isset($_POST['hack_name'])) {
    header("Location: /login/error.php");
    die();
}
$hack_name = ($_POST['hack_name']);
//$hack_description = nl2br($_POST['hack_description']);
$hack_description = ($_POST['hack_description']);
$hack_description = str_replace("\r\n", "<br/>", $hack_description);
$hack_description = stripChars($hack_description);
$hack_description = str_replace("&lt;br/&gt;", "<br/>", $hack_description);


updateHackInDatabase($pdo,$hack_name,$hack_description);

header("Location: /hacks/$hack_name");
die();
?>