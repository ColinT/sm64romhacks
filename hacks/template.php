<?php 
if($_SESSION['logged_in'] && (in_array($_SESSION['userData']['discord_id'], ADMIN_SITE))) {
	$admin_HTMLLoad = "&nbsp;<a class=\"btn btn-danger text-nowrap\" href=\"deleteHack.php?hack_name=$hack_name\"><img src=\"/_assets/_img/icons/delete.svg\"></a>&nbsp;<a class=\"btn btn-info text-nowrap\" href=\"editHack.php?hack_name=$hack_name\"><img src=\"/_assets/_img/icons/edit.svg\"></a>";
}
?>
<!DOCTYPE HTML>
	<html>
		<!--BEGINNING OF HEAD-->
		<head
		xmlns:og="https://ogp.me/ns#"
		xmlns:website="https://ogp.me/ns/website#"
		>
			<title>sm64romhacks - <?php print($hack_name);?></title>
			<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
			<meta name="keywords" content="super mario, romhacks, hack, speedrun, sm64hacks, sm64romhacks, rom, modification" />
			<meta name="description" content="Welcome to SM64ROMHacks! We have a really big collection of SM64 ROM Hacks which wait to be played! Community News/Events will also be tracked here" />

			<meta property="og:title" content="sm64romhacks - <?php print($hack_name);?>" />
			<meta property="og:type" content="website" />
			<meta property="og:url" content="https://sm64romhacks.com/hacks/<?php print(getURLEncodedName($hack_name));?>" />
			<?php 
				$images = (glob($_SERVER['DOCUMENT_ROOT'] . "/_assets/_img/hacks/img_" . stripChars(getURLEncodedName($hack_name)) . "_*.{png,jpg}", GLOB_NOSORT|GLOB_BRACE));
				foreach($images as $image) {
					$image = explode("/",$image)[sizeof(explode("/",$image)) - 1];
					$ext = substr($image, -3);
					$image = substr_replace($image, "", -4);
					print("<meta property=\"og:image:url\" content=\"https://sm64romhacks.com/_assets/_img/hacks/$image.$ext\" />\n\t\t\t");
					print("<meta property=\"og:image:type\" content=\"image/$ext\" />\n\t\t\t");
					print("<meta property=\"og:image:height\" content=\"120\" />\n\t\t\t");
					print("<meta property=\"og:image:width\" content=\"160\" />\n\t\t\t");
				}
			?>
			<meta property="og:site_name" content="sm64romhacks.com" />
			<meta property="og:description" content="<?php print($data[0]['hack_description']);?>" />

			<!-- Twitter Meta Tags -->
			<meta name="twitter:card" content="summary_large_image">
			<meta property="twitter:domain" content="sm64romhacks.com">
			<meta property="twitter:url" content="https://sm64romhacks.com/hacks/<?php print(getURLEncodedName($hack_name));?>">
			<meta name="twitter:title" content="sm64romhacks - <?php print($hack_name);?>">
			<meta name="twitter:description" content="<?php print($data[0]['hack_description']);?>">
			<?php
			foreach($images as $image) {
					$image = explode("/",$image)[sizeof(explode("/",$image)) - 1];
					$ext = substr($image, -3);
					$image = substr_replace($image, "", -4);
					print("<meta property=\"twitter:image\" content=\"https://sm64romhacks.com/_assets/_img/hacks/$image.$ext\" />\n\t\t\t");
				}
			?>
			
			<link rel="stylesheet" type="text/css" href="/_assets/_css/bootstrap.css">
			<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
			<link rel="shortcut icon" href="/_assets/_img/icon.ico" />
			<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
			<script src="template.js"></script>
		</head>
		<body>		<div class="container">
		<?php include($_SERVER['DOCUMENT_ROOT'].'/_includes/header.php'); ?>

				<div align="center">
					<!--HTML CONTENT HERE-->
					<h1><u><?php print($hack_name);?></u><?php print($admin_HTMLLoad);?></h1>
					<div id="hacksCollection">
						<div class="table-responsive"></div>
					</div>
						<div class="text-nowrap" id="hacksImages"></div>
				<br/>
				
                <div class="bg-dark text-left" id="hacksDescription"></div>
                </div>

			<?php include($_SERVER['DOCUMENT_ROOT'].'/_includes/footer.php'); ?>
				</div>		</div>
		</body>
	</html>