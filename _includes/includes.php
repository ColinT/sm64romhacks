<?php
include($_SERVER['DOCUMENT_ROOT'].'/_includes/functions.php');
include($_SERVER['DOCUMENT_ROOT'].'/_includes/db.php');

createUsersDatabase($pdo);
createNewspostDatabase($pdo);
createClaimsDatabase($pdo);
createHacksDatabase($pdo);
createAuthorsDatabase($pdo);
createHackAuthorsDatabase($pdo);


session_start();


?>