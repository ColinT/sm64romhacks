
<?php

include($_SERVER['DOCUMENT_ROOT'].'/_includes/functions.php');
include($_SERVER['DOCUMENT_ROOT'].'/_includes/db.php');

print(json_encode(getMegapackHacksFromDatabase($pdo)));
?>
