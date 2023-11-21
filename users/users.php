<?php

include $_SERVER['DOCUMENT_ROOT'].'/_includes/includes.php';


if($_SESSION['logged_in']) extract($_SESSION['userData']);

if(!$_SESSION['logged_in'] || !in_array($_SESSION['userData']['discord_id'], ADMIN_SITE)) {
	header("Location: /404.php");
	die();
}


$all_users = getAllUsersFromDatabase($pdo);
$usersMarkup='';

foreach ($all_users as $key => $userData) {
    $usersMarkup.='<tr>
    <td><img src="https://cdn.discordapp.com/avatars/'.$userData['discord_id'].'/'.$userData['discord_avatar'].'.jpg"/ height=32 width=32></td>
    <td><a href="'.$userData['discord_id'] .'">'.$userData['discord_id'].'</a></td>    
    <td>'.$userData['discord_username'].'</td>
    <td>'.$userData['discord_email'].'</td>
    <td>'.$userData['created_at'].'</td>
    </tr>'
;}

?>
<!DOCTYPE HTML>
<html>
	<!--BEGINNING OF HEAD-->
	<head>
		<title>sm64romhacks - Users</title> <!--CHANGE TITLE-->
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<meta name="keywords" content="super mario, romhacks, hack, speedrun, sm64hacks, sm64romhacks, rom, modification" />
		<meta name="description" content="Welcome to SM64ROMHacks! We have a really big collection of SM64 ROM Hacks which wait to be played! Community News/Events will also be tracked here" />
		<link rel="stylesheet" type="text/css" href="/_css/bootstrap.css">
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
		<link rel="shortcut icon" href="/_img/icon.ico" />
		<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
	</head>
<body>
    <div class="container">
    <?php include($_SERVER['DOCUMENT_ROOT'].'/_includes/header.php'); ?>
        <div align="center">
            <h3>Users:</h3>
            <table class="table table-bordered">
                <tr><td>Profile Picture</td><td>ID</td><td>Username</td><td>E-Mail</td><td>Created at</tr>
            <?php echo $usersMarkup;?>
</table>
<?php include($_SERVER['DOCUMENT_ROOT'].'/_includes/footer.php'); ?>
    </div></div>
</body>
</html>