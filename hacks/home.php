<?php 
$add_button = ($_SESSION['logged_in']) ? "<a class=\"btn btn-success text-nowrap\" href=\"addHack.php\"><img src=\"/_assets/_img/icons/add.svg\"></a>" : "&nbsp;"; 
$amount = getAmountOfHacksInDatabase($pdo)[0]['count'];
if($amount == 0){
	$a_patch=file($_SERVER['DOCUMENT_ROOT']. "/_assets/_data/patches.csv");
	$hack_id = 1;
	foreach($a_patch as $patch)
	{
		list($name, $version, $creator, $amount, $date, $dl, $tag)=explode(',',$patch);
		$tag=str_replace("\n", "", $tag);
		$tag=substr_replace($tag, "", -1);
		$description="";
		if(strlen($date) == 0) $date = "9999-12-31";
		addHackToDatabase($pdo, $name, $version, $amount, $date, $dl, $tag,$description, 1, 0);
		
		$creator = explode(" & ", $creator);
		foreach($creator as $author) {
			if(sizeof(getAuthorFromDatabase($pdo, $author)) == 0) addAuthorToDatabase($pdo, $author);
			$author_id = getAuthorFromDatabase($pdo, $author)[0]['author_id'];
			addHackAuthorToDatabase($pdo, $hack_id, $author_id);
		}
		$hack_id++;
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
		<script src="/hacks/home.js?t=<?php print(filemtime('home.js')); ?>"></script>

	</head>
	<body>		
	<div class="container">

	<?php include($_SERVER['DOCUMENT_ROOT'].'/_includes/header.php'); ?>
			<div align="center">
				<!--HTML CONTENT HERE-->
				<input type="text" id="hackNamesInput" placeholder="Search for hacknames.."/><input type="text" id="authorNamesInput" placeholder="Search for hackcreators.." style="align-self: center;" /><input type="text" id="hackDatesInput" placeholder="Search for Date (yyyy-mm-dd)..." style="align-self: center; width: 215px;"/>
				<select class="form-select form-select-sm" id=tagInput>
					<option value="">Select a Tag</option>
				</select>	
				<a class="btn btn-primary" href="/hacks/random.php">Random</a><br/><br/>

					<div class="table-responsive" id="hacksCollection"></div>
	<?php include($_SERVER['DOCUMENT_ROOT'].'/_includes/footer.php'); ?>
			</div>		</div>
	</body>
</html>