<?php

include $_SERVER['DOCUMENT_ROOT'].'/_includes/includes.php';

if(!$_SESSION['logged_in']) header("Location: /");
$hack_id = scrapChars($_GET['hack_id']); 
$data = getPatchFromDatabase($pdo, $hack_id);
$hack_author = $data[0]['hack_author'];
$authors = explode(", ", $hack_author);

if(sizeof($_POST) != 0) {
	if(intval($_POST['hack_id']) == 0) header("Location: /hacks");
    
    $hack_id = $_POST['hack_id'];
    $user_id = $_SESSION['userData']['discord_id'];
    $claimed_author = $_POST['hack_author_claim'];

    createClaimsDatabase($pdo);
    addClaimToDatabase($pdo, $hack_id, $user_id, $claimed_author);

    header("Location: /hacks");
}

?>

<!DOCTYPE HTML>
<html>
	<!--BEGINNING OF HEAD-->
	<head>
		<title>sm64romhacks - Submit Claim!</title> <!--CHANGE TITLE-->
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
				<!--HTML CONTENT HERE-->
				<form action="#" method="post">
					<input name="hack_id" type="hidden" value="<?php print($hack_id)?>">
						<?php foreach($authors as $author) {
							if(((int)$author) == 0 ) { ?>
							<div class="form-check"><input class="form-check-input" type="radio" name="hack_author_claim" value="<?php print($author); ?>"><label class="form-check-label"><?php print($author);?></label></div>
						<?php }}?>
						<input class="btn btn-primary" type="submit" value="Submit Claim!">
				</form>
			<?php include($_SERVER['DOCUMENT_ROOT'].'/_includes/footer.php'); ?>	
			</div>		</div>
	</body>
</html>