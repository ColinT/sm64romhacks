<?php
$discord_url = "https://discord.com/api/oauth2/authorize?client_id=1176646640321441802&response_type=code&redirect_uri=https%3A%2F%2Ftest.sm64romhacks.com%2Flogin%2Fprocess-oauth.php&scope=identify+email";
//$discord_url = "https://discord.com/api/oauth2/authorize?client_id=1171219678132195419&redirect_uri=http%3A%2F%2Flocalhost%2Flogin%2Fprocess-oauth.php&response_type=code&scope=identify%20email";
header("Location: $discord_url");
exit();
?>