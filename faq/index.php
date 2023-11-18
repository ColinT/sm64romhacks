<?php

include $_SERVER['DOCUMENT_ROOT'].'/_includes/includes.php';

?>


<!DOCTYPE HTML>
<html>
<head>
<title>sm64romhacks - Patches</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="keywords" content="super mario, romhacks, hack, speedrun, sm64hacks, sm64romhacks, rom, modification" />
<meta name="description" content="Welcome to SM64ROMHacks! We have a really big collection of SM64 ROM Hacks which wait to be played! Community News/Events will also be tracked here" />
<link rel="stylesheet" type="text/css" href="/_css/bootstrap.css">
<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
<link rel="shortcut icon" href="/_img/icon.ico" />
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
</head>

<body>
<div class="container">
<?php include($_SERVER['DOCUMENT_ROOT'].'/_includes/header.php'); ?>
<div align=center>
<h5>Q: What is a bps file?</h5>
<h5>A: It is technically illegal to provide links to contents that belong to Nintendo, which includes every copy of Super Mario 64. A BPS file contains the differences between an original Super Mario 64 ROM and a ROM hack. This way, we can legally share ROM hacks, but anyone who wants to play them needs to find an original Super Mario 64 ROM on their own.</h5>
<br/>
<h5>Q: How do I patch a bps file?</h5>
<h5>For this, you will need a patch program (we highly recommend the program "flips") and the original Super Mario 64 ROM. It has to be the US version, called "Super Mario 64 [U] [!].z64".
You want to open flips and click on "Apply Patch". Now find and select the BPS file of the ROM hack you want to play.
Next, select the UNMODIFIED Super Mario 64 ROM (US version). Finally, you can select a location where you want to save the file. If done correctly, flips will tell you that the patch was applied successfully.
Alternatively, check out Tomatobird8's Tutorial:<br/> <iframe width="560" height="315" src="https://www.youtube.com/embed/dDNMz2SyGtY" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe></h5>
<br/>
<h5>Q: Troubleshooting</h5>
<h5>A: "Attempt to open a zip file failed. Missing or corrupt zip file - check path and file.<br/>You may need to restart the application."<br/><i><font color=red>It is usually caused by opening a zip-file in the emulator. Open the zip-File and check what it is in it and make sure there is only a .z64 in it. If you're still getting that error, get a clean patch file and patch it again.</i></font><br/><br/>
"File loaded does not appear to be a valid Nintendo64 ROM.<br/>Verify your ROMs with GoodN64."<br/><i><font color=red>You tried opening a bps-File instead of opening a .z64-file.</font><br/><br/>
I got a blackscreen without sound after booting up the ROM<br/><i><font color=red>Check your Emulator Settings, make sure your Memory Size is set to 8MB, if not then set it to 8MB and restart</i></font><br/><br/>
</h5>
<br/>
<h5>Q: My Project64 shows a Blackscreen when opening the z64 file, how do I fix this?</h5>	
<h5>A: If you are using Project 64 1.6 (which is highly recommended), go to "Options" --> "Settings" --> "Options" and uncheck "Hide Advanced Settings". 
Then, go to "Advanced" and set the "Default Memory Size" to 8MB. Furthermore, it is recommended to set the counter factor to 1 under "Rom Settings" for a better gameplay experience. However, the counter factor needs to be changed for each ROM individually.<br/>
For further questions, make sure to join the <a href=https://discord.gg/BYrpMBG> <u>sm64romhacks Discord Server</u></a><br/><br/>
</div>
<?php include($_SERVER['DOCUMENT_ROOT'].'/_includes/footer.php'); ?>
</body>
</html>