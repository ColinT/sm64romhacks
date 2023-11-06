<!DOCTYPE HTML>
<html>
	<!--BEGINNING OF HEAD-->
	<head>
		<title>sm64romhacks - Plugin Guide</title>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<meta name="keywords" content="super mario, romhacks, hack, speedrun, sm64hacks, sm64romhacks, rom, modification" />
		<meta name="description" content="Welcome to SM64ROMHacks! We have a really big collection of SM64 ROM Hacks which wait to be played! Community News/Events will also be tracked here" />
		<link rel="stylesheet" type="text/css" href="../_css/bootstrap.css">
		<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
		<link rel="shortcut icon" href="../_img/icon.ico" />
		<script src="index.js"></script>
		<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
		<style>
			h1 {text-align: center;}
			 /* Style the button that is used to open and close the collapsible content */
			.collapsible {
			cursor: pointer;
			border: none;
			text-align: left;
			outline: none;
			font-size: 15px;
			}

			/* Style the collapsible content. Note: hidden by default */
			.content {
			padding: 0 18px;
			display: none;
			overflow: hidden;
			text-align: left;
			} 
			.collapsible:after {
			content: '\02795'; /* Unicode character for "plus" sign (+) */
			font-size: 13px;
			color: white;
			float: right;
			margin-left: 5px;
			}

			.active:after {
			content: "\2796"; /* Unicode character for "minus" sign (-) */
			}

			.pro { color: #36c90e;}
			.con { color: #ff4320;}

			li, h3, button { text-align: left;}
		</style>
	</head>
	<body>		<div class="container">
			<?php include '../header.php'; ?>
			<font color="red">PLEASE NOTE THAT THIS DOCUMENT IS WORK IN PROGRESS. Contents will be finished over the course of the next days (as of 05/03/2023)</font>
			Currently finished: All of Windows.
			<div>
				<h1>Plugins for playing SM64 ROM Hacks</h1>
				<div align="center" id="opsys">Firstly, select your operating system for which you intend to play on!
					<table>
						<tr><td><img id="windows" src="../_img/windows.svg" width="360" height="360" onclick="showWindows()"/></td><td><img id="linux" src="../_img/linux.png" width="360" height="360" /></td></tr>
						<tr><td align="center">Windows</td><td align="center">Linux</td></tr>
					</table>
				</div>
				<div id="wcontent" align="center" style="display: none;">
				<table>
						<tr><td><img src="../_img/301.png" onclick="showW301()" /></td><td><img src="../_img/16.png" onclick="showW16()"></td><td><img src="../_img/pl.png" onclick="showWParallel()"/></td></tr>
						<tr><td align="center">Project 3.0.1-N</td><td align="center">Project64 1.6</td><td align="center">Parallel Launcher</td></tr>
					</table>
				</div>

				<div id="w301" class="content" align="center" style="display: none;">
					<div class="info">Project64 3.0.1-N comes with all of the plugins in this list pre-installed, so you won't have to go through the effort of doing that yourself.<br/>
						Regardless, it's good to have some information about each plugin to decide which one you should pick.<br/>
						To change the plugins you're using, go to Options > Configuration, click on the Plugins node, use the dropdown lists to make your choice and click OK when you're done.<br/><br/></div><hr/><hr/>
					<h2>Graphic Plugins</h2>
					<h3>ANGLE GLideN64 v4.3.4</h3>
					<ul>
						<li class="pro">Very versatile plugin with decently accurate emulation.</li>
						<li class="pro">Works well in low-end computers.</li>
					</ul>
					
					<button type="button" class="collapsible btn btn-primary">More Info:</button>
					<div class="content">
					This plugin supports OpenGL, DirectX 11 and Vulkan. Which graphics API will run better depends entirely on your hardware, so make sure to try all 3 options and pick the one that feels best for you. Also note that DirectX 11 doesn't allow multi sample anti aliasing (MSAA).<br/>
					To switch between these 3 options, go to Options > Graphics settings, click the ANGLE tab, then select your preferred choice.<br/>
					Plugin made by aglab2. Based on GLideN64 by gonetz.
					</div><hr/>


					<h3>GLideN64 Public Release v4.0</h3>
					<ul>
						<li class="pro">Slightly more accurate than ANGLE GLideN64.</li>
						<li class="con">Tends to cause issues in older hacks, especially with More Objects Patch.</li>
						<li class="con">It's more hardware demanding than ANGLE GLideN64, as it's missing its optimizations and only allows OpenGL.</li>
					</ul>
					
					<button type="button" class="collapsible btn btn-primary">More Info:</button>
					<div class="content">
					This plugin should work right away without any adjustments.<br/>Plugin by gonetz.
					</div><hr/>

					<h3>Jabo's Direct3D8 1.6.1</h3>
					<ul>
						<li class="pro">Very reliable performance.</li>
						<li class="con">Very inaccurate, notably in the HUD and vanish cap.</li>
						<li class="con">Its inaccuracy causes issues with modern decomp hacks' visuals.</li>
						<li class="con">It seems to act differently depending on each player's graphics card.</li>
					</ul>
					
					<button type="button" class="collapsible btn btn-primary">More Info:</button>
					<div class="content">
					This plugin should work right away without any adjustments.<br/>Plugin by Jabo.
					</div><hr/>

					<h3>ParaLLel</h3>
					<ul>
						<li class="pro">The most console accurate plugin.</li>
						<li class="con">Won't run if your graphics card isn't good (NVIDIA RTX or AMD Analog recommended).</li>
						<li class="con">Doesn't have a GUI.</li>
					</ul>
					
					<button type="button" class="collapsible btn btn-primary">More Info:</button>
					<div class="content">
					To edit the settings for this plugin, you have to open parasettings.ini (located next to Project64.exe) in a text editor and edit it manually.<br/>
					This plugin requires graphics LLE to work. Therefore, you must disable Graphics HLE in the plugins section of PJ64's configuration to use it. Remember to enable it again when you switch back to a different plugin.<br/>
					Plugin by Themaister and mudlord.
					</div><hr/>

					<h3>Angrylion's RDP Plus 1.6</h3>
					<ul>
						<li class="pro">Another console accurate option.</li>
						<li class="pro">Less hardware demanding than ParaLLel.</li>
						<li class="con">Still pretty resource intensive.</li>
					</ul>
					
					<button type="button" class="collapsible btn btn-primary">More Info:</button>
					<div class="content">
					This plugin requires graphics LLE to work. Therefore, you must disable Graphics HLE in the plugins section of PJ64's configuration to use it. Remember to enable it again when you switch back to a different plugin.<br/>
					Plugin by ata4.</div><hr/><hr/>

					<h2>AUDIO PLUGINS</h2>
					<h3>LINK's AziAudio</h3>
					<ul>
						<li class="pro">Runs faster than Jabo.</li>
						<li class="pro">Fixes an issue with Azimer's Audio where some config wouldn't save correctly.</li>
						<li class="pro">There's no reason to include any other audio plugin.</li>
					</ul>
					
					<button type="button" class="collapsible btn btn-primary">More Info:</button>
					<div class="content">
					This plugin should work right away without any adjustments.<br/> Plugin by aglab2. Based on Azimer's Audio by Azimer.</div><hr/><hr/>

					<h2>INPUT PLUGINS</h2>
					<h3>LINK's Mapper 1.1.1</h3>
					<ul>
						<li class="pro">Almost any kind of controller will work fine with it.</li>
						<li class="pro">Allows framewalk macro.</li>
						<li class="con">Doesn't have a GUI.</li>
						<li class="con">Currently not a good option for keyboard as it lacks proper slow walk support and numpad configurations give issues since it doesn't use DirectInput.</li>
					</ul>

					<button type="button" class="collapsible btn btn-primary">More Info:</button>
					<div class="content">
					The settings file for this plugin is Project64\Config\map.yaml, although going to Options > Input settings in Project64 will open the file for you.<br/>
					You will need to modify the text file manually to edit your settings.<br/>
					Plugin by aglab2.</div><hr/>

					<h3>NRage's Direct-Input8 V2 1.83</h3>
					<ul>
						<li class="pro">A GUI alternative for DirectInput controllers.</li>
						<li class="pro">Has different sorts of customizable macros.</li>
						<li class="con">Has terrible XInput support.</li>
						<li class="con">Good keyboard configurations are near-impossible to setup, and no left+right / up+down support makes sideflips and Bowser throws unecessarily hard.</li>
					</ul>
					
					<button type="button" class="collapsible btn btn-primary">More Info:</button>
					<div class="content">
					This plugin should work right away without any adjustments.<br/> Plugin by PlexaryDamato.</div><hr/>

					<h3>Octomino's SDL Input (wermi's fork)</h3>
					<ul>
						<li class="pro">Plug & play for XInput controllers (Switch Pro, DualShock, XBox).</li>
						<li class="pro">Doesn't require Steam or specific drivers to use Switch Pro and DualShock.</li>
						<li class="pro">Supports mapping two buttons to the same input.</li>
						<li class="con">Not recommended for DirectInput controllers or keyboard.</li>
					</ul>
					
					<button type="button" class="collapsible btn btn-primary">More Info:</button>
					<div class="content">
					If you use the GUI to change your input mappings, make sure you close and reopen the emulator after doing that to prevent crashes.<br/>
					Plugin by wermi. Based on Octomino's SDL Input by clickdevin.</div><hr/>

					<h3>LINK's DirectInput7 v1.6.1</h3>
					<ul>
						<li class="pro">Currently the best plugin for keyboard players.</li>
						<li class="pro">Has "cheat angle", which means diagonal directions aren't exactly 45º and therefore allow you to wallkick.</li>
						<li class="pro">Has support for analog stick range modifiers ("slow walk key").</li>
						<li class="con">Works on controller, but has less useful features than the other options.</li>
					</ul>

					<button type="button" class="collapsible btn btn-primary">More Info:</button>
					<div class="content">
					To edit the slow walk key settings for this plugin, open Project64\Config\KeyboardInputConfig.dll in a text editor and edit it manually.<br/>
					The first number is the fraction of 100% that the modifier key will set the stick range to (default is 5, so 100/5 = 20%).<br/>
					The second number is the virtual keycode of the key you want to use as a modifier (default is 10, which corresponds to shift). <a href="https://docs.microsoft.com/en-us/windows/win32/inputdev/virtual-key-codes" target="_blank">See virtual keycodes here</a>.<br/>
					If you need multiple range modifier keys, you can add extra lines to the text file.<br/>
					Plugin by aglab2. Based on Jabo's DirectInput7 1.6.1 by Jabo.</div><hr/>

					<h3>pj64-wiiu-gcn</h3>
					<ul>
						<li class="pro">Allows you to use GCN controller with Wii U adapter without destroying your brain.</li>
						<li class="con">Currently doesn't support fully customizable input mappings.</li>
					</ul>
					<button type="button" class="collapsible btn btn-primary">More Info:</button>
					<div class="content">
					If you can't get this plugin to work, follow the instructions provided in <a href="https://wermi.neocities.org/emuguide/pj64-wiiu-gcn/" target="_blank">this link.</a>
					Plugin by wermi.
					</div><hr/>
					<div id="foot"><i>Thanks to aglab2, Hyena Chan, Pyro Jay and wermi for helping me make this.</i></div>
				</div>

				<div id="w16" class="content" align="center" style="display: none;">
					<div id="w16info">Project64 1.6 mostly comes with Jabo plugins, and although the game is mostly playable with them, there's much better stuff out there.<br/>
					aglab2 has made a tool called Plugin Manager that will help you install plugins. You can see a tutorial here. It hasn't been tested with every plugin, so I will add alternate installation instructions for all of them just in case.<br/>
					To change the plugins you're using, go to Options > Configuration, click on the Plugins node, use the dropdown lists to make your choice and click OK when you're done.<br/><br/>
					</div><hr/><hr/>
					
					<h2>RSP PLUGINS</h2>
					<h3><a href="https://github.com/aglab2/PJ64Fixups/releases" target="_blank">PJ64 Fixups</a></h3>
					<ul>
						<li class="pro">Fixes many issues that PJ64 1.6 normally has, such as not having counter factor 1 by default, lack of custom keybinds for emu functions, slow savestate loads, and game crashes caused by the TEQ MIPS instruction.</li>
					</ul>

					<button type="button" class="collapsible btn btn-primary">More Info:</button>
					<div class="content">
					Installation steps:
					<ol>
						<li>Download and extract the zip.</li>
						<li>Put the extracted .dll file in Project64\Plugin. Replace the file that is already there.</li>
						<li>Open Project64. If the plugin has initialized correctly, the Project64 window title will be changed to "LINK's Project64".</li>
					</ol>
					Plugin Made by aglab2.</div><hr/>

					<h2>Graphic Plugins</h2>
					<h3><a href="https://github.com/aglab2/GLideN64/releases" target="_blank">ANGLE GLideN64 v4.3.4</a></h3>
					<ul>
						<li class="pro">Very versatile plugin with decently accurate emulation.</li>
						<li class="pro">Works well in low-end computers.</li>
					</ul>
					
					<button type="button" class="collapsible btn btn-primary">More Info:</button>
					<div class="content">
						Installation steps:
					<ol>
						<li>Download and extract the zip.</li>
						<li>Put the files that come in the Plugin folder into Project64\Plugin. Put the other files in the main Project64 folder (Next to Project64.exe).</li>
						<li>Select the plugin.</li>
						<li>Go to Options > Configure graphics plugin, click the “Frame buffer” tab and make sure “Emulate frame buffer” is disabled, then click the “Emulation” tab and enable “Store compiled shaders for performance”.</li>
						<li>This plugin supports OpenGL, DirectX 11 and Vulkan. Which graphics API will run better depends entirely on your hardware, so make sure to try all 3 options and pick the one that feels best for you. Also note that DirectX 11 doesn't allow multi sample anti aliasing (MSAA).<br/>
						To switch between these 3 options, go to Options > Graphics settings, click the ANGLE tab, then select your preferred choice.</li>
					</ol>
					Plugin made by aglab2. Based on GLideN64 by gonetz.
					</div><hr/>


					<h3><a href="https://github.com/gonetz/GLideN64/releases/download/Public_Release_4_0/GLideN64_Public_Release_4.0.7z" target="_blank">GLideN64 Public Release v4.0</a></h3>
					<ul>
						<li class="pro">Slightly more accurate than ANGLE GLideN64.</li>
						<li class="con">Tends to cause issues in older hacks, especially with More Objects Patch.</li>
						<li class="con">It's more hardware demanding than ANGLE GLideN64, as it's missing its optimizations and only allows OpenGL.</li>
					</ul>
					
					<button type="button" class="collapsible btn btn-primary">More Info:</button>
					<div class="content">
					Installation steps:
					<ol>
						<li>Download and extract the zip.</li>
						<li>Put all extracted files in Project64\Plugin.</li>
						<li>Select the plugin.</li>
						<li>Go to Options > Configure graphics plugin, click the “Frame buffer” tab and make sure “Emulate frame buffer” is disabled, then click the “Emulation” tab and enable “Store compiled shaders for performance”.</li>
					</ol>
					Plugin by gonetz.
					</div><hr/>

					<h3><a href="https://drive.google.com/file/d/1-9XUy5L38xFJZJGHg4E8wrZwR6RNWsGM/view?usp=sharing" target="_blank">Jabo's Direct3D8 1.6.1</a></h3>
					<ul>
						<li class="pro">Very reliable performance.</li>
						<li class="con">Very inaccurate, notably in the HUD and vanish cap.</li>
						<li class="con">Its inaccuracy causes issues with modern decomp hacks' visuals.</li>
						<li class="con">It seems to act differently depending on each player's graphics card.</li>
					</ul>
					
					<button type="button" class="collapsible btn btn-primary">More Info:</button>
					<div class="content">
					This plugin should come preinstalled with Project64 1.6, but in case it doesn't for whatever reason, here are the installation steps:
					<ol>
						<li>Download the file.</li>
						<li>Put the file in Project64\Plugin.</li>
						<li>Select the plugin.</li>
					</ol>
					Plugin by Jabo.
					</div><hr/>

					<h3><a href="https://cdn.discordapp.com/attachments/480049895454277633/1028681604828237915/pj64-parallelrdp.zip" target="_blank">ParaLLel</a></h3>
					<ul>
						<li class="pro">The most console accurate plugin.</li>
						<li class="con">Won't run if your graphics card isn't good (NVIDIA RTX or AMD Analog recommended).</li>
						<li class="con">Doesn't have a GUI.</li>
						<li class="con">Has not been tested in Project64 1.6.</li>
					</ul>
					
					<button type="button" class="collapsible btn btn-primary">More Info:</button>
					<div class="content">
					Installation steps:
					<ol>
						<li>Download and extract the zip.</li>
						<li>Put the extracted file in Project64\Plugin.</li>
						<li>Select the parallel plugin in the graphics plugin dropdown.</li>
					</ol>
					To edit the settings for this plugin, you have to open parasettings.ini (located next to Project64.exe) in a text editor and edit it manually.<br/>
					This plugin requires graphics LLE to work. Therefore, you must disable Graphics HLE in the plugins section of PJ64's configuration to use it. Remember to enable it again when you switch back to a different plugin.<br/>
					Plugin by Themaister and mudlord.
					</div><hr/>

					<h3><a href="https://github.com/ata4/angrylion-rdp-plus/releases/download/v1.6/angrylion-plus.dll" target="_blank">Angrylion's RDP Plus 1.6</a></h3>
					<ul>
						<li class="pro">Another console accurate option.</li>
						<li class="pro">Less hardware demanding than ParaLLel.</li>
						<li class="con">Still pretty resource intensive.</li>
					</ul>
					
					<button type="button" class="collapsible btn btn-primary">More Info:</button>
					<div class="content">
					Installation steps:
					<ol>
						<li>Download the file</li>
						<li>Put the file in Project64\Plugin.</li>
						<li>Select the plugin.</li>
					</ol>
					This plugin requires graphics LLE to work. Therefore, you must disable Graphics HLE in the plugins section of PJ64's configuration to use it. Remember to enable it again when you switch back to a different plugin.<br/>
					Plugin by ata4.</div><hr/><hr/>

					<h2>AUDIO PLUGINS</h2>
					<h3><a href="https://www.mediafire.com/file/s1fil36hivy7qbj/AziAudio.dll/file" target="_blank">LINK's AziAudio</a></h3>
					<ul>
						<li class="pro">Runs faster than Jabo.</li>
						<li class="pro">Fixes an issue with Azimer's Audio where some config wouldn't save correctly.</li>
						<li class="pro">There's no reason to include any other audio plugin.</li>
					</ul>
					
					<button type="button" class="collapsible btn btn-primary">More Info:</button>
					<div class="content">
					Installation steps:
					<ol>
						<li>Download the file</li>
						<li>Put the file in Project64\Plugin.</li>
						<li>Select the plugin.</li>
					</ol>
					Plugin by aglab2. Based on Azimer's Audio by Azimer.
					</div><hr/>

					<h3><a href="https://drive.google.com/file/d/1Unh5VRaNAnWArud1G5XkOZ73jVQO2xWO/view?usp=sharing" target="_target">Jabo's DirectSound 1.6 or 1.7.0.7</a></h3>
					<ul>
						<li class="con">Runs slower than Azimer's Audio.</li>
						<li class="con">Has issues with specific hacks.</li>
						<li class="con">Do not use this one.</li>
					</ul>

					<button type="button" class="collapsible btn btn-primary">More Info:</button>
					<div class="content">
					This plugin should come with Project64 by default. There is no good reason to install it yourself.<br/>
					Plugin by Jabo.
					</div><hr/><hr/>


					<h2>INPUT PLUGINS</h2>
					<h3><a href="https://github.com/aglab2/LMapper" target="_blank">LINK's Mapper 1.1.1</a></h3>
					<ul>
						<li class="pro">Almost any kind of controller will work fine with it.</li>
						<li class="pro">Adds many extra savestate slots.</li>
						<li class="pro">Allows framewalk macro.</li>
						<li class="con">Doesn't have a GUI.</li>
						<li class="con">Currently not a good option for keyboard as it lacks proper slow walk support and numpad configurations give issues since it doesn't use DirectInput.</li>
					</ul>

					<button type="button" class="collapsible btn btn-primary">More Info:</button>
					<div class="content">
						Installation steps:
						<ol>
							<li>Download and extract the zip.</li>
							<li>Put LMapper.dll in Project64\Plugin, and map.yaml in Project64\Config.</li>
							<li>Select the LMapper 1.1.1 plugin in the controller plugin dropdown.</li>
						</ol>
					The settings file for this plugin is Project64\Config\map.yaml, although going to Options > Input settings in Project64 will open the file for you.<br/>
					You will need to modify the text file manually to edit your settings.<br/>
					To enable the extra savestate slots, delete the # at the beginning of the first line, every unmapped key in your keyboard will switch to a new savestate slot.<br/>
					Plugin by aglab2.</div><hr/>

					<h3><a href="https://malkierian.com/downloads/NRage-Xinput.zip" target="_blank">NRage's Input 2.4 (fork)</a></h3>
					<ul>
						<li class="pro">A GUI alternative for controllers.</li>
						<li class="pro">Has different sorts of customizable macros.</li>
						<li class="pro">Fixes standard NRage's poor XInput support.</li>
						<li class="con">DualShock and Switch Pro still require specific drivers or Steam to work.</li>
						<li class="con">Good keyboard configurations are near-impossible to setup, and no left+right / up+down support makes sideflips and Bowser throws unecessarily hard.</li>
					</ul>
					
					<button type="button" class="collapsible btn btn-primary">More Info:</button>
					<div class="content">
						Installation steps:
						<ol>
							<li>Download and extract the zip.</li>
							<li>Put NRage_Input_V2.4.dll in Project64\Plugin and the other two files in the main Project64 folder (Next to Project64.exe).</li>
							<li>Select the plugin.</li>
						</ol>
						Plugin by Malkierian. Based on NRage by PlexaryDamato.
					</div><hr/>

					<h3><a href="https://github.com/wermipls/octomino-sdl-input/releases" target="_blank">Octomino's SDL Input (wermi's fork)</a></h3>
					<ul>
						<li class="pro">Plug & play for XInput controllers (Switch Pro, DualShock, XBox).</li>
						<li class="pro">Doesn't require Steam or specific drivers to use Switch Pro and DualShock.</li>
						<li class="pro">Supports mapping two buttons to the same input.</li>
						<li class="con">Not recommended for DirectInput controllers or keyboard.</li>
					</ul>
					
					<button type="button" class="collapsible btn btn-primary">More Info:</button>
					<div class="content">
						Installation steps:
						<ol>
							<li>Download and extract the zip.</li>
							<li>Put all files in Project64\Plugin.</li>
							<li>Go to Project64\Config, create a new text file and rename it to Octomino's SDL Input.ini.</li>
							<li>Select the Octomino's SDL Input (wermi-999d5ab) plugin in the controller plugin dropdown.</li>
						</ol>
						If you use the GUI to change your input mappings, make sure you close and reopen the emulator after doing that to prevent crashes.<br/>
						Plugin by wermi. Based on Octomino's SDL Input by clickdevin.
					</div><hr/>

					<h3><a href="https://github.com/aglab2/KeyboardInput/releases/download/0.1/KeyboardInput.zip" target="_blank">LINK's DirectInput7 v1.6.1</a></h3>
					<ul>
						<li class="pro">Currently the best plugin for keyboard players.</li>
						<li class="pro">Has "cheat angle", which means diagonal directions aren't exactly 45º and therefore allow you to wallkick.</li>
						<li class="pro">Has support for analog stick range modifiers ("slow walk key").</li>
						<li class="con">Works on controller, but has less useful features than the other options.</li>
					</ul>

					<button type="button" class="collapsible btn btn-primary">More Info:</button>
					<div class="content">
						Installation steps:
						<ol>
							<li>Download and extract the zip.</li>
							<li>Put all files in Project64\Input.</li>
							<li>Select the plugin.</li>
						</ol>
					To edit the slow walk key settings for this plugin, open Project64\Config\KeyboardInputConfig.dll in a text editor and edit it manually.<br/>
					The first number is the fraction of 100% that the modifier key will set the stick range to (default is 5, so 100/5 = 20%).<br/>
					The second number is the virtual keycode of the key you want to use as a modifier (default is 10, which corresponds to shift). <a href="https://docs.microsoft.com/en-us/windows/win32/inputdev/virtual-key-codes">See virtual keycodes here</a>.<br/>
					If you need multiple range modifier keys, you can add extra lines to the text file.<br/>
					Plugin by aglab2. Based on Jabo's DirectInput7 1.6.1 by Jabo.</div><hr/>

					<h3><a href="https://wermi.neocities.org/emuguide/pj64-wiiu-gcn/" target="_blank">pj64-wiiu-gcn</a></h3>
					<ul>
						<li class="pro">Allows you to use GCN controller with Wii U adapter without destroying your brain.</li>
						<li class="con">Currently doesn't support fully customizable input mappings.</li>
					</ul>
					<button type="button" class="collapsible btn btn-primary">More Info:</button>
					<div class="content">
						Installation steps:
						<ol>
							<li>Go to Project64\Config, create a new text file and rename it to pj64-wiiu-gcn.bin.</li>
							<li>Follow the instructions provided in the link.</li>
						</ol>
					Plugin by wermi.
					</div><hr/>

					<h3><a href="https://drive.google.com/file/d/1ju79NueuSp3cnxsuUVYwVtCzj3N-ah_f/view?usp=sharing" target="_blank">Jabo's Direct7 1.6.1</a></h3>
					<ul>
						<li class="con">Same thing as LINK's DirectInput but without the slow walk feature.</li>
						<li class="con">Its "cheat angle" is weird.</li>
						<li class="con">Not worth using since the other plugins have their own advantages for both keyboard and controller.</li>
					</ul>

					<button type="button" class="collapsible btn btn-primary">More Info:</button>
					<div class="content">
					This plugin should come with Project64 by default. There is no good reason to install it yourself.<br/>
					Plugin by Jabo.
					</div><hr/><hr/>
					<div id="foot"><i>Thanks to aglab2, Hyena Chan, Pyro Jay and wermi for helping me make this.</i></div>
				</div>

				<div id="wParallel" class="content" align="center" style="display: none;">
					<div class="info">Parallel Launcher comes with a few select graphics plugins, and it doesn't allow you to install your own.<br/>
					Regardless, it's good to have some information about each plugin to decide which one you should pick.<br/>
					It doesn't support audio or input plugins, other than allowing you to enable DirectInput if your controller doesn't work with the default settings.<br/>
					You can change your graphics plugin in the first window you see when you open Parallel Launcher.<br/><br/></div><hr/><hr/>
					<h2>Graphic Plugins</h2>
					<h3>ORGE</h3>
					<ul>
						<li class="pro">Very versatile plugin with decently accurate emulation.</li>
						<li class="con">Can cause massive lag and input delay issues, and even crashes in low-end computers.</li>
					</ul>
					
					<button type="button" class="collapsible btn btn-primary">More Info:</button>
					<div class="content">
					Despite its completely different name, this plugin is known as LINK's GLideN64 in Project64.<br/>
					Plugin made by aglab2. Based on GLideN64 by gonetz.
					</div><hr/>


					<h3>GLideN64</h3>
					<ul>
						<li class="pro">Slightly more accurate than OGRE.</li>
						<li class="con">Tends to cause issues in older hacks, especially with More Objects Patch.</li>
					</ul>
					
					<button type="button" class="collapsible btn btn-primary">More Info:</button>
					<div class="content">
					This plugin should work right away without any adjustments.<br/>Plugin by gonetz.
					</div><hr/>

					<h3>Rice</h3>
					<ul>
						<li class="pro">The only option for low-end setups in Parallel Launcher.</li>
						<li class="con">Very inaccurate, often described as "Jabo but worse".</li>
						<li class="con">Its inaccuracy causes issues with modern decomp hacks' visuals.</li>
					</ul>
					
					<button type="button" class="collapsible btn btn-primary">More Info:</button>
					<div class="content">
					Plugin by Rice and mudlord.
					</div><hr/>

					<h3>ParaLLel</h3>
					<ul>
						<li class="pro">The most console accurate plugin.</li>
						<li class="con">Won't run if your graphics card isn't good (NVIDIA RTX or AMD Analog recommended).</li>
						<li class="con">Doesn't have a GUI.</li>
					</ul>
					
					<button type="button" class="collapsible btn btn-primary">More Info:</button>
					<div class="content">
					Plugin by Themaister and mudlord.
					</div><hr/>

					<h3>Angrylion's RDP Plus 1.6</h3>
					<ul>
						<li class="pro">Another console accurate option.</li>
						<li class="pro">Less hardware demanding than ParaLLel.</li>
						<li class="con">Still pretty resource intensive.</li>
					</ul>
					
					<button type="button" class="collapsible btn btn-primary">More Info:</button>
					<div class="content">
					Plugin by ata4.</div><hr/><hr/>

					<div id="foot"><i>Thanks to aglab2, Hyena Chan, Pyro Jay and wermi for helping me make this.</i></div>

				</div>


			<?php include '../footer.php'; ?>	
			</div>		</div>
	
	<script>

		function showWindows()
		{
			document.getElementById("opsys").style.display = "none";
			document.getElementById("wcontent").style.display = "block";
			document.getElementById("w16").style.display = "none";
			document.getElementById("wParallel").style.display = "none";
		}

		function showW301()
		{
			document.getElementById("wcontent").style.display = "none";
			document.getElementById("w301").style.display = "block";
			document.getElementById("w16").style.display = "none";
			document.getElementById("wParallel").style.display = "none";

		}

		function showW16()
		{
			document.getElementById("wcontent").style.display = "none";
			document.getElementById("w301").style.display = "none";
			document.getElementById("w16").style.display = "block";
			document.getElementById("wParallel").style.display = "none";
		}

		function showWParallel()
		{
			document.getElementById("wcontent").style.display = "none";
			document.getElementById("w301").style.display = "none";
			document.getElementById("w16").style.display = "none";
			document.getElementById("wParallel").style.display = "block";
		}

		function showLinux()
		{
			document.getElementById("opsys").style.display = "none";
			document.getElementById("lcontent").style.display = "block";
			document.getElementById("l16").style.display = "none";
			document.getElementById("lParallel").style.display = "none";
		}

		function showL301()
		{
			document.getElementById("lcontent").style.display = "none";
			document.getElementById("l301").style.display = "block";
			document.getElementById("l16").style.display = "none";
			document.getElementById("lParallel").style.display = "none";

		}

		function showL16()
		{
			document.getElementById("lcontent").style.display = "none";
			document.getElementById("l301").style.display = "none";
			document.getElementById("l16").style.display = "block";
			document.getElementById("lParallel").style.display = "none";
		}

		function showLParallel()
		{
			document.getElementById("lcontent").style.display = "none";
			document.getElementById("l301").style.display = "none";
			document.getElementById("l16").style.display = "none";
			document.getElementById("lParallel").style.display = "block";
		}

	</script>
	
		</body>

</html>