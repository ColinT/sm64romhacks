<?php


session_start();
session_destroy();
header("Location: /faq/index.php");
exit();
?>