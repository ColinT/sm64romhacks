<!DOCTYPE HTML>
<html>
	<!--BEGINNING OF HEAD-->
	<head>
		<title>sm64romhacks - Patches</title> <!--CHANGE TITLE-->
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<meta name="keywords" content="super mario, romhacks, hack, speedrun, sm64hacks, sm64romhacks, rom, modification" />
		<meta name="description" content="Welcome to SM64ROMHacks! We have a really big collection of SM64 ROM Hacks which wait to be played! Community News/Events will also be tracked here" />
		<link rel="stylesheet" type="text/css" href="/_css/bootstrap.css">
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
		<link rel="shortcut icon" href="/_img/icon.ico" />
		<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
		<script src="/hacks/index.js"></script>

	</head>
	<body>		<div class="container">
	<?php include($_SERVER['DOCUMENT_ROOT'].'/_includes/header.php'); ?>
			<div align="center">
				<!--HTML CONTENT HERE-->
				<input type="text" id="hackNamesInput" placeholder="Search for hacknames.."/><input type="text" id="authorNamesInput" placeholder="Search for hackcreators.." style="align-self: center;" /><input type="text" id="hackDatesInput" placeholder="Search for Date (yyyy-mm-dd)..." style="align-self: center; width: 215px;"/>
				<select id=tagInput>
					<option value="">Select a Tag</option>
					<?php 
						$all_tags = getAllTagsFromDatabase($pdo);
						foreach($all_tags as $tag) {
							$tag = $tag['hack_tags'];
							print("<option value=\"$tag\">$tag</option>");
						}
					?>
				</select>	
				<a class="btn btn-primary" href="/hacks/random.php">Random</a><br/><br/>


				<div class="table-responsive">
				<table class="table-sm table-bordered" id="myTable">
					<?php $add_button = ($_SESSION['logged_in'] && in_array($_SESSION['userData']['discord_id'], ADMIN_SITE)) ? "<a class=\"btn btn-success btn-block text-nowrap\" href=\"addHack.php\">Add Hack</a>" : "&nbsp;"; ?>

					<tr><th><b>Hackname</b></th><th class="creator"><b>Creator</b></th><th class="text-nowrap"><b>Initial Release Date</b></th><th hidden><b>Tag</b></th><th class="border-0"><?php print($add_button);?></th></tr>
				<?Php 
				$amount = getAmountOfHacksInDatabase($pdo)[0]['count'];
				if($amount == 0){
					$a_patch=file($_SERVER['DOCUMENT_ROOT']. "/_data/patches.csv");
					foreach($a_patch as $patch)
					{
						list($name, $version, $creator, $amount, $date, $dl, $tag)=explode(',',$patch);
						$creator = explode(" & ", $creator);
						$authors = "";
						foreach($creator as $author) {
							$authors = $authors . $author . ', ';
						}
						$authors = substr_replace($authors, '', -2);
						$creator = $authors;
						$tag=str_replace("\n", "", $tag);
						$tag=substr_replace($tag, "", -1);
						$description="";
						if(strlen($date) == 0) $date = "9999-12-31";
						addHackToDatabase($pdo, $name, $version, $creator, $amount, $date, $dl, $tag,$description);
					}	
				}
				$data = (getAllUniqueHacksFromDatabase($pdo));
				foreach($data as $entry) {
					$hack_name = $entry['hack_name'];
					$dir_name = getURLEncodedName($hack_name);

					$hack_author = $entry['author'];
					$hack_release_date = $entry['release_date'];
					$hack_tags = $entry['hack_tags'];

					$delete_button = ($_SESSION['logged_in'] && in_array($_SESSION['userData']['discord_id'], ADMIN_SITE)) ? "<a class=\"btn btn-danger btn-block text-nowrap\" href=\"deleteHack.php?hack_name=$hack_name\">Delete Hack</a>" : "&nbsp;";
					print("<tr><td><a href=\"/hacks/$dir_name\">$hack_name</a></td><td class=\"creator\">$hack_author</td><td>$hack_release_date</td><td hidden>$hack_tags</td><td class=\"border-0\">$delete_button</td></tr>\n");
				}
				?>
				</table>
			</div>
	<?php include($_SERVER['DOCUMENT_ROOT'].'/_includes/footer.php'); ?>
			</div>		</div>
	</body>
</html>