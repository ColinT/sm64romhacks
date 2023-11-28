<!DOCTYPE HTML>
	<html>
		<!--BEGINNING OF HEAD-->
		<head>
			<title>sm64romhacks - <?php print(getUserFromDatabase($pdo, $user_id)['discord_username']);?></title>
			<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
			<meta name="keywords" content="super mario, romhacks, hack, speedrun, sm64hacks, sm64romhacks, rom, modification" />
			<meta name="description" content="Welcome to SM64ROMHacks! We have a really big collection of SM64 ROM Hacks which wait to be played! Community News/Events will also be tracked here" />
			<link rel="stylesheet" type="text/css" href="/_assets/_css/bootstrap.css">
			<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
			<link rel="shortcut icon" href="/_assets/_img/icon.ico" />
			<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
		</head>
		<body>		<div class="container">
		<?php include($_SERVER['DOCUMENT_ROOT'].'/_includes/header.php'); ?>
				<div align="center">
					<h1><img src="https://cdn.discordapp.com/avatars/<?php print($user['discord_id']); ?>/<?php print($user['discord_avatar']);?>.jpg" height=64 width=64><?php print($user['discord_username']);?></h1><hr/>
					<!--HTML CONTENT HERE-->
					<?php if(sizeof($data) == 0) { ?>
						This user has no published ROM Hacks!
			<?php } 
			else { ?>

					<div class="table-responsive">
		        	<table class="table-sm table-bordered">
			        <tr><th><b>Hack Name</b></th><th><b>Creator</b></th><th>Release Date</th></tr>
					<?php foreach($data as $entry) { 
						//$authors = getAllAuthorsNames($pdo, $entry['author']); 
						$authors = $entry['author'];
						$authors = explode(", ", $authors);
						$hack_author = "";
						foreach($authors as $author) {
						  $user = getUserFromDatabase($pdo, $author);
						  if($user) $hack_author = $hack_author . '<a href="/users/' . $author . '">' . $user['discord_username'] . '</a>, ';
						  else $hack_author = $hack_author . $author . ', ';
						}
						$hack_author = substr_replace($hack_author, '', -2); ?>

						
						<tr><td><a href="/hacks/<?php print(getURLEncodedName($entry['hack_name']));?>"><?php print($entry['hack_name']); ?></a></td><td><?php print($hack_author); ?></td><td><?php print($entry['release_date']); ?></td></tr>
					<?php } ?>
			    </table></div> <br/>
				<?php } ?>

			<?php include($_SERVER['DOCUMENT_ROOT'].'/_includes/footer.php'); ?>
				</div>		</div>
		</body>
	</html>