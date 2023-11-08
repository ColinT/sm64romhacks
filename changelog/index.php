<!DOCTYPE HTML>
<html>
	<!--BEGINNING OF HEAD-->
	<head>
		<title>sm64romhacks - DOCUMENT TITLE</title> <!--CHANGE TITLE-->
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<meta name="keywords" content="super mario, romhacks, hack, speedrun, sm64hacks, sm64romhacks, rom, modification" />
		<meta name="description" content="Welcome to SM64ROMHacks! We have a really big collection of SM64 ROM Hacks which wait to be played! Community News/Events will also be tracked here" />
		<link rel="stylesheet" type="text/css" href="../_css/bootstrap.css">
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
		<link rel="shortcut icon" href="../_img/icon.ico" />
		<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
	</head>
	<body>		<div class="container">
			<?php include '../header.php'; ?>
			<div align="center">
				<!--HTML CONTENT HERE-->
				<?php
					function parseLog($log) {
						$history = array();
						foreach($log as $data) {
							array_push($history, array("message" => $data["commit"]["message"], "date" => $data["commit"]["committer"]["date"]));
						}
						return $history;
					}

					$url = "https://api.github.com/repos/marvjungs/sm64romhacks/commits";
					$ch = curl_init();

					curl_setopt($ch, CURLOPT_URL, $url);
					curl_setopt($ch, CURLOPT_HEADER, FALSE);
					curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
					curl_setopt($ch, CURLOPT_HTTPHEADER, array("User-Agent: Test"));
					$head = curl_exec($ch);
					$head = json_decode($head, true);
					curl_close($ch);

					?>
					<table border=1><tr><td>Date</td><td>Change</td></tr>
					<?php
					foreach(parseLog($head) as $change){
						print("<tr><td>" . $change["date"] . "</td><td>" . $change["message"]. "</td></tr>");
						}
					?>
					</table>

			<?php include '../footer.php'; ?>	
			</div>		</div>
	</body>
</html>