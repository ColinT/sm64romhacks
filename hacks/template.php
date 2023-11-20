<!DOCTYPE HTML>
	<html>
		<!--BEGINNING OF HEAD-->
		<head>
			<title>sm64romhacks - <?php print($hack_name);?></title>
			<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
			<meta name="keywords" content="super mario, romhacks, hack, speedrun, sm64hacks, sm64romhacks, rom, modification" />
			<meta name="description" content="Welcome to SM64ROMHacks! We have a really big collection of SM64 ROM Hacks which wait to be played! Community News/Events will also be tracked here" />
			<link rel="stylesheet" type="text/css" href="/_css/bootstrap.css">
			<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
			<link rel="shortcut icon" href="/_img/icon.ico" />
			<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
		</head>
		<body>		<div class="container">
		<?php include($_SERVER['DOCUMENT_ROOT'].'/_includes/header.php'); ?>

				<div align="center">
					<!--HTML CONTENT HERE-->
					
					<h1><u><?php print($hack_name);?></u></h1>
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
						$admin_buttons = ($_SESSION['logged_in'] && in_array($_SESSION['userData']['discord_id'], ADMIN_SITE)) ? "<a class=\"btn btn-danger btn-block text-nowrap\" href=\"deleteHack.php?hack_id=$id\"><svg xmlns=\"http://www.w3.org/2000/svg\" width=\"24\" height=\"24\" fill=\"currentColor\" class=\"bi bi-trash\" viewBox=\"0 0 16 16\"><path d=\"M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5Zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5Zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6Z\"/><path d=\"M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1ZM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118ZM2.5 3h11V2h-11v1Z\"/></svg></a></th><th class=\"border-0\"><a class=\"btn btn-info btn-block text-nowrap\" href=\"editHack.php?hack_id=$id\"><svg xmlns=\"http://www.w3.org/2000/svg\" width=\"24\" height=\"24\" fill=\"currentColor\" class=\"bi bi-pencil-fill\" viewBox=\"0 0 16 16\"><path d=\"M12.854.146a.5.5 0 0 0-.707 0L10.5 1.793 14.207 5.5l1.647-1.646a.5.5 0 0 0 0-.708l-3-3zm.646 6.061L9.793 2.5 3.293 9H3.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.207l6.5-6.5zm-7.468 7.468A.5.5 0 0 1 6 13.5V13h-.5a.5.5 0 0 1-.5-.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.5-.5V10h-.5a.499.499 0 0 1-.175-.032l-.179.178a.5.5 0 0 0-.11.168l-2 5a.5.5 0 0 0 .65.65l5-2a.5.5 0 0 0 .168-.11l.178-.178z\"/></svg></a>" : "&nbsp;";
						$user_button = $_SESSION['logged_in'] && !areAllAuthorsAnId($creator) ? "<a class=\"btn btn-warning btn-block text-nowrap\" href=\"/hacks/claim.php?hack_id=$id\"><svg xmlns=\"http://www.w3.org/2000/svg\" width=\"24\" height=\"24\" fill=\"currentColor\" class=\"bi bi-person-up\" viewBox=\"0 0 16 16\" part=\"svg\">
						<path d=\"M12.5 16a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7Zm.354-5.854 1.5 1.5a.5.5 0 0 1-.708.708L13 11.707V14.5a.5.5 0 0 1-1 0v-2.793l-.646.647a.5.5 0 0 1-.708-.708l1.5-1.5a.5.5 0 0 1 .708 0ZM11 5a3 3 0 1 1-6 0 3 3 0 0 1 6 0ZM8 7a2 2 0 1 0 0-4 2 2 0 0 0 0 4Z\"></path>
						<path d=\"M8.256 14a4.474 4.474 0 0 1-.229-1.004H3c.001-.246.154-.986.832-1.664C4.484 10.68 5.711 10 8 10c.26 0 .507.009.74.025.226-.341.496-.65.804-.918C9.077 9.038 8.564 9 8 9c-5 0-6 3-6 4s1 1 1 1h5.256Z\"></path>
					  </svg></a>" : "&nbsp;";

						$authors = explode(", ", $creator);
						$hack_author = "";
						foreach($authors as $author) {
						  $user = getUserFromDatabase($pdo, $author);
						  if($user) $hack_author = $hack_author . $user['discord_username'] . ', ';
						  else $hack_author = $hack_author . $author . ', ';
						}
						$hack_author = substr_replace($hack_author, '', -2);
			   
                        print "<tr><td $admin_HTMLLoad>$id</td><td>$hack_name</td><td>$version</td><td><u><a href=download.php?hack_id=$id>Download</a></u><br/><small class=\"text-muted\">Downloads: $download</small></td><td>$hack_author</td><td>$amount</td><td>$date</td><td $admin_HTMLLoad>$tag</td><td class=\"border-0\">$user_button</td><td class=\"border-0\">$admin_buttons</td></tr>\n";
                    }?>
			    </table></div> <br/>
                <div><table>
					<?php
						$description_button_text = strlen($data[0]['hack_description']) == 0 ? "Add Description" : "Edit Description";
						$description_button = ($_SESSION['logged_in'] && in_array($_SESSION['userData']['discord_id'], ADMIN_SITE)) ? "<a class=\"btn btn-primary text-nowrap\" href=\"editHack.php?hack_name=$hack_name\">$description_button_text</a>" : "&nbsp;";

					?>
                    <tr><td class="align-top text-right"><?php print($description_button);?></td></tr>
                <tr><td class="bg-dark" id="hack_description"><?php $hack_description = $data[0]['hack_description']; print($hack_description); ?></td>
                </tr></table></div>

			<?php include($_SERVER['DOCUMENT_ROOT'].'/_includes/footer.php'); ?>
				</div>		</div>
		</body>
	</html>