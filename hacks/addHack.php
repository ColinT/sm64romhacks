<?php

include $_SERVER['DOCUMENT_ROOT'].'/_includes/includes.php';


session_start();
if(!$_SESSION['logged_in']) {
	header("Location: /login/error.php");
	die();
}

if(sizeof($_POST) != 0) {
$hack_name = $_POST['hack_name'];
$hack_version = $_POST['hack_version'];
$hack_author = $_POST['hack_author'];
$hack_starcount = isset($_POST['hack_amount']) ? intval($_POST['hack_amount']) : 0;
$hack_release_date = $_POST['hack_release_date'];
$hack_patchname = $_FILES['hack_patchname']["name"];
$hack_tags = $_POST['hack_tags'];
$hack_description = $_POST['hack_description'];

$hack_authors = explode(", ", $hack_author);
$hack_author = "";
foreach($hack_authors as $author) {
    $user = getUserByNameFromDatabase($pdo, $author);
    if($user) $hack_author = $hack_author . $user['discord_id'] . ', ';
    else $hack_author = $hack_author . $author . ', ';
  }
  $hack_author = substr_replace($hack_author, '', -2);

$hack_patchname = substr($hack_patchname, 0, -4);

if(in_array($_SESSION['userData']['discord_id'], ADMIN_NEWS)) {
    addHackToDatabase($pdo, $hack_name, $hack_version, $hack_author, $hack_starcount, $hack_release_date, $hack_patchname, $hack_tags, $hack_description, 1);
    $result = move_uploaded_file($_FILES['hack_patchname']['tmp_name'], $_SERVER['DOCUMENT_ROOT'].'/patch/'.$hack_patchname);

}

else {
    addHackToDatabase($pdo, $hack_name, $hack_version, $hack_author, $hack_starcount, $hack_release_date, $hack_patchname, $hack_tags, $hack_description, 0);
    $result = move_uploaded_file($_FILES['hack_patchname']['tmp_name'], $_SERVER['DOCUMENT_ROOT'].'/admin/'.$hack_patchname);
}

if(!$result) {header("Location: /404.php"); die();}


header("Location: /hacks");
die();

}

?>
<!DOCTYPE HTML>
<html>
	<!--BEGINNING OF HEAD-->
	<head>
		<title>sm64romhacks - Add Hack</title> <!--CHANGE TITLE-->
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<meta name="keywords" content="super mario, romhacks, hack, speedrun, sm64hacks, sm64romhacks, rom, modification" />
		<meta name="description" content="Welcome to SM64ROMHacks! We have a really big collection of SM64 ROM Hacks which wait to be played! Community News/Events will also be tracked here" />
		<link rel="stylesheet" type="text/css" href="/_css/bootstrap.css">
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
		<link rel="shortcut icon" href="/_img/icon.ico" />
        <script src="index.js"></script>
		<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
	</head>
	<body>		<div class="container">
	<?php include($_SERVER['DOCUMENT_ROOT'].'/_includes/header.php'); ?>
			<div align="center">
                <form action="#" method="post" enctype="multipart/form-data">
                    <table class="table">
                    <tr>
                        <td>
                            <label for="hack_name" class="col-form-label text-nowrap">Hack Name:</label>
                        </td>
                        <td>
                            <input class="form-control" list="hack_name_options" name="hack_name" placeholder="Type to search..." required>                            
                            <datalist id="hack_name_options">
                                <?php 
                                $data = getAllUniqueHacksFromDatabase($pdo);
                                foreach($data as $entry) {
                                    $name = $entry['hack_name'];
                                    print("<option value=\"$name\">");
                                }
                                ?>
                            </datalist>
                        </td>
                        <td>
                            <label for="hack_version" class="col-form-label text-nowrap">Version:</label>
                        </td>
                        <td>
                            <input type="text" name="hack_version" class="form-control" required>
                        </td>
                        <td>
                            <label for="hack_author" class="col-form-label text-nowrap">Author:</label>
                        </td>
                        <td>
                            <input type="text" name="hack_author" class="form-control">
                            <small id="hack_author_help" class="form-text text-muted">Seperate multiple author with &quot;&lt;Name&gt;,&nbsp;&lt;Name&gt;&quot;</small>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label for="hack_amount" class="col-form-label text-nowrap">Starcount:</label>
                        </td>
                        <td>
                            <input type="number" name="hack_amount" class="form-control" min="0">
                        </td>
                        <td>
                            <label for="hack_release_date" class="col-form-label text-nowrap">Release Date:</label>
                        </td>
                        <td>
                            <input type="date" name="hack_release_date" class="form-control">
                        </td>
                        <td>
                            <label for="hack_patchname" class="col-form-label text-nowrap">Patchname:</label>
                        </td>
                        <td>
                            <input type="file" name="hack_patchname" class="form-control" required>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label for="hack_tags" class="col-form-label text-nowrap">Tags:</label>

                        </td>
                        <td>
                            <input class="form-control" list="hack_tags_options" name="hack_tags" placeholder="Type to search...">  
                            <datalist id="hack_tags_options">                          
                            <?php 
                                $data = getAllTagsFromDatabase($pdo);
                                foreach($data as $entry) {
                                    $tag = $entry['hack_tags'];
                                    print("<option value=\"$tag\">");
                                }
                            ?>
                            </datalist>
                            <small id="hack_tags_help" class="form-text text-muted">Seperate multiple tags with &quot;&lt;Tag&gt;,&nbsp;&lt;Tag&gt;&quot;</small>                        </td>

                        </td>
                        <td>
                            <label for="hack_description" class="col-form-label text-nowrap">Description:</label>
                        </td>
                        <td colspan=3>
                            <textarea name="hack_description" class="form-control"></textarea>
                        </td>
                    </tr>
                    <tr>
                        <td colspan=2>&nbsp;</td>
                        <td colspan=2 class="text-center"><button type="submit" class="btn btn-secondary align-middle">Add Hack!</button></td>
                        <td colspan=2>&nbsp;</td>
                    </tr>
                    </table>
                </form>
                </div>
				<?php include($_SERVER['DOCUMENT_ROOT'].'/_includes/footer.php'); ?>
			</div>		</div>
	</body>
</html>