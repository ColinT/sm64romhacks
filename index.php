<?php

include $_SERVER['DOCUMENT_ROOT'].'/_includes/includes.php';

createUsersDatabase($pdo);
createNewspostDatabase($pdo);
createHacksDatabase($pdo);
createClaimsDatabase($pdo);
?>

<!DOCTYPE HTML>
<html>
	<!--BEGINNING OF HEAD-->
	<head>
		<title>sm64romhacks - News</title> <!--CHANGE TITLE-->
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<meta name="keywords" content="super mario, romhacks, hack, speedrun, sm64hacks, sm64romhacks, rom, modification" />
		<meta name="description" content="Welcome to SM64ROMHacks! We have a really big collection of SM64 ROM Hacks which wait to be played! Community News/Events will also be tracked here" />
		<link rel="stylesheet" type="text/css" href="/_assets/_css/bootstrap.css">
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
		<link rel="shortcut icon" href="/_assets/_img/icon.ico" />
		<script src="index.js"></script>
		<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
	</head>
	<body>		<div class="container">
			<?php include $_SERVER['DOCUMENT_ROOT'].'/_includes/header.php'; ?>
			<div align="center">
				<!--HTML CONTENT HERE-->
				<?php
				if($_SESSION['logged_in']) $user_id = $_SESSION['userData']['discord_id'];

				if($_SESSION['logged_in'] && in_array($user_id, ADMIN_NEWS)){
					print("<a href=\"/news/addNews.php\" class=\"btn btn-primary\">Add Newspost!</a><br/><br/>");
				}
				?>
				<?php $newsposts = getAllNewspostsFromDatabase($pdo); ?>
				<?php foreach($newsposts as $newspost) { 
					$newspost_id = $newspost['post_id'];
					print("<div class=\"bg-dark\">");
					$author_id = $newspost['post_author'];
					$title = $newspost['post_title'];
					$created_at = $newspost['created_at'];
					$edited_at = $newspost['edited_at'];
					$user = getUserFromDatabase($pdo, $author_id);
					$avatar = $user['discord_avatar'];
					$username = $user['discord_username']; 
					$text = $newspost['post_text'];
					$avatar_url = "https://cdn.discordapp.com/avatars/$author_id/$avatar.jpg";
					$edit = ($_SESSION['logged_in'] && in_array($user_id, ADMIN_NEWS) && $user_id == $author_id) ? "<a class='btn btn-info text-nowrap' href='/news/editNewspost.php?id=$newspost_id'><img src=\"/_assets/_img/icons/edit.svg\"></a>" : "&nbsp;";
					$edited_HTML = $created_at == $edited_at ? "&nbsp;" : "(last edited at: <span id=\"edited$newspost_id\"></span>)<script>convertEditedTime(\"$edited_at+00:00\", $newspost_id);</script>";
					$delete = ($_SESSION['logged_in'] && in_array($user_id, ADMIN_SITE)) ? "<a class='btn btn-danger text-nowrap' href='/news/deleteNewspost.php?id=$newspost_id'><img src=\"/_assets/_img/icons/delete.svg\"></a>" : "&nbsp;";
					print("<table><tr><td rowspan=2><img src=\"$avatar_url\" width=64 height=64/></td><td width=100%><h5>$title</h5></td><td class=\"text-nowrap\">$edit &nbsp; $delete</td></tr>");
					print("<tr><td colspan=2>By $username on <span id=\"created$newspost_id\"></span> <script>convertCreatedTime(\"$created_at+00:00\", $newspost_id);</script> $edited_HTML </td></tr></table><hr/>$text<br/><br/>");
					print("</div><br/>");
				}
				?>

			<?php include $_SERVER['DOCUMENT_ROOT'].'/_includes/footer.php'; ?>	
			</div>		</div>
	</body>
</html>