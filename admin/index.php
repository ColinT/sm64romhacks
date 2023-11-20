<?php

include $_SERVER['DOCUMENT_ROOT'].'/_includes/includes.php';

session_start();
if(!$_SESSION['logged_in'] || !in_array($_SESSION['userData']['discord_id'], ADMIN_NEWS)) {
	header("Location: /login/error.php");
	die();
}

$data = getClaimsFromDatabase($pdo);
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
					<?php foreach($data as $entry) { ?>
					<tr><td><?php print($entry['claim_id']);?></td><td><?php print($entry['hack_id']);?></td><td><?php print($entry['user_id']);?></td><td><?php print($entry['claimed_author']);?></td><td class="border-0"><a class="btn btn-success text-nowrap" href="acceptClaim.php?claim_id=<?php print($entry['claim_id']);?>"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-x" viewBox="0 0 24 24"><path fill-rule="evenodd" d="M2.25 12c0-5.385 4.365-9.75 9.75-9.75s9.75 4.365 9.75 9.75-4.365 9.75-9.75 9.75S2.25 17.385 2.25 12zm13.36-1.814a.75.75 0 10-1.22-.872l-3.236 4.53L9.53 12.22a.75.75 0 00-1.06 1.06l2.25 2.25a.75.75 0 001.14-.094l3.75-5.25z" clip-rule="evenodd"></path></svg></a>&nbsp;<a class="btn btn-danger text-nowrap" href="rejectClaim.php?claim_id=<?php print($entry['claim_id']);?>"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-x" viewBox="0 0 16 16"><path d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z"/></svg></a></td></tr>	
					<?php } ?>
					</table>
					</div>
			<?php include($_SERVER['DOCUMENT_ROOT'].'/_includes/footer.php'); ?>	
			</div>		</div>
	</body>
</html>

