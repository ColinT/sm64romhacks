<?php
$discord_url = "https://discord.com/api/oauth2/authorize?client_id=1176646640321441802&response_type=code&redirect_uri=http%3A%2F%2Flocalhost%2Flogin%2Fprocess-oauth.php&scope=identify+email+connections";
header("Location: $discord_url");
exit();
?>