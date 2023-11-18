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
					<?php
					print "<h1><u>$hack_name</u></h1>";
		        	print "<table id='myTable' border=1 align=center>";
			        print "<tr><th><b>Hack ID</b></th><th><b>Hackname</b></th><th>Version</th><th><b>Downloadlink</b></th><th><b>Creator</b></th><th><b>Starcount</b></th><th>Date (Format: yyyy-mm-dd)</tr>";
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
                        print "<tr><td>$id</td><td>$hack_name</td><td>$version</td><td><u><a href=$ref>Download</a></u></td><td>$creator</td><td>$amount</td><td>$date</td></tr>";
                    }
			    print "</table>";?> <br/>
                <div><table>
					<?php
						$description_button = ($_SESSION['logged_in'] && in_array($_SESSION['userData']['discord_id'], ADMIN_SITE)) ? "<a class=\"btn btn-primary text-nowrap\" href=\"editHack.php?hack_name=$hack_name\">Edit Description</a>" : "&nbsp;";

					?>
                    <tr><td class="align-top text-right"><?php print($description_button);?></td></tr>
                <tr><td class="bg-dark" id="hack_description"><?php $hack_description = $data[0]['hack_description']; print($hack_description); ?></td>
                </tr></table></div>

			<?php include($_SERVER['DOCUMENT_ROOT'].'/_includes/footer.php'); ?>
				</div>		</div>
		</body>
	</html>