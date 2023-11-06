<!DOCTYPE HTML>
<html>
	<!--BEGINNING OF HEAD-->
	<head>
		<title>sm64romhacks - Megapack</title> <!--CHANGE TITLE-->
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<meta name="keywords" content="super mario, romhacks, hack, speedrun, sm64hacks, sm64romhacks, rom, modification" />
		<meta name="description" content="Welcome to SM64ROMHacks! We have a really big collection of SM64 ROM Hacks which wait to be played! Community News/Events will also be tracked here" />
		<link rel="stylesheet" type="text/css" href="../_css/bootstrap.css">
		<link rel="shortcut icon" href="../_img/icon.ico" />
	</head>
	<body>		<div class="container">
			<?php include '../header.php'; ?>
			<div align="center">
			<h1>Curated Hacks Megapack</h1>
			<p>These ROM Hack patch packs include curated ROM Hacks based on the Categorial Separation of ROM Hacks by FrostyZako as well as the ROM Hack community's opinion.<br>The packs were proposed and planned by FrostyZako and compiled by Tomatobird8.</p>
			<p style="margin-top:10px;">Packs will not be updated as frequently as the hacks list! For the latest hacks, go back to the hacks list and sort by date!</p>
			<hr>
			<h3>Curated Hacks Pack</h3>
			<hr>
			<p style="margin-top:30px;">This pack is recommended for anyone new to ROM Hacks.</p>
			<a class="btn btn-primary disabled" href="Curated%20Hacks%20Pack.7z">Download Curated Hacks Pack</a>
			<p style="margin-top:20px;margin-bottom:20px;"><b>Last updated: None.</b></p>
			<hr>
			<h3>Pro Pack</h3>
			<hr>
			<p style="margin-top:30px;">All of the notable and popular hacks are included in this edition of the megapack. This pack is recommended for those more involved into ROM Hack gaming as it also includes more extreme hacks and lower tier hacks based on the Categorical Separation list.</p>			<a class="btn btn-primary" href="Curated%20Hacks%20Pro%20Pack.7z">Download Pro Pack</a>
			<p style="margin-top:20px;color:darkgoldenrod;">Extracting this compressed folder most likely requires a third party program.<br>Examples are 7-zip or WinRAR for Windows, The Unarchiver for Mac OS and WinRAR for Android.</p>
			<p style="margin-bottom:20px;"><b>Last updated: 21st of October 2020.</b></p>
			<?php //needs better layout
			$a_pack=file("versions.csv");
			$sep=",";
			$versions=array();
			print "<table border=1 width=100%>";
			print "<tr><th>Hackname</th><th>Recommened Version</th><th colspan=10>Other Versions</th></tr>\n";
			foreach($a_pack as $pack)
			{
				$versions=explode($sep,$pack);
				$style="";
				print "<tr>";
				// while(count($versions)<5)
				// {
					// array_push($versions,"");
				// }
				for($i=0;$i<count($versions);$i++)
				{
					// if($i==0)
					// {
						// $style="width=50%";
					// }
					if($i==1)
					{
						$style="bgColor=darkslategray";
					}
					// if($i>1)
					// {
						// $style="colspan=$span";
					// }
					print "<td $style>$versions[$i]</td>";
					$style="";
				}
				print "</tr>\n";
			}
			print "</table>";
			?>
			<?php include '../footer.php'; ?>	
			</div>		</div>
	</body>
</html>