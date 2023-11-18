<?php

include $_SERVER['DOCUMENT_ROOT'].'/_includes/includes.php';


session_start();
if(!$_SESSION['logged_in'] || !in_array($_SESSION['userData']['discord_id'], ADMIN_NEWS)) {
	header("Location: /login/error.php");
	die();
}

$data = getHackFromDatabase($pdo, $_GET['hack_name']);
?>
<!DOCTYPE HTML>
<html>
	<!--BEGINNING OF HEAD-->
	<head>
		<title>sm64romhacks - Add Hack</title> <!--CHANGE TITLE-->
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<meta name="keywords" content="super mario, romhacks, hack, speedrun, sm64hacks, sm64romhacks, rom, modification" />
		<meta name="description" content="Welcome to SM64ROMHacks! We have a really big collection of SM64 ROM Hacks which wait to be played! Community News/Events will also be tracked here" />
		<link rel="stylesheet" type="text/css" href="/_css/bootstrap.css">
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
		<link rel="shortcut icon" href="/_img/icon.ico" />
        <script src="index.js"></script>
		<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
	</head>
	<body>		<div class="container">
	<?php include($_SERVER['DOCUMENT_ROOT'].'/_includes/header.php'); ?>
			<div align="center">
                <form action="/hacks/updateHack.php" method="post">
                    <table class="table">
                    <tr>
                        <td class="text-right">
                            <label for="hack_name" class="col-form-label text-nowrap">Hack Name:</label>
                        </td>
                        <td>
                            <input type="hidden" class="form-control" name="hack_name" id="hack_name" value="<?php print($data[0]['hack_name']); ?>">  
                            <input type="text" class="form-control" value="<?php print($data[0]['hack_name']); ?>" disabled>  
                        </td>
                    </tr>
                    <tr>
                    <td class="text-right">
                        <label for="hack_description" class="col-form-label text-nowrap">Description:</label>
                        </td>
                        <td colspan=3>
                            <textarea name="hack_description" class="form-control" rows="10" required><?php print(str_replace('<br/>', "\r\n", $data[0]['hack_description']));?></textarea>
                        </td>
                    </tr>
                    <tr>
                        <td>&nbsp;</td>
                        <td class="text-center"><button type="submit" class="btn btn-secondary align-middle">Add Hack!</button></td>
                    </tr>
                    </table>
                </form>
                </div>
				<?php include($_SERVER['DOCUMENT_ROOT'].'/_includes/footer.php'); ?>
			</div>		</div>
	</body>
</html>