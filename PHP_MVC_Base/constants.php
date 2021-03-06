<?php

///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
// constants.php
// Constants and globals used throughout the system
// DEV VERSION
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

define("TODAY", date('Y-m-d'));
define("YESTERDAY", date("Y-m-d", time()-86400));
define("NOW", date('Y-m-d H:i:s'));
define("THISYEAR", date('Y'));
define("THISMONTH", date('Y-m'));

$g_sSiteName = 'X Insurance';
$g_sSitePath = 'http://www.socratessystems.com/clients/x/';
$g_sDomain = 'http://www.socratessystems.com';

$g_sCompanyName = 'X Insurance Ltd.';
$g_sCompanyNameShort = 'X';
$g_sDefaultPageTitle = 'X Insurance';
$g_sTempFolder = './temp/';

$g_sDatabase = 'x_dev';
$g_sDatabaseUser = 'one';
$g_sDatabasePassword = 'ecomm3rce';

$g_sSendingEmailName = 'X Insurance';
$g_sSendingEmailAddress = 'info@xinsurance.com';

$g_aMonths = array('1'=>'January', '2'=>'February', '3'=>'March', '4'=>'April', '5'=>'May', '6'=>'June', '7'=>'July', '8'=>'August', '9'=>'September', '10'=>'October', '11'=>'November', '12'=>'December');
$g_aDays = array('0'=>'Sunday', '1'=>'Monday', '2'=>'Tuesday', '3'=>'Wednesday', '4'=>'Thursday', '5'=>'Friday', '6'=>'Saturday');
$g_aTitles = array('Mr', 'Mrs', 'Miss', 'Ms', 'Dr', 'Sir', 'Lord', 'Lady', 'Professor', 'Master');

$g_sEncryptionSaltFront = 'GinolaDavid';
$g_sEncryptionSaltBack = 'DozzellJason';

// services

$g_sPDFLibKey = 'L700602-010500-736038-44B832-94MCH2';

$g_sPostcodeSearchKey = 'W_6D4890B5E8C349379B2FFCECB435D0';
$g_sPostcodeSearchServer = 'http://www.simplylookupadmin.co.uk/xmlservice';

$g_sSMSUser = 'socrate1';
$g_sSMSPassword = 'rscsj2zz';

$g_sGoogleMapsKey = '';

// global functions

// use https connection
function securePage() 
{
	if ($_SERVER['HTTPS'] != 'on')  
	{
		$t_sURL = 'https://' . $_SERVER['SERVER_NAME'] . $_SERVER['REQUEST_URI']; 
		header("Location: $t_sURL");
		exit;
	}
}

function unsecurePage() 
{
	if (isset($_SERVER['HTTPS']))  
	{
		$t_sURL = 'http://' . $_SERVER['SERVER_NAME'] . $_SERVER['REQUEST_URI']; 
		header("Location: $t_sURL");
		exit;
	}
}
// redirect
function redirect($p_sURL)
{
	header("location: $p_sURL");
	exit;
}

//make url from title for news
function makeURL($p_sTitle) 
{
	$headline = trim($p_sTitle);
	$headline = strtolower($headline);
	$headline = strip_tags($headline);
	$bad = array("-", ",", ".", "(", ")", "?", "!", "_", "+", "/", "\"", "�", "&pound;", "$", "%", "^", "&", "*", "[", "]", "{", "}", "'", "|", ":","�");
	$headline = str_replace($bad, "", $headline);
	$headline = str_replace("�", "", $headline);
	$headline = str_replace(" ", "-",$headline);
	return $headline;
}


if (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] == 'on')  
	$g_sSitePath = 'https://' . substr($g_sSitePath, 7);

?>