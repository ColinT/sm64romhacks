<?php

include $_SERVER['DOCUMENT_ROOT'].'/_includes/includes.php';

?>


<!DOCTYPE HTML>
<html>
	<head>
		<title>sm64romhacks - Megapack</title>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<meta name="keywords" content="super mario, romhacks, hack, speedrun, sm64hacks, sm64romhacks, rom, modification megapack" />
		<meta name="description" content="Welcome to SM64ROMHacks! We have a really big collection of SM64 ROM Hacks which wait to be played! Community News/Events will also be tracked here" />
		<link rel="stylesheet" type="text/css" href="../_css/bootstrap.css">
		<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
		<link rel="shortcut icon" href="../_img/icon.ico" />
		<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
	</head>
	<body>		<div class="container">
	<?php include($_SERVER['DOCUMENT_ROOT'].'/_includes/header.php'); ?>
			<div align="center">
			<h1>Grand ROM Hack Megapack</h1>
			<p>This megapack offers a selection of major Super Mario 64 ROM hacks which are universally considered to be the greatest. This is in hope to provide an ideal starter pack which serves as an easily accessible introduction to the world of ROM hacks.</p>
			<i>Contens of this page was last updated: 2023-06-30 (yyyy-mm-dd)</i>
			<table><tr><td><div class="btn-group-lg"><a class="btn btn-primary" href="Grand%20Rom%20Hack%20Megapack%202023%20(Summer Edition).zip" style="margin-bottom: 24px;">Download Megapack</a></div></td>
			<td><div class="btn-group-lg"><a class="btn btn-primary" href="Grand%20SM64%20Kaizo%20Megapack%202023%20(Summer Edition).zip" style="margin-bottom: 24px;">Download KAIZO Megapack</a></div></td></tr></table>
			It is differentiated between Hacks with <a href="https://sm64romhacks.com/megapack/?difficulty=easy">easy</a>, <a href="https://sm64romhacks.com/megapack/?difficulty=normal">normal</a>, <a href="https://sm64romhacks.com/megapack/?difficulty=hard">hard</a> and <a href="https://sm64romhacks.com/megapack/?difficulty=kaizo">kaizo</a> difficulty.

			<?php
				function csvToTable($csvname)
				{
					$csvfile=file($csvname);
					$sep=",";
					print "<table border=1 width=100%>";
					print "<tr><th width=33%>Name</th><th width=47%>Creator</th><th width=10%>Star Count</th><th width=10%>Release Date</th></tr>\n";
					foreach($csvfile as $lines)
					{
						print "<tr>";
						$elements=explode($sep,$lines);
						foreach($elements as $element)
						{
							print "<td>$element</td>";
						}
						print "</tr>";
					}
					print "</table>";
				}

				function getDescription($file)
				{
					return file_get_contents($file);
				}
				
				$difficulty=$_GET['difficulty'];
				if(!isset($difficulty) || $difficulty!="easy" && $difficulty!="normal" && $difficulty!="hard" && $difficulty!="kaizo")
				{
					$difficulty="all difficulties";
				}
				print "<p style=\"margin-bottom: 24px;\"><b>Table of included hacks ($difficulty):</b></p>";
				if($difficulty=="easy")
				{
                    print '<h5>Normal Mega Pack hacks</h5>';
					csvToTable("easy.csv");
				}
				else if($difficulty=="normal")
				{
                    print '<h5>Normal Mega Pack hacks</h5>';
					csvToTable("normal.csv");
				}
				else if($difficulty=="hard")
				{
                    print '<h5>Normal Mega Pack hacks</h5>';
					csvToTable("hard.csv");
				}
				else if($difficulty=="kaizo")
				{
                    print '<h5>Kaizo Mega Pack hacks</h5>';
					csvToTable("kaizo.csv");
				}
				else
				{
                    print '<h5>Normal Mega Pack hacks</h5>';
					csvToTable("megapack.csv");
                    print '<br/><br/>';
                    print '<h5>Kaizo Mega Pack hacks</h5>';
                    csvToTable("kaizo.csv");
				}
				include($_SERVER['DOCUMENT_ROOT'].'/_includes/footer.php'); ?>
				
	</div>				
	</body>
</html>