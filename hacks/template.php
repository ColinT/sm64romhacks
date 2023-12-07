<?php 
if($_SESSION['logged_in'] && (in_array($_SESSION['userData']['discord_id'], ADMIN_SITE))) {
	$admin_HTMLLoad = "&nbsp;<a class=\"btn btn-danger text-nowrap\" href=\"deleteHack.php?hack_name=$hack_name\"><img src=\"/_assets/_img/icons/delete.svg\"></a>&nbsp;<a class=\"btn btn-info text-nowrap\" href=\"editHack.php?hack_name=$hack_name\"><img src=\"/_assets/_img/icons/edit.svg\"></a>";
}

$logo_HTMLLoad = "";
$hacks_logo = "logo_" . stripChars($hack_name) . ".jpg";
if(file_exists($_SERVER['DOCUMENT_ROOT'] . "/_assets/_img/hacks/$hacks_logo")) $logo_HTMLLoad = "<img src=\"/_assets/_img/hacks/$hacks_logo\" width=80 height=60>&nbsp;";

?>
<!DOCTYPE HTML>
	<html>
		<!--BEGINNING OF HEAD-->
		<head>
			<title>sm64romhacks - <?php print($hack_name);?></title>
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
					<h1><?php print($logo_HTMLLoad);?><u><?php print($hack_name);?></u><?php print($admin_HTMLLoad);?></h1>
					<div class="table-responsive">
		        	<table class="table-sm table-bordered">
					<?php $admin_HTMLLoad =  ($_SESSION['logged_in'] && in_array($_SESSION['userData']['discord_id'], ADMIN_SITE)) ? "" : " hidden";?>
			        <tr><th <?php print($admin_HTMLLoad);?>><b>Hack ID</b></th><th><b>Hackname</b></th><th>Version</th><th><b>Downloadlink</b></th><th><b>Creator</b></th><th><b>Starcount</b></th><th>Date</th><th <?php print($admin_HTMLLoad);?>>Tag</th><th colspan=2 class="border-0">&nbsp;</th></tr>
				    <?php 
					$fileending=".zip";
                    foreach($data as $entry) 
                    {
                        $id = $entry['hack_id'];
                        $version = $entry['hack_version'];
                        $dl = $entry['hack_patchname'];
                        $creator = $entry['hack_author'];
                        $amount = $entry['hack_starcount'];
                        $date = $entry['hack_release_date'];
                        $link=$dl.$fileending;
                        $ref="'/patch/$link'"; 
						$tag = $entry['hack_tags'];
						$download = $entry['hack_downloads'];
						$is_recommend = $entry['hack_recommend'];
						$is_author = str_contains(getPatchFromDatabase($pdo, $id)[0]['hack_author'], $_SESSION['userData']['discord_id']) || str_contains(getHackFromDatabase($pdo, $hack_name)[0]['hack_author'], $_SESSION['userData']['discord_id']);

						$admin_buttons = ($_SESSION['logged_in'] && (in_array($_SESSION['userData']['discord_id'], ADMIN_SITE) || $is_author)) ? "<a class=\"btn btn-danger btn-block text-nowrap\" href=\"deleteHack.php?hack_id=$id\"><img src=\"/_assets/_img/icons/delete.svg\"></a></th><th class=\"border-0\"><a class=\"btn btn-info btn-block text-nowrap\" href=\"editHack.php?hack_id=$id\"><img src=\"/_assets/_img/icons/edit.svg\"></a>" : "&nbsp;";
						$user_button = $_SESSION['logged_in'] && !areAllAuthorsAnId($creator) ? "<a class=\"btn btn-warning btn-block text-nowrap\" href=\"/hacks/claim.php?hack_id=$id\"><img src=\"/_assets/_img/icons/claim.svg\"></a>" : "&nbsp;";
						$recommend_class = $is_recommend == 1 ? "class=table-primary" : "";

						$authors = explode(", ", $creator);
						$hack_author = "";
						foreach($authors as $author) {
						  $user = getUserFromDatabase($pdo, $author);
						  if($user) $hack_author = $hack_author . '<a href="/users/' . $author . '">' . $user['discord_username'] . '</a>, ';
						  else $hack_author = $hack_author . $author . ', ';
						}
						$hack_author = substr_replace($hack_author, '', -2);
			   
                        print "<tr><td $recommend_class $admin_HTMLLoad>$id</td><td $recommend_class>$hack_name</td><td $recommend_class>$version</td><td $recommend_class><u><a href=download.php?hack_id=$id>Download</a></u><br/><small class=\"text-muted\">Downloads: $download</small></td><td $recommend_class>$hack_author</td><td $recommend_class>$amount</td><td $recommend_class>$date</td><td $recommend_class $admin_HTMLLoad>$tag</td><td class=\"border-0\">$user_button</td><td class=\"border-0\">$admin_buttons</td></tr>\n";
                    }?>
			    </table></div> <br/>
                <div><table>
					<?php
						$description_button_text = strlen($data[0]['hack_description']) == 0 ? "Add Description" : "<img src=\"/_assets/_img/icons/edit.svg\">";
						$description_button = ($_SESSION['logged_in'] && in_array($_SESSION['userData']['discord_id'], ADMIN_SITE)) ? "<a class=\"btn btn-info text-nowrap\" href=\"editHack.php?hack_name=$hack_name\">$description_button_text</a>" : "&nbsp;";

					?>
                    <tr><td class="align-top text-right"><?php print($description_button);?></td></tr>
                <tr><td class="bg-dark" id="hack_description"><?php $hack_description = $data[0]['hack_description']; print($hack_description); ?></td>
                </tr></table></div>

			<?php include($_SERVER['DOCUMENT_ROOT'].'/_includes/footer.php'); ?>
				</div>		</div>
		</body>
	</html>