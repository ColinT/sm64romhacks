<?php
session_start();
if(!$_SESSION['logged_in']) header("Location: init-oauth.php");
else {header("Location: dashboard.php");}
die();
?>