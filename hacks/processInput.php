<?php

include $_SERVER['DOCUMENT_ROOT'].'/_includes/includes.php';


session_start();

if(sizeof($_POST) == 0) header("Location: /login/error.php"); die();

$hack_name = $_POST['hack_name'];
$hack_version = $_POST['hack_version'];
$hack_author = $_POST['hack_author'];
$hack_starcount = isset($_POST['hack_amount']) ? intval($_POST['hack_amount']) : 0;
$hack_release_date = $_POST['hack_release_date'];
$hack_patchname = $_FILES['hack_patchname']["name"];
$hack_tags = $_POST['hack_tags'];
$hack_description = $_POST['hack_description'];

$result = move_uploaded_file($_FILES['hack_patchname']['tmp_name'], $_SERVER['DOCUMENT_ROOT'].'/patch/'.$hack_patchname);
$hack_patchname = substr($hack_patchname, 0, -4);
//if(!$result) {header("Location: /404.php"); die();}
if(!$_SESSION['logged_in'] || !in_array($_SESSION['userData']['discord_id'], ADMIN_SITE) || !isset($hack_name) || !isset($hack_version)) {
    //header("Location: /login/error.php");
    //die();
}


//addHackToDatabase($pdo, $hack_name, $hack_version, $hack_author, $hack_starcount, $hack_release_date, $hack_patchname, $hack_tags, $hack_description);

//header("Location: /");
//die();
?>

