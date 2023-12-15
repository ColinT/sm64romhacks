<?php

include $_SERVER['DOCUMENT_ROOT'].'/_includes/includes.php';

$hack_name = stripChars($_GET['hack_name']);
$hack_id = intval($_GET['hack_id']);

$is_author = str_contains(getPatchFromDatabase($pdo, $hack_id)[0]['hack_author'], $_SESSION['userData']['discord_id']) || str_contains(getHackFromDatabase($pdo, $hack_name)[0]['hack_author'], $_SESSION['userData']['discord_id']);
if(strlen($hack_name) == 0 && $hack_id == 0 || strlen($hack_name) != 0 && $hack_id != 0 || !$_SESSION['logged_in'] || (!$is_author && !in_array($_SESSION['userData']['discord_id'], ADMIN_SITE))) {
	header("Location: /hacks");
	die();
}

if(sizeof($_POST) != 0) {
    $hack_description = stripChars($_POST['hack_description']);


    if(!isset($hack_description) && $hack_id == 0) {
        header("Location: /hacks");
        die();
    }

    if(strlen($hack_description) != 0) {
        $images = (glob($_SERVER['DOCUMENT_ROOT'] . "/_assets/_img/hacks/img_" . stripChars(getURLEncodedName($hack_name)) . "_*.{png,jpg}", GLOB_NOSORT|GLOB_BRACE));
        foreach($images as $image) {
            $image = explode("/",$image)[sizeof(explode("/",$image)) - 1];
            $ext = substr($image, -3);
            $image = substr_replace($image, "", -4);
            if(!isset($_POST[$image])) {
                unlink($_SERVER['DOCUMENT_ROOT'] . "/_assets/_img/hacks/$image.$ext");
            }
        }
        
        $hack_name = stripChars($_POST['hack_name']);
        $hack_description = str_replace("\r\n", "<br/>", $hack_description);
        $hack_description = stripChars($hack_description);
        $hack_description = str_replace("&lt;br/&gt;", "<br/>", $hack_description);
        $hack_tags = stripChars($_POST['hack_tags']);
        updateHackInDatabase($pdo,$hack_name,$hack_tags,$hack_description);
        $hack = getHackFromDatabase($pdo, $hack_name);
        foreach($hack as $entry) {
            unrecommendPatchFromDatabase($pdo, intval($entry['hack_id']));
            if(isset($_POST[$entry['hack_id']])) {
                recommendPatchFromDatabase($pdo, intval($entry['hack_id']));
            }
        }
        for($i = 0; $i < sizeof($_FILES['hack_images']['tmp_name']); $i++) {
            $image_name = $_FILES['hack_images']['name'][$i];
            $ext = pathinfo($_FILES['hack_images']['name'][$i], PATHINFO_EXTENSION);
            $tmp_name = $_FILES['hack_images']['tmp_name'][$i];


            $images = (glob($_SERVER['DOCUMENT_ROOT'] . "/_assets/_img/hacks/img_" . stripChars(getURLEncodedName($hack_name)) . "_*.{png,jpg}", GLOB_NOSORT|GLOB_BRACE));
            $counter = 0;
            if(sizeof($images) != 0) {
                $image = explode("/",$images[sizeof($images) - 1])[sizeof(explode("/",$images[sizeof($images) - 1])) - 1];
                $image = substr_replace($image, "", -4); 
                $counter = sizeof($images);
            }
            $logo_result = move_uploaded_file($tmp_name, $_SERVER['DOCUMENT_ROOT'].'/_assets/_img/hacks/img_' . stripChars(getURLEncodedName($hack_name)) . "_$counter.$ext");
        }
    }
    else {
        $hack_name = stripChars($_POST['hack_name']);
        $hack_version = stripChars($_POST['hack_version']);
        $hack_author = stripChars($_POST['hack_author']);
        $hack_starcount = intval($_POST['hack_starcount']);
        $hack_release_date = $_POST['hack_release_date'];

        $hack_authors = explode(", ", $hack_author);
        $hack_author = "";
        foreach($hack_authors as $author) {
            $user = getUserByNameFromDatabase($pdo, $author);
            if($user) $hack_author = $hack_author . $user['discord_id'] . ', ';
            else $hack_author = $hack_author . $author . ', ';
        }
        $hack_author = substr_replace($hack_author, '', -2);
        updatePatchInDatabase($pdo, $hack_id, $hack_name, $hack_version, $hack_author, $hack_starcount, $hack_release_date, 1);
    }

    header("Location: /hacks/" . getURLEncodedName($hack_name));
    die();

}


if(strlen($hack_name) != 0) $hackdata = getHackFromDatabase($pdo, stripChars($_GET['hack_name']));
else $hackdata = getPatchFromDatabase($pdo, $hack_id);
?>
<!DOCTYPE HTML>
<html>
	<!--BEGINNING OF HEAD-->
	<head>
		<title>sm64romhacks - Edit Hack</title> <!--CHANGE TITLE-->
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<meta name="keywords" content="super mario, romhacks, hack, speedrun, sm64hacks, sm64romhacks, rom, modification" />
		<meta name="description" content="Welcome to SM64ROMHacks! We have a really big collection of SM64 ROM Hacks which wait to be played! Community News/Events will also be tracked here" />
		<link rel="stylesheet" type="text/css" href="/_assets/_css/bootstrap.css">
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
		<link rel="shortcut icon" href="/_assets/_img/icon.ico" />
        <script src="editHack.js"></script>
		<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
	</head>
	<body>		<div class="container">
	<?php include($_SERVER['DOCUMENT_ROOT'].'/_includes/header.php'); ?>
			<div id="content" align="center">
                </div>
				<?php include($_SERVER['DOCUMENT_ROOT'].'/_includes/footer.php'); ?>
			</div>		</div>
	</body>
</html>