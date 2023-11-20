<?php

function stripChars($string) {
    $string = str_replace('<', '&lt;', $string);
    $string = str_replace('>', '&gt;', $string);
    return $string;
}

function getURLEncodedName($hackname)
{
	
	$hackname=str_replace(":","_",$hackname);

	return urlencode($hackname);
}

function getURLDecodedName($hackname)
{
	$hackname=str_replace("_",":",$hackname);


	return urldecode($hackname);
}

function getAllAuthorsNames($pdo, $string_of_ids) {
	$authors = explode(", ", $string_of_ids);
	$result_string = "";
	foreach($authors as $author) {
		$user = getUserFromDatabase($pdo, $author);
		if($user) $result_string = $result_string . $user['discord_username'] . ', ';
		else $result_string = $result_string . $author . ', ';
	  }
	  return substr_replace($result_string, '', -2);
}

function areAllAuthorsAnId($authors) {
	$authors = explode(", ", $authors);
	foreach($authors as $author) {
		if((int)$author == 0) return false;
	}
	return true;
}


?>