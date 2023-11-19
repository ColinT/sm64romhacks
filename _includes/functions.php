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


?>