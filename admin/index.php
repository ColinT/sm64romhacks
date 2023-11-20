<?php

include $_SERVER['DOCUMENT_ROOT'].'/_includes/includes.php';

session_start();
if(!$_SESSION['logged_in'] || !in_array($_SESSION['userData']['discord_id'], ADMIN_NEWS)) {
	header("Location: /login/error.php");
	die();
}

$claims = getClaimsFromDatabase($pdo);
$pending_hacks = getAllPendingHacksFromDatabase($pdo);
?>

<!DOCTYPE HTML>
<html>
	<!--BEGINNING OF HEAD-->
	<head>
		<title>sm64romhacks - DOCUMENT TITLE</title> <!--CHANGE TITLE-->
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<meta name="keywords" content="super mario, romhacks, hack, speedrun, sm64hacks, sm64romhacks, rom, modification" />
		<meta name="description" content="Welcome to SM64ROMHacks! We have a really big collection of SM64 ROM Hacks which wait to be played! Community News/Events will also be tracked here" />
		<link rel="stylesheet" type="text/css" href="/_css/bootstrap.css">
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
		<link rel="shortcut icon" href="/_img/icon.ico" />
		<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
	</head>
	<body>		<div class="container">
	<?php include($_SERVER['DOCUMENT_ROOT'].'/_includes/header.php'); ?>
			<div align="center">
				<div class="table-responsive">
				<!--HTML CONTENT HERE-->
				<table class="table-sm table-bordered">
					<tr><th>Claim ID</th><th>Hack ID</th><th>User ID</th><th>Claimed Author</th><th class="border-0">&nbsp;</th></tr>
					<?php foreach($claims as $entry) { ?>
					<tr><td><?php print($entry['claim_id']);?></td><td><?php print($entry['hack_id']);?></td><td><?php print($entry['user_id']);?></td><td><?php print($entry['claimed_author']);?></td><td class="border-0"><a class="btn btn-success text-nowrap" href="acceptClaim.php?claim_id=<?php print($entry['claim_id']);?>"><img src="/_img/accept.svg"></a>&nbsp;<a class="btn btn-danger text-nowrap" href="rejectClaim.php?claim_id=<?php print($entry['claim_id']);?>"><img src="/_img/delete.svg"></a></td></tr>	
					<?php } ?>
					</table>
					</div>
				<div class="table-responsive">
				<table class="table-sm table-bordered">
					<tr><th>Hack Name</th><th>Version</th><th>Hack Author</th><th>Star Count</th><th>Release Date</th><th>Tag</th><th>Description</th></tr>
					<?php foreach($pending_hacks as $entry) { ?>
					<tr><td><?php print($entry['hack_name']);?></td><td><?php print($entry['hack_version']);?></td><td><?php print($entry['hack_author']);?></td><td><?php print($entry['hack_starcount']);?></td><td><?php print($entry['hack_release_date']);?></td><td><?php print($entry['hack_tags']);?></td><td><?php print($entry['hack_description']);?></td><td class="border-0"><a class="btn btn-success text-nowrap" href="acceptClaim.php?claim_id=<?php print($entry['claim_id']);?>"><img src="/_img/accept.svg"></a>&nbsp;<a class="btn btn-danger text-nowrap" href="rejectClaim.php?claim_id=<?php print($entry['claim_id']);?>"><img src="/_img/delete.svg"></a></td></tr>	
					<?php } ?>

			<?php include($_SERVER['DOCUMENT_ROOT'].'/_includes/footer.php'); ?>	
			</div>		</div>
	</body>
</html>

