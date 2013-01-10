<?php

///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
// index.php
// Entry point for all http and https requests
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

// set default timezone
date_default_timezone_set('Europe/London');

// include constants file
require_once('constants.php');

// standard includes
require_once('collection/class.CollectionIterator.php');
require_once('database/class.DatabaseMySQL.php');
require_once('encrypt/class.Encrypt.php');
require_once('session/class.UserSession.php');
require_once('filter/class.InputFilter.php');
require_once('filter/class.InputValidate.php');
require_once('communication/class.EmailCommunication.php');
require_once('communication/class.SMSCommunication.php');
require_once('class.ViewHelper.php');
require_once('class.ViewXHTML.php');
require_once('class.ViewCSV.php');
require_once('class.ViewFile.php');
require_once('class.ViewEmail.php');

// data model includes
require_once('class.UserFactory.php');

// get posted values
$g_hCookieVars = $_COOKIE;
$g_hRequestVars = $_REQUEST;

// create view variables
$g_hViewVars = array();
$g_hViewVars['PageTitle'] = $g_sDefaultPageTitle;

// set unset request variable to empty string
function setRequestEmpty($p_sVar)
{
	global $g_hRequestVars;
	if (!isset($g_hRequestVars[$p_sVar]))
	{
		$g_hRequestVars[$p_sVar] = '';
	}
}

// get value of request variable or empty string if unset
function getRequestValue($p_sVar)
{
	global $g_hRequestVars;
	if (!isset($g_hRequestVars[$p_sVar]))
		$g_hRequestVars[$p_sVar] = '';

	return $g_hRequestVars[$p_sVar];
}

// returns true if the request variable has a value or is 0
function hasRequestValue($p_sVar)
{
	global $g_hRequestVars;
	if (!isset($g_hRequestVars[$p_sVar]))
		$g_hRequestVars[$p_sVar] = '';

	if ($g_hRequestVars[$p_sVar] || $g_hRequestVars[$p_sVar] === '0' || $g_hRequestVars[$p_sVar] === 0)
		return true;
	else
		return false;
}

// connect to databases
$g_oDb = DatabaseMySQL::instance($g_sDatabaseUser, $g_sDatabasePassword, $g_sDatabase);

// translate url parts into the appropriate part of the site
URLRewrite();
// set page variables to empty strings
setRequestEmpty('a');
setRequestEmpty('b');
setRequestEmpty('c');
setRequestEmpty('d');

// trim request variables and put into view array
if (sizeof($g_hRequestVars) > 0)
{
	foreach ($g_hRequestVars as $key => $val)
	{
		$g_hRequestVars[$key] = trim($val);
		$g_hViewVars[$key] = $g_hRequestVars[$key];
	}
}

// check for ajax
$g_bAjaxCall = false;
if ($g_hRequestVars['a'] == 'Ajax')
{
	$g_bAjaxCall = true;
}

//function to record logs of events
function logActivity($p_sString, $p_iQuoteID = 0, $p_sComment = '')
{
	global $g_oDb, $g_oSession;
	$g_oDb->insert('activity_log', array('action' => $p_sString, 'time_stamp' => NOW, 'quote_id' => $p_iQuoteID, 'comment' => $p_sComment, 'affiliate_id' => $g_oSession->affiliate));
}

// update the current session and reauthenticate if timed out
$g_oSession = new UserSession();
if (!$g_bAjaxCall)
	$g_oSession->impress();

// set the current user
$g_oUser = null;
$g_iUserID = 0;
if ($g_oSession->getUserID())
{
	$g_oUser = new User($g_oSession->getUserID());
	$g_iUserID = $g_oUser->getID();
}

// launch the front controller or ajax controller
if ($g_bAjaxCall)
	require_once('controller.Ajax.php');
else
	require_once('controller.Front.php');

?>