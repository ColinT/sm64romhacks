<!DOCTYPE HTML>
<html lang="en">
<!--BEGINNING OF HEAD-->
<head>
<title>sm64romhacks - Patches</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<meta name="keywords" content="super mario romhacks hack speedrun sm64hacks sm64romhacks rom modification">
<meta name="description" content="Welcome to SM64ROMHacks! We have a really big collection of SM64 ROM Hacks which wait to be played! Community News/Events will also be tracked here">
<meta http-equiv="Cache-Control" content="no-cache, no-store, must-revalidate">
<meta http-equiv="Pragma" content="no-cache">
<meta http-equiv="Expires" content="0">
<link rel="stylesheet" type="text/css" href="_css/bootstrap.css">
<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
<link rel="shortcut icon" href="/_img/icon.ico" >
<!--BEGINNING SCRIPTS-->
<script src="./index.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
<!--END OF SCRIPTS-->
</head>
<!--END OF HEAD-->
<body>
<div class="container">
<?php include 'header.php'; ?>
	<div align="center">
<!--<iframe src="//player.twitch.tv/?channel=sm64romhacks&autoplay=true&muted=true&parent=sm64romhacks.com" allowfullscreen='true' width='640' height='360'></iframe><br/>-->
<input type="text" id="hackNamesInput" placeholder="Search for hacknames.."/><input type="text" id="authorNamesInput" placeholder="Search for hackcreators.." style="align-self: center;" /><input type="text" id="hackDatesInput" placeholder="Search for Date (yyyy-mm-dd)..." style="align-self: center; width: 215px;"/>
<select id=tagInput>
	<option value="">Select a Pack</option>
	<option value="BDR Chaos Pack">BDR Chaos Pack</option>
	<option value="Chaos Pack 64">Chaos Pack 64</option>
	<option value="Ghost Race Pack">Ghost Race Pack</option>
	<option value="Hacking Challenge 1 Submissions">Hacking Challenge 1 Submissions</option>
	<option value="Hacking Challenge 2 Submissions">Hacking Challenge 2 Submissions</option>
	<option value="Janja Mini Hack Pack">Janja Mini Hack Pack</option>
	<option value="Kaze's Unreleased Mods">Kaze's Unreleased Mods</option>
	<option value="ROM Hack Time Challenges Round 1">ROM Hack Time Challenges Round 1</option>
	<option value="ROM Hack Time Challenges Round 2">ROM Hack Time Challenges Round 2</option>
	<option value="ROM Hack Time Challenges Round 3">ROM Hack Time Challenges Round 3</option>
	<option value="ROM Hack Time Challenges Round 4">ROM Hack Time Challenges Round 4</option>
	<option value="ROM Hack Time Challenges Round 5">ROM Hack Time Challenges Round 5</option>
	<option value="ROM Hack Time Challenges Round 6">ROM Hack Time Challenges Round 6</option>
	<option value="SKELUXXX Classics Pack">SKELUXXX Classics Pack</option>
	<option value="SimpleFlips Competition 1">SimpleFlips Competition 1</option>
	<option value="SimpleFlips Competition 2">SimpleFlips Competition 2</option>
	<option value="SimpleFlips Competition 3">SimpleFlips Competition 3</option>
	<option value="SimpleFlips Competition 4">SimpleFlips Competition 4</option>
	<option value="SimpleFlips Competition 5">SimpleFlips Competition 5</option>
	<option value="SimpleFlips Competition 6">SimpleFlips Competition 6</option>
	<option value="SimpleFlips Competition 7">SimpleFlips Competition 7</option>
	<option value="SimpleFlips Competition 8">SimpleFlips Competition 8</option>
	<option value="SimpleFlips Competition 9">SimpleFlips Competition 9</option>
	<option value="SimpleFlips Competition 10">SimpleFlips Competition 10</option>
	<option value="SimpleFlips Competition 11">SimpleFlips Competition 11</option>
	<option value="SimpleFlips Competition 12">SimpleFlips Competition 12</option>
	<option value="SimpleFlips Competition 13">SimpleFlips Competition 13</option>
	<option value="SimpleFlips Competition 14">SimpleFlips Competition 14</option>
	<option value="SimpleFlips Competition 15">SimpleFlips Competition 15</option>
	<option value="SirRouven's Hack Pack">SirRouven's Hack Pack</option>
	<option value="Sunshine Dive Physics Pack">Sunshine Dive Physics Pack</option>
	<option value="WaluigiHacker's Pack">WaluigiHacker's Pack</option>
</select>	
<a class="btn btn-primary" href="random.php">Random</a><br/><br/>
Technical Note: If it seems like something is broken, try to refresh your browser cache! On PC this usually is done by pressing Control + F5.<div id='hacksCollection'></div>
	<?php
		
		$a_patch=file("_data/patches.csv");
		$f_json=fopen("_data/hacks.json", "w+");
		$scheme = "{\n\t".'"$scheme"'.":".'"./scheme.json"'.",\n";
		fwrite($f_json, $scheme);
		fwrite($f_json, "\"hacks\" : [\n\t");
		
		if(!file_exists("_data/patches_copy")) //create copy of patches.csv if not existent
		{
			$f_copy=fopen("_data/patches_copy.csv","w+");
			fclose($f_copy);
		}
		
		$a_copy=file("_data/patches_copy.csv");
        sort($a_patch); //sort patches.csv
		$sep=",";
		$head="";
		$dir="";
		$hacknames=array();
		$creators=array();
		$dates=array();
		$tags=array();
		
		for($i=0;$i<count($a_patch);$i++)
		{
			list($name,$version,$creator,$amount,$date,$dl,$tag)=explode($sep,$a_patch[$i]);
			if($creator=="")
			{
				$creator="unknown";
			}

			$tag=str_replace("\n", "", $tag);
			$tag=substr_replace($tag, "", -1);

			if(!in_array($name, $hacknames))
			{
				array_push($hacknames,$name);
				array_push($creators,$creator);
				array_push($dates,$date);
				array_push($tags,$tag);
			}
		}
		
		$a_hacks=file("_data/hacks.csv");
		for($i=0; $i < count($hacknames); $i++)
		{
			$hackname = $hacknames[$i];
			$creatorname = $creators[$i];
			$r_date = $dates[$i];
			$tag = $tags[$i];
			
			$head=$hackname;
			$hackname=getDictionaryName($hackname);
			if($creatorname=="unknown")
			{
				$creatorname="<font color=#777>unknown</font>";
			}
			if($r_date==" ")
			{
				$r_date="<font color=#777>unknown</font>";
			}
			$r_date=getEarliestReleaseDate($hackname);
			if(count($a_patch)!=count($a_copy)) //check if sheet got new entires
			{
				if(!is_dir('hacks'))
				{
					mkdir('hacks'); //create hacks directory if not exist
				}
				$dir=getcwd();	
				chdir('hacks');
				if(!is_dir($hackname)) //create folder for hack if not exist
				{
					mkdir($hackname);
				}
				chdir($hackname);
				if(!file_exists("desc.txt"))
				{
					$descr=fopen("desc.txt", "w+"); //create desc.txt
					fclose($descr);
				}
				$index=fopen("index.php","w+"); //create index.php 
				$content=getHTMLContent($head);
				fwrite($index,$content);
				fclose($index);
				if(!is_dir('_data'))
				{
					mkdir('_data'); //create _data folder if not exist
				}
				chdir($dir);
			}
		}

		if(is_dir('hacks/_data'))
		{
			rmdir('hacks/_data'); //remove 'hacks/_data' folder which might or might not have been created due poor coding 
		}

		foreach($a_patch as $patch)
		{
			list($name, $version, $creator, $amount, $date, $dl, $tag)=explode($sep,$patch);
			$work_dir=getcwd();
			$dir=getDictionaryName($name);
			chdir("hacks/$dir/_data");
			$file=fopen("patches.csv","w+"); //create for each hack a patches.csv
			fclose($file);
			chdir($work_dir);
		}

		foreach($a_patch as $patch)
		{
			list($name, $version, $creator, $amount, $date, $dl, $tag)=explode($sep,$patch);
			$work_dir=getcwd();
			$dir=getDictionaryName($name);
			chdir("hacks/$dir/_data");
			$file=fopen("patches.csv","a+"); //add data to each hack's respective patches.csv file
			fwrite($file,"$name,$version,$creator,$amount,$date,$dl,$tag");
			fclose($file);
			chdir($work_dir);
		}

		for($i=0; $i < count($hacknames); $i++)
		{
			$name = $hacknames[$i];
			$creator = $creators[$i];
			$date = $dates[$i];
			$tag = $tags[$i];
			$work_dir=getcwd();
			$dir=getDictionaryName($name);
			chdir("hacks/$dir/_data");
			if($i==0)
			{
				writeJson($f_json, false, $i);
			}
			else
			{
				writeJson($f_json, true, $i);
			}
			chdir($work_dir);
		}
			copy("_data/patches.csv","_data/patches_copy.csv");
			fwrite($f_json, "]}");
			fclose($f_json);
	?>
	<hr/>
	<?php include 'footer.php'; ?>
</div>
</div>
</body>
</html>	



<?php

function writeJson($f_json, $flag, $index)
{
	$sep = ',';
	$data = file("patches.csv");
	$name='';
	$creator='';
	$creators='';
	$date='';
	$tag="";
	$versionDetailed = '';

	$i = 0;
	foreach($data as $line)
	{
		list($hackname,$version,$hackcreator,$staramount,$r_date,$link,$pack)=explode($sep,$line);
		$pack=str_replace("\n", "", $pack);
		$pack=substr_replace($pack, "", -1);
		/*while(preg_match("[a-z]|[0-9]", substr($pack, -1, 1)) != 1)
		{
			//$pack=str_replace("\n", "", $pack);
			$pack=substr_replace($pack, "", -1);
		}*/
		if($hackcreator!="")
			{
				$creator = explode(" & ", $hackcreator);
				for($j=0; $j<count($creator);$j++)
				{
					if($j==0)
					{
						$creators='"'.$creator[0].'"';
					}
					else if($j>0)
					{
						$creators=$creators.',"'.$creator[$j].'"'."";
					}
				}
			}
		if($i==0)
		{
			$name = $hackname;
			$date=getEarliestReleaseDate(getDictionaryName($name));
			$tag = $pack;
			$versionDetailed = $versionDetailed."{\n\"versionName\": \"$version\",";
			$versionDetailed = $versionDetailed."\n\"creators\" : [$creators],";
			$versionDetailed = $versionDetailed."\n\"starCount\": \"$staramount\",";
			$versionDetailed = $versionDetailed."\n\"fileName\" : \"$link\"\n}\n";
					
		}
		else if($hackname!="")
		{
			if($version!="" && $link!="")
			{		
				$versionDetailed = $versionDetailed.",\n{\n\"versionName\" :  \"$version\",";
				$versionDetailed = $versionDetailed."\n\"creators\" : [$creators],";
				$versionDetailed = $versionDetailed."\n\"starCount\": \"$staramount\",";
				$versionDetailed = $versionDetailed."\n\"fileName\" :  \"$link\"\n}\n";		
			}
		}
		$i++;
	}
	
	if($flag)
	{

		//$name = openssl_encrypt($name, "aes128", getRandomString(strlen($name)));

		fwrite($f_json, ','."\n".'{'."\n".
			'"id" : "'.$index.'",'."\n".
			'"name" : "'.$name.'",'."\n".
			'"versions" : ['.$versionDetailed.'],'."\n".
			'"releaseDate" : "'.$date.'",'."\n".
			'"tag" : "'.$tag.'"'.
		'}');
	}
	else
	{
		//$name = openssl_encrypt($name, "aes128", getRandomString(strlen($name)));

		fwrite($f_json,'{'."\n".
			'"id" : "'.$index.'",'."\n".
			'"name" : "'.$name.'",'."\n".
			'"versions" : ['.$versionDetailed.'],'."\n".
			'"releaseDate" : "'.$date.'",'."\n".
			'"tag" : "'.$tag.'"'.
		'}');
	}
}

function getHTMLContent($head)
{
	return "<!DOCTYPE HTML>
	<html>
		<!--BEGINNING OF HEAD-->
		<head>
			<title>sm64romhacks - $head</title>
			<meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\" />
			<meta name=\"keywords\" content=\"super mario, romhacks, hack, speedrun, sm64hacks, sm64romhacks, rom, modification\" />
			<meta name=\"description\" content=\"Welcome to SM64ROMHacks! We have a really big collection of SM64 ROM Hacks which wait to be played! Community News/Events will also be tracked here\" />
			<link rel=\"stylesheet\" type=\"text/css\" href=\"../../_css/bootstrap.css\">
			<link rel=\"stylesheet\" type=\"text/css\" href=\"https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css\">
			<link rel=\"shortcut icon\" href=\"../../_img/icon.ico\" />
			<script src=\"https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js\" integrity=\"sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz\" crossorigin=\"anonymous\"></script>
		</head>
		<body>		<div class=\"container\">
				<?php include '../../header.php'; ?>
				<div align=\"center\">
					<!--HTML CONTENT HERE-->
					<?php
					print \"<h1><u>$head</u></h1>\";
					\$a_patch=file(\"_data/patches.csv\");
					natcasesort(\$a_patch);
			print \"<table id='myTable' border=1 align=center>\";
			print \"<tr><th><b>Hackname</b></th><th>Version</th><th><b>Downloadlink</b></th><th><b>Creator</b></th><th><b>Starcount</b></th><th>Date (Format: yyyy-mm-dd)</tr>\";
			\$sep=\",\";
			foreach(\$a_patch as \$zeile)
			{	
				list(\$name, \$version, \$creator, \$amount, \$date,  \$dl)=explode(\$sep,\$zeile);
				\$dl=str_replace(\"\n\",\"\",\$dl);
				if(\$creator==\"\")
				{
					\$creator=\"<font color=#777>unknown</font>\"; //changed color to less outstanding for normal users who dont care about this
				}
				if(\$amount==\"\")
				{
					\$amount=\"<font color=#777>unknown</font>\"; //changed color to less outstanding for normal users who dont care about this
				}
				if(\$date==\"\")
				{
					\$date=\"<font color=#777>unknown</font>\"; //changed color to less outstanding for normal users who dont care about this
				}
				\$fileending=\".zip\";
				\$link=\$dl.\$fileending;
				\$ref=\"'../../patch/\$link'\";
				print \"<tr><td>\$name</td><td>\$version</td><td><u><a href=\$ref>Download</a></u></td><td>\$creator</td><td>\$amount</td><td>\$date</td></tr>\n\";
			}
			print \"</table>\"; 
			\$description = file_get_contents(\"desc.txt\");
			if(\$description != \"\"){
			print \"<hr><div>\";
			print \$description;
			print \"</div>\";}
			include '../../footer.php'; 
			?>
				</div>		</div>
		</body>
	</html>";
}

function getEarliestReleaseDate($dir)
{
	$r_dates = array();
	$work_dir=getcwd();
	chdir("hacks/$dir/_data");

	$data=file("patches.csv");
	foreach($data as $patch)
	{
		list($name, $version, $creator, $amount, $date, $dl, $tag)=explode(',',$patch);
		array_push($r_dates, $date);
	}
	sort($r_dates);
	chdir($work_dir);
	return $r_dates[0];
}

function getDictionaryName($hackname)
{
	$hackname=str_replace(" ","_",$hackname);
	$hackname=str_replace("(","_",$hackname);
	$hackname=str_replace(")","_",$hackname);
	$hackname=str_replace("'","",$hackname);
	$hackname=str_replace(":","",$hackname);
	$hackname=str_replace("/","",$hackname);
	$hackname=strtolower($hackname);

	return $hackname;
}

function getRandomString($n)
{
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $randomString = '';

    for ($i = 0; $i < $n; $i++) {
        $index = rand(0, strlen($characters) - 1);
        $randomString .= $characters[$index];
    }

    return $randomString;
}

?>