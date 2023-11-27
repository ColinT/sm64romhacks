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
        <script src="index.js"></script>
		<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
	</head>
	<body>		<div class="container">
	<?php include($_SERVER['DOCUMENT_ROOT'].'/_includes/header.php'); ?>
			<div align="center">
                <?php if(strlen($hack_name) != 0) { ?>
                <form action="#" method="post">
                    <table class="table table-bordered">
                    <tr>
                        <td class="text-right">
                            <label for="hack_name" class="col-form-label text-nowrap">Hack Name:</label>
                        </td>
                        <td>
                            <input type="hidden" class="form-control" name="hack_name" id="hack_name" value="<?php print($hackdata[0]['hack_name']); ?>">  
                            <input type="text" class="form-control" value="<?php print($hackdata[0]['hack_name']); ?>" disabled>  
                        </td>
                    </tr>
                    <tr>
                        <td class="text-right">
                            <label for="hack_recommend" class="col-form-label text-nowrap">Recommend Versions:</label>
                        </td>
                        <td class="text-left">
                            <?php 
                            foreach($hackdata as $entry) {
                                $version = $entry['hack_version'];
                                $id = $entry['hack_id'];
                                print("<input class=\"col-form-input\" type=\"checkbox\" name=\"$id\" id=\"flexCheckDefault\">");
                                print("<label class=\"col-form-label\" for=\"flexCheckDefault\">$version</label><br/>");
                            }
                            ?>
                        </td>
                    </tr>
                    <tr>
                        <td class="text-right">
                            <label for="hack_tags" class="col-form-label text-nowrap">Hack Tags:</label>
                        </td>
                        <td>
                        <input class="form-control" list="hack_tags_options" name="hack_tags" value="<?php print($hackdata[0]['hack_tags']);?>">  
                            <datalist id="hack_tags_options">                          
                            <?php 
                                $data = getAllTagsFromDatabase($pdo);
                                foreach($data as $entry) {
                                    $tag = $entry['hack_tags'];
                                    $tag = explode(", ", $tag);
                                    foreach($tag as $t) {
                                        print("<option value=\"$t\">");
                                    }
                                }
                            ?>
                            </datalist>
                        </td>
                    </tr>

                    <tr>
                    <td class="text-right">
                        <label for="hack_description" class="col-form-label text-nowrap">Description:</label>
                        </td>
                        <td colspan=3>
                            <textarea name="hack_description" class="form-control" rows="10" required><?php print(str_replace('<br/>', "\r\n", $hackdata[0]['hack_description']));?></textarea>
                        </td>
                    </tr>
                    <tr>
                        <td>&nbsp;</td>
                        <td class="text-center"><button type="submit" class="btn btn-secondary align-middle">Save Changes!</button></td>
                    </tr>
                    </table>
                </form>
                <?php } else { ?>
                    <form action="#" method="post">
                    <table class="table">
                    <tr>
                        <td>
                            <label for="hack_name" class="col-form-label text-nowrap">Hack Name:</label>
                        </td>
                        <td>
                            <input class="form-control" list="hack_name_options" name="hack_name" value="<?php print($hackdata[0]['hack_name']); ?>" required>                            
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
                            <input type="text" name="hack_version" class="form-control" value="<?php print($hackdata[0]['hack_version']); ?>" required>
                        </td>
                        <td>
                            <label for="hack_author" class="col-form-label text-nowrap">Author:</label>
                        </td>
                        <td>
                            <input type="text" name="hack_author" class="form-control" value="<?php print(getAllAuthorsNames($pdo, $hackdata[0]['hack_author']));?>">
                            <small id="hack_author_help" class="form-text text-muted">Seperate multiple author with &quot;&lt;Name&gt;,&nbsp;&lt;Name&gt;&quot;</small>                        
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label for="hack_starcount" class="col-form-label text-nowrap">Starcount:</label>
                        </td>
                        <td>
                            <input type="number" name="hack_starcount" class="form-control" min="0" value="<?php print($hackdata[0]['hack_starcount']);?>">
                        </td>
                        <td>
                            <label for="hack_release_date" class="col-form-label text-nowrap">Release Date:</label>
                        </td>
                        <td>
                            <input type="date" name="hack_release_date" class="form-control" value="<?php print($hackdata[0]["hack_release_date"]);?>">
                        </td>
                        <td>
                            <label for="hack_patchname" class="col-form-label text-nowrap">Patchname:</label>
                        </td>
                        <td>
                            <input type="file" name="hack_patchname" class="form-control" disabled>
                        </td>
                    </tr>
                    <tr>
                        <td colspan=2>&nbsp;</td>
                        <td colspan=2 class="text-center"><button type="submit" class="btn btn-secondary align-middle">Save Changes!</button></td>
                        <td colspan=2>&nbsp;</td>
                    </tr>
                    </table>
                </form>

                    <?php }?>
                </div>
				<?php include($_SERVER['DOCUMENT_ROOT'].'/_includes/footer.php'); ?>
			</div>		</div>
	</body>
</html>