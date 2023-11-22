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
					<!--HTML CONTENT HERE-->
					
					<div class="table-responsive">
		        	<table class="table-sm table-bordered">
			        <tr><th><b>Hack Name</b></th><th><b>Creator</b></th><th>Release Date</th></tr>
					<?php foreach($data as $entry) { 
						$authors = getAllAuthorsNames($pdo, $entry['author']);?> 
						
						<tr><td><?php print($entry['hack_name']); ?></td><td><?php print($authors); ?></td><td><?php print($entry['release_date']); ?></td></tr>
					<?php } ?>
			    </table></div> <br/>

			<?php include($_SERVER['DOCUMENT_ROOT'].'/_includes/footer.php'); ?>
				</div>		</div>
		</body>
	</html>