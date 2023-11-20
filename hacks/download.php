<?php 

include($_SERVER['DOCUMENT_ROOT'] . '/_includes/includes.php');

$hack_id = $_GET['hack_id'];

updateDownloadCounter($pdo, $hack_id);

$patchname = getPatchFromDatabase($pdo, $hack_id)[0]['hack_patchname'];
header("Location: /patch/" . $patchname . ".zip");
die();

?>