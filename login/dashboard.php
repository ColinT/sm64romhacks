<?php

include($_SERVER['DOCUMENT_ROOT'].'/_includes/includes.php');


if(!$_SESSION['logged_in']){
  header('Location: /404.php');
  exit();
}
extract($_SESSION['userData']);

$avatar_url = "https://cdn.discordapp.com/avatars/$discord_id/$avatar.jpg";


?>
<!DOCTYPE HTML>
<html>
	<!--BEGINNING OF HEAD-->
	<head>
		<title>sm64romhacks - Dashboard</title> <!--CHANGE TITLE-->
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<meta name="keywords" content="super mario, romhacks, hack, speedrun, sm64hacks, sm64romhacks, rom, modification" />
		<meta name="description" content="Welcome to SM64ROMHacks! We have a really big collection of SM64 ROM Hacks which wait to be played! Community News/Events will also be tracked here" />
		<link rel="stylesheet" type="text/css" href="/_css/bootstrap.css">
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
		<link rel="shortcut icon" href="/_img/icon.ico" />
		<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
	</head>
<body>
  <div class="container">
    <?php include($_SERVER['DOCUMENT_ROOT'].'/_includes/header.php'); ?>
    <div class="flex items-center justify-center h-screen bg-discord-gray flex-col">
      <div class="text-white text-3xl"><img src=<?php print($avatar_url);?> height=32 width=32 /> <?php print($name);?></div>
      <div class="table-responsive">
        <table class="table table-bordered">
          <tr><th>Hackname</th><th>Creator</th><th>Initial Release Date</th></tr>
          <?php
          
          $data = getHackByUserFromDatabase($pdo, $discord_id);
          foreach($data as $entry) { 
            $hack_name = $entry['hack_name'];
            $dir_name = getURLEncodedName($hack_name);
  
            $hack_author = $entry['author'];
            $authors = explode(", ", $hack_author);
            $hack_author = "";
            foreach($authors as $author) {
              $user = getUserFromDatabase($pdo, $author);
              if($user) $hack_author = $hack_author . $user['discord_username'] . ', ';
              else $hack_author = $hack_author . $author . ', ';
            }
            $hack_author = substr_replace($hack_author, '', -2);

            $hack_release_date = $entry['release_date'];
              ?>
            <tr><td><a href="/hacks/<?php print($dir_name);?>"><?php print($hack_name);?></a></td><td><?php print($hack_author);?></td><td><?php print($hack_release_date);?></td></tr>
          <?php }?>
        </table>
      </div>
    </div>
    <?php include($_SERVER['DOCUMENT_ROOT'].'/_includes/footer.php'); ?>
</div>

</body>
</html>