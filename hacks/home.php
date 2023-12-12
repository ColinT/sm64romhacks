<?php 
$add_button = ($_SESSION['logged_in']) ? "<a class=\"btn btn-success text-nowrap\" href=\"addHack.php\"><img src=\"/_assets/_img/icons/add.svg\"></a>" : "&nbsp;"; 
$amount = getAmountOfHacksInDatabase($pdo)[0]['count'];
writeJson($pdo);
if($amount == 0){
	$a_patch=file($_SERVER['DOCUMENT_ROOT']. "/_assets/_data/patches.csv");
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
		addHackToDatabase($pdo, $name, $version, $creator, $amount, $date, $dl, $tag,$description, 1, 0);
	}

}
?>

<!DOCTYPE HTML>
<html>
	<!--BEGINNING OF HEAD-->
	<head>
		<title>sm64romhacks - Patches</title> <!--CHANGE TITLE-->
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<meta name="keywords" content="super mario, romhacks, hack, speedrun, sm64hacks, sm64romhacks, rom, modification" />
		<meta name="description" content="Welcome to SM64ROMHacks! We have a really big collection of SM64 ROM Hacks which wait to be played! Community News/Events will also be tracked here" />
		<link rel="stylesheet" type="text/css" href="/_assets/_css/bootstrap.css">
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
		<link rel="shortcut icon" href="/_assets/_img/icon.ico" />
		<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
		<script src="/hacks/index.js"></script>

	</head>
	<body>		
	<div class="container">

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
							$tag = explode(", ", $tag);
							foreach($tag as $t) { ?>
							<option value="<?php print($t);?>"><?php print($t);?></option>
					<?php }
						}
					?>
				</select>	
				<a class="btn btn-primary" href="/hacks/random.php">Random</a><br/><br/>


					<div class="table-responsive" id="hacksCollection"></div>
				<?php 

				$data = (getAllUniqueHacksFromDatabase($pdo));
				for($i = 1; $i < sizeof($data); $i++) {

				}
				/*foreach($data as $entry) {
					$hack_name = $entry['hack_name'];
					$dir_name = getURLEncodedName($hack_name);

					$hack_author = $entry['author'];
					$hack_release_date = $entry['release_date'];
					$hack_tags = $entry['hack_tags'];

					$total_downloads = getTotalDownloadCountForHackFromDatabase($pdo, $hack_name)[0]['total_downloads'];

					$authors = explode(", ", $hack_author);
						$hack_author = "";
						foreach($authors as $author) {
						  $user = getUserFromDatabase($pdo, $author);
						  if($user) $hack_author = $hack_author . '<a href="/users/' . $author . '">' . $user['discord_username'] . '</a>, ';
						  else $hack_author = $hack_author . $author . ', ';
						}
						$hack_author = substr_replace($hack_author, '', -2);

					$delete_button = ($_SESSION['logged_in'] && (in_array($_SESSION['userData']['discord_id'], ADMIN_SITE) || str_contains($hack_author, $_SESSION['userData']['discord_id']))) ? "<a class=\"btn btn-danger btn-block text-nowrap\" href=\"deleteHack.php?hack_name=$hack_name\"><img src=\"/_assets/_img/icons/delete.svg\"></a>" : "&nbsp;";
					$edit_button = ($_SESSION['logged_in'] && (in_array($_SESSION['userData']['discord_id'], ADMIN_SITE) || str_contains($hack_author, $_SESSION['userData']['discord_id']))) ? "<a class=\"btn btn-info btn-block text-nowrap\" href=\"editHack.php?hack_name=$hack_name\"><img src=\"/_assets/_img/icons/edit.svg\"></a>" : "&nbsp;";

					//print("<tr><td><a href=\"/hacks/$dir_name\">$hack_name</a></td><td class=\"creator\">$hack_author</td><td>$hack_release_date</td><td class=\"text-nowrap text-muted\">Downloads: $total_downloads</td><td hidden>$hack_tags</td><td class=\"border-0\">$edit_button</td><td class=\"border-0\">$delete_button</td></tr>\n");
				}*/
				?>
	<?php include($_SERVER['DOCUMENT_ROOT'].'/_includes/footer.php'); ?>
			</div>		</div>
			<script type="text/javascript">
				function addButtons() {
				document.getElementById('myTable')['rows'][0]['cells'][5].innerHTML = '<?php print($add_button);?>'
				<?php $i = 1; ?>
				for(i = 1; i < document.getElementById('myTable')['rows'].length; i++) {
					<?php
						$hack_author = getAllUniqueHacksFromDatabase($pdo)[$i]['author'];
						$delete_button = ($_SESSION['logged_in'] && (in_array($_SESSION['userData']['discord_id'], ADMIN_SITE) || str_contains($hack_author, $_SESSION['userData']['discord_id']))) ? "<a class=\"btn btn-danger btn-block text-nowrap\" href=\"deleteHack.php?hack_name=$hack_name\"><img src=\"/_assets/_img/icons/delete.svg\"></a>" : "&nbsp;";
						$edit_button = ($_SESSION['logged_in'] && (in_array($_SESSION['userData']['discord_id'], ADMIN_SITE) || str_contains($hack_author, $_SESSION['userData']['discord_id']))) ? "<a class=\"btn btn-info btn-block text-nowrap\" href=\"editHack.php?hack_name=$hack_name\"><img src=\"/_assets/_img/icons/edit.svg\"></a>" : "&nbsp;";
						$i++;
					?>
					document.getElementById('myTable')['rows'][i]['cells'][5].innerHTML = '<?php print($delete_button);?>'
					document.getElementById('myTable')['rows'][i]['cells'][6].innerHTML = '<?php print($edit_button);?>'
				}
				}
				</script>
	</body>
</html>