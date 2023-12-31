<?php

require_once $_SERVER['DOCUMENT_ROOT'].'/vendor/autoload.php';

$dotenv = Dotenv\Dotenv::createImmutable($_SERVER['DOCUMENT_ROOT']);
$dotenv->load();

define("ADMIN_NEWS", array("260945217664974860", "120084264489451520", "107568694359531520", "264457080889409536", "210326854282772480"));
//                          AndrewSM64              FrostyZako              MarvJungs               Mushie64               Tomatobird8
define("ADMIN_SITE", array("260945217664974860", "120084264489451520", "107568694359531520", "264457080889409536", "210326854282772480"));

define("DB_HOST", $_ENV["DB_HOST"]);
define("DB_USER", $_ENV["DB_USER"]);
define("DB_PASS", $_ENV["DB_PASS"]);
define("DB_NAME", $_ENV["DB_NAME"]);

define("DISCORD_CLIENT_ID", "1176646640321441802");
define("DISCORD_CLIENT_SECRET", "u5_sAUYf9d9w66ZZX2h1krOTUxtKiKol");
define("DISCORD_REDIRECT_URI", "http://localhost/login/process-oauth.php");

define("TWITCH_CLIENT_ID", "7xxy8kh0hvswrrnnpzjpej41h5qxzz");
define("TWITCH_CLIENT_SECRET", "26i3l38b88g131htepkjbn8t9rolon");

error_reporting(E_ERROR);

?>
