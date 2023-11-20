<?php 

    if(intval($_POST['hack_id']) == 0) header("Location: /hacks");
    
    session_start();
    include $_SERVER['DOCUMENT_ROOT'].'/_includes/includes.php';

    $hack_id = $_POST['hack_id'];
    $user_id = $_SESSION['userData']['discord_id'];
    $claimed_author = $_POST['hack_author_claim'];

    var_dump($hack_id, $user_id, $claimed_author);

    createClaimsDatabase($pdo);
    addClaimToDatabase($pdo, $hack_id, $user_id, $claimed_author);

    header("Location: /hacks");
?>