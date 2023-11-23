<?php
include $_SERVER['DOCUMENT_ROOT'].'/_includes/includes.php';
createUsersDatabase($pdo);


if(!isset($_GET['code'])){
    echo 'no code';
    exit();
}

$discord_code = $_GET['code'];


$payload = [
    'code'=>$discord_code,
    'client_id'=>DISCORD_CLIENT_ID,
    'client_secret'=>DISCORD_CLIENT_SECRET,
    'grant_type'=>'authorization_code',
    'redirect_uri'=>DISCORD_REDIRECT_URI,
    'scope'=>'identify%20guids',
];

print_r($payload);

$payload_string = http_build_query($payload);
$discord_token_url = "https://discordapp.com/api/oauth2/token";

$ch = curl_init();

curl_setopt($ch, CURLOPT_URL, $discord_token_url);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, $payload_string);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);

$result = curl_exec($ch);

if(!$result){
    echo curl_error($ch);
}

$result = json_decode($result,true);
$access_token = $result['access_token'];

$discord_users_url = "https://discordapp.com/api/users/@me";
$header = array("Authorization: Bearer $access_token", "Content-Type: application/x-www-form-urlencoded");

$ch = curl_init();
curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
curl_setopt($ch, CURLOPT_URL, $discord_users_url);
curl_setopt($ch, CURLOPT_POST, false);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);

$result = curl_exec($ch);

$userData = json_decode($result,true);

$user_data = getUserFromDatabase($pdo,$userData['id']);

if(!$user_data){
    addUserToDatabase($pdo,$userData['id'],$userData['avatar'],$userData['email'],$userData['global_name']);
}
else {
    updateUserInDatabase($pdo,$userData['id'],$userData['avatar'],stripChars($userData['email']),stripChars($userData['global_name']));
}

$_SESSION['logged_in'] = true;
$_SESSION['userData'] = [
    'discord_id'=>$userData['id'],
    'name'=>stripChars($userData['username']),
    'avatar'=>$userData['avatar'],
    'email'=>stripChars($userData['email']),
    'global_name'=>stripChars($userData['global_name'])
];
header("Location: " . $_SESSION['redirect']);
exit();

?>