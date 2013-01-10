<?php

///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
// Public Controller
// Controller for requests made in the public area of the system
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

// delegate processing to the appropriate controller based on the page request url
$g_aValidBNames = array('Index');

if (!isset($g_hRequestVars['b']) || !$g_hRequestVars['b'])
	$g_hRequestVars['b'] = 'Index';
$g_hRequestVars['b'] = InputFilter::filterArray($g_hRequestVars['b'], $g_aValidBNames);

// perform delegation
switch ($g_hRequestVars['b'])
{
	// homepage
	case 'Index':
		require_once('view.PublicIndex.php');
		break;

	default:
		$t_oView = new ViewXHTML('NotFound.phtml', $g_hViewVars);
		$t_oView->render();
		break;
}

?>