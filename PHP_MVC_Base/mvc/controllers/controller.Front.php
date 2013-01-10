<?php

///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
// Front Controller
// First controller for normal non ajax requests
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

// delegate processing to the appropriate controller based on the page request url
$g_aValidANames = array('Public', 'NotFound');

if (!isset($g_hRequestVars['a']) || !$g_hRequestVars['a'])
	$g_hRequestVars['a'] = 'Public';
$g_hRequestVars['a'] = InputFilter::filterArray($g_hRequestVars['a'], $g_aValidANames);

// check permissions

// perform delegation
switch ($g_hRequestVars['a'])
{
	case 'Public':
	default:
		require_once('controller.Public.php');
		break;

	case 'NotFound':
		$t_oView = new ViewXHTML('NotFound.phtml', $g_hViewVars);
		$t_oView->render();
		break;
}

?>