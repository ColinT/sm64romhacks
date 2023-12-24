<?php

include $_SERVER['DOCUMENT_ROOT'].'/_includes/includes.php';

?>
<!DOCTYPE HTML>
<html>
<!--BEGINNING OF HEAD-->
	<head>
		<title>sm64romhacks - Online Patcher</title>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<meta name="keywords" content="super mario, romhacks, hack, speedrun, sm64hacks, sm64romhacks, rom, modification" />
		<meta name="description" content="Welcome to SM64ROMHacks! We have a really big collection of SM64 ROM Hacks which wait to be played! Community News/Events will also be tracked here" />
		<link rel="stylesheet" type="text/css" href="/_assets/_css/bootstrap.css">
		<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
		<link rel="shortcut icon" href="/_assets/_img/icon.ico" />
		<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
	</head>
<!--END OF HEAD-->
	<body>	
	<div class="container">
	<?php include($_SERVER['DOCUMENT_ROOT'].'/_includes/header.php'); ?>
		<div align="center">
			<h1>Online Patcher</h1>
			<ol>
				<table>
					<tr align="left"><td><li>If you have downloaded a patch from the site, extract the bps-Patch from the zip-File</li></td></tr>
					<tr align="left"><td><li>Select your UNMODIFIED ROM <b>(Make sure it has a <i>.z64</i> extension)</b></li></td></tr>
					<tr align="left"><td><li>Select the bps-Patch you want to apply </li></td></tr>
					<tr align="left"><td><li>Enter the name you want it to save as</li></td></tr>
					<tr align="left"><td><li>Press on "Patch"</li></td></tr>
					<tr align="left"><td><li>Profit!</li></td></tr>				
				</table>
			</ol>
			<embed src="https://hack64.net/tools/patcher.php" style="width:500px; height:400px;" /><hr/>Notice: This tool is not made by us or maintained. All Credits go to the original creator of this tool which can be found over at: <a href="https://hack64.net/tools/patcher.php">https://hack64.net/tools/patcher.php</a><br/><br/>
		</div>
		<?php include($_SERVER['DOCUMENT_ROOT'].'/_includes/footer.php'); ?>
	</div>
</body>
</html>