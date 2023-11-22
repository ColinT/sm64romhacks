<!DOCTYPE HTML>
<html>
<head>
<title>sm64romhacks - Patches</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="keywords" content="super mario, romhacks, hack, speedrun, sm64hacks, sm64romhacks, rom, modification" />
<meta name="description" content="Welcome to SM64ROMHacks! We have a really big collection of SM64 ROM Hacks which wait to be played! Community News/Events will also be tracked here" />
<link rel="stylesheet" type="text/css" href="/_assets/_css/bootstrap.css">
<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
<link rel="shortcut icon" href="/_assets/_img/icon.ico" />
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
</head>

<body>
<div class="container">
<?php include($_SERVER['DOCUMENT_ROOT'].'/_includes/header.php'); ?>
<b>Q: How do I do to play ROM Hacks / What do I need to play ROM Hacks?</b><br/><br/>
A: You need:
<ul>
<li>an unmodified ROM file of the original Super Mario 64 game. We are <b>not allowed</b> to distribute this, so Google is your friend. Its file should have an extension of <b>.z64</b> and a size of <b>8MB</b>. Zip files and .n64 files <b>will not work</b>.</li>
<li>ROM Hacks themselves, which you can find on this website on either the <u><a href="/megapack" target="black">recommended hacks page</a></u> or the <u><a href="/" target="blank">main hacks page</a></u>. They always come in <b>.zip archive files</b>, and are in the form of <b>.bps patch files</b> within them (which are not yet playable by themselves).</li>
<li>a tool to patch .bps files on the original .z64 ROM, called <u><a href="https://www.smwcentral.net/?a=details&id=11474&p=section" target="blank">Floating IPS (Flips)</a></u>.</li>
<li>an emulator for N64 Games. The most widely used one for ROM Hacks is <u><b><a href="http://www.jabosoft.com/downloads/500" target="blank">Project64 v1.6<a></b></u>.</li>
</ul>
Once you have these files, followed this tutorial to learn how to <b>patch the .bps files Using Flips</b>:
<iframe width="560" height="315" src="https://www.youtube.com/embed/dDNMz2SyGtY" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe><br/>
The output file should be another .z64 ROM file but containing the romhack you had downloaded. To play that, install and open Project64. For romhacks to run, you will also need to set the memory size in the emulator to 8MB for each one you play. Here’s how to do that:<br/>
<ul>
<li>Go to "Options" from the top bar &#8594; "Settings…" &#8594; "Options" and there uncheck "Hide Advanced Settings".</li>
<li>Close the window by clicking "OK". You only need to do this part <b>once</b> in total.</li>
<li>Now go back to "Settings…" &#8594; this time go to "Rom Settings".</li>
<li>Here, set "Memory Size" to 8MB (and "Counter Factor" to 1 to reduce lag). Usually you will have to <b>repeat</b> these steps <b>for each ROM individually</b>. Alternatively, you can go to "Advanced" and set the "Default Memory Size" to 8MB, but if your hacks lag you will still want to set the “Counter Factor” to 1 manually.</li>
<li>Restart the ROM you have opened.</li>
</ul><br/>
Congratulations, your romhack should now boot up! Enjoy.<br/><br/>
<b>If you instead got any errors within Flips or Project64 during this process, please check the Troubleshooting section below.</b><br/><br/>
<b>Note:</b><br/>
Another way to apply a patch is by using the online patcher, which you can find at this <u><a href="/patcher" target="blank">page</a></u>. It works much like Flips, however first you need to choose a ROM (the .z64) and on the second field the patch (.bps).<br/><br/><br/>
<b>Q: What are good ROM Hacks to start with?</b><br/>
A: For a list of recommended hacks, click <u><a href="https://docs.google.com/spreadsheets/d/1A6_ixwQSVgJSJUhzYTAi-JcIghoqdRBOFvdGuj1oGmg/edit#gid=452504935" target="blank">here</a></u>. It has ROM Hacks seperated by Quality and Difficulty with most information provided!
<?php include($_SERVER['DOCUMENT_ROOT'].'/_includes/footer.php'); ?>
</body>
</html>