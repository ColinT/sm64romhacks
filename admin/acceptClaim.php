<?php
include $_SERVER['DOCUMENT_ROOT'].'/_includes/includes.php';
session_start();

$claim_id = intval($_GET['claim_id']);

if($claim_id == 0 | !$_SESSION['logged_in'] || !in_array($_SESSION['userData']['discord_id'], ADMIN_NEWS)) {
	header("Location: /login/error.php");
	die();
}


$claim = getClaimsFromDatabase($pdo, $claim_id);
$user_id = $claim[0]['user_id'];
$hack_id = intval($claim[0]['hack_id']);
$claimed_author = $claim[0]['claimed_author'];

$hack = getPatchFromDatabase($pdo, $hack_id)[0];
$hack_name = $hack['hack_name'];
$hack_version = $hack['hack_version'];
$hack_author = $hack['hack_author'];
$hack_starcount = $hack['hack_starcount'];
$hack_release_date = $hack['hack_release_date'];
$hack_tags = $hack['hack_tags'];

$hack_author = str_replace($claimed_author, $user_id, $hack_author);

updatePatchInDatabase($pdo,$hack_id,$hack_name,$hack_version,$hack_author,$hack_starcount,$hack_release_date,$hack_tags);


deleteClaimFromDatabase($pdo, $claim_id);

header("Location: /admin");
die();
?>