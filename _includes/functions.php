<?php

function stripChars($string) {
    $string = str_replace('<', '&lt;', $string);
    $string = str_replace('>', '&gt;', $string);
    return $string;
}

function getURLEncodedName($hackname)
{
	/*$hackname=str_replace(" ","%20",$hackname);
	$hackname=str_replace("(","%28",$hackname);
	$hackname=str_replace(")","%29",$hackname);
	$hackname=str_replace("'","%27",$hackname);
	$hackname=str_replace(":","%3A",$hackname);
    $hackname=str_replace(".","%2E",$hackname);
	$hackname=str_replace("/","%2F",$hackname);
    $hackname=str_replace("!","%21",$hackname);
	$hackname=str_replace("?","%3F",$hackname);*/

	//$hackname=strtolower($hackname);
	$hackname=str_replace(":","_",$hackname);

	return $hackname;
	//return filter_var($hackname, FILTER_SANITIZE_URL);
}

function getURLDecodedName($hackname)
{
	$hackname=str_replace("_",":",$hackname);
	$hackname=str_replace("%20"," ",$hackname);


	return $hackname;
}


?>