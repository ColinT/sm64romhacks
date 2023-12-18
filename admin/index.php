<?php

include $_SERVER['DOCUMENT_ROOT'].'/_includes/includes.php';

if(!$_SESSION['logged_in'] || !in_array($_SESSION['userData']['discord_id'], ADMIN_SITE)) {
	header("Location: /404.php");
	die();
}

if(sizeof($_GET) != 0 || intval($_GET['hack_id']) != 0) {
	if(stripChars($_GET['type']) == 'submission') {
		$hack_id = intval($_GET['hack_id']);
		$patch = getPatchFromDatabase($pdo, $hack_id);
		if($_GET['mode'] == 'accept') {
			verifyPatchInDatabase($pdo, $hack_id);
			rename($_SERVER['DOCUMENT_ROOT'] . "/admin/" . $patch[0]['hack_patchname'] . '.zip', $_SERVER['DOCUMENT_ROOT'] . "/patch/" . $patch[0]['hack_patchname'] . '.zip');
		}
		else if(stripChars($_GET['mode']) == 'reject') {
			deletePatchFromDatabase($pdo, $hack_id);
			unlink($_SERVER['DOCUMENT_ROOT'] . "/admin/" . $patch[0]['hack_patchname'] . '.zip');
		}
		header("Location: /admin");
		die();
	}
}

$pending_hacks = getAllPendingHacksFromDatabase($pdo);
?>

<!DOCTYPE HTML>
<html>
	<!--BEGINNING OF HEAD-->
	<head>
		<title>sm64romhacks - Admin Page</title> <!--CHANGE TITLE-->
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<meta name="keywords" content="super mario, romhacks, hack, speedrun, sm64hacks, sm64romhacks, rom, modification" />
		<meta name="description" content="Welcome to SM64ROMHacks! We have a really big collection of SM64 ROM Hacks which wait to be played! Community News/Events will also be tracked here" />
		<link rel="stylesheet" type="text/css" href="/_assets/_css/bootstrap.css">
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
		<link rel="shortcut icon" href="/_assets/_img/icon.ico" />
		<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
	</head>
	<body>		<div class="container">
	<?php include($_SERVER['DOCUMENT_ROOT'].'/_includes/header.php'); ?>
			<div align="center">
					<?php if(sizeof($pending_hacks) != 0) { ?>
					<div class="table-responsive">
				<table class="table-sm table-bordered">
					<tr><th>Hack Name</th><th>Version</th><th>Hack Author</th><th>Star Count</th><th>Release Date</th><th>Tag</th><th>Description</th><th class="border-0">&nbsp;</th></tr>
					<?php foreach($pending_hacks as $entry) { ?>
					<tr><td class="align-top text-nowrap"><?php print($entry['hack_name']);?></td><td class="align-top text-nowrap"><?php print($entry['hack_version']);?></td><td class="align-top text-nowrap"><?php print($entry['hack_author']);?></td><td class="align-top text-nowrap"><?php print($entry['hack_starcount']);?></td><td class="align-top text-nowrap"><?php print($entry['hack_release_date']);?></td><td class="align-top text-nowrap"><?php print($entry['hack_tags']);?></td><td class="align-top w-25"><?php print($entry['hack_description']);?></td><td class="border-0 align-top"><a class="btn btn-success text-nowrap" href="/admin?type=submission&hack_id=<?php print($entry['hack_id']);?>&mode=accept"><img src="/_assets/_img/icons/accept.svg"></a>&nbsp;<a class="btn btn-danger text-nowrap" href="/admin?type=submission&hack_id=<?php print($entry['hack_id']);?>&mode=reject"><img src="/_assets/_img/icons/reject.svg"></a></td></tr>	
					<?php } ?>
					</table>
					</div>
					<?php } else print("Currently No Hacks for review available!");?>


			<?php include($_SERVER['DOCUMENT_ROOT'].'/_includes/footer.php'); ?>	
			</div>		</div>
	</body>
</html>

