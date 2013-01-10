<?php

///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
// Ajax Controller
// First controller for ajax requests
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

// delegate processing to the appropriate controller based on the page request url
$g_aValidBNames = array('', 'ForceSave', 'FormValidate', 'AutoComplete', 'PostcodeSearch');

if (!isset($g_hRequestVars['b']) || !$g_hRequestVars['b'])
	$g_hRequestVars['b'] = '';
$g_hRequestVars['b'] = InputFilter::filterArray($g_hRequestVars['b'], $g_aValidBNames);

switch ($g_hRequestVars['b'])
{
	// force a file that may be openable in the browser to be saved instead
	case 'ForceSave':
		if (getRequestValue('FileName') && getRequestValue('NewName'))
		{
			header("Content-type: application/x-octet-stream");
			header("Content-Disposition: attachment; filename=" . $g_hRequestVars['NewName']);
			readfile($g_sTempFolder . $g_hRequestVars['FileName']);
		}
		break;

	// validate forms
	case 'FormValidate':
		$g_aValidCNames = array('');
		$g_hRequestVars['c'] = InputFilter::filterArray($g_hRequestVars['c'], $g_aValidCNames);
		require_once('controller.AjaxFormValidate.php');
		break;

	// supplies values for autocomplete enabled textboxes
	case 'AutoComplete':
		$g_aValidCNames = array('');
		$g_hRequestVars['c'] = InputFilter::filterArray($g_hRequestVars['c'], $g_aValidCNames);
		$t_sString = getRequestValue('q'); 
		$t_iLimit = getRequestValue('limit');
		$t_hResult = array();
		switch ($g_hRequestVars['c'])
		{

			default:
				break;
		}
		$t_sString = '';
		if (sizeof($t_hResult) > 0)
		{
			foreach ($t_hResult as $key => $val)
			{
				if ($key > 0){$t_sString .= "\n";}
				$t_sString .= $t_hResult[$key]['name'];
			}
		}
		echo $t_sString;
		break;

	// conduct a postcode search
	case 'PostcodeSearch':
		$g_aValidCNames = array('CheckPostcode', 'CheckAddress');
		$g_hRequestVars['c'] = InputFilter::filterArray($g_hRequestVars['c'], $g_aValidCNames);
		
		$t_sURL = '';
		if ($g_hRequestVars['c'] == 'CheckPostcode')
		{
			$t_sPostcode = $g_hRequestVars['Postcode'];
			$t_sPostcode = str_replace(" ", "", $t_sPostcode);
			$t_sURL = $g_sPostcodeSearchServer . '/InlineComboSearch.aspx?datakey=' . $g_sPostcodeSearchKey . '&postcode=' . $t_sPostcode . '&AppID=36&style=100&showlic=0&lines=8&style=1&text=';
		}
		else if ($g_hRequestVars['c'] == 'CheckAddress')
		{
			$t_sAddressID = $g_hRequestVars['AddressID'];
			$t_sURL = $g_sPostcodeSearchServer . '/GetAddressRecord.aspx?datakey=' . $g_sPostcodeSearchKey . '&id=' . $t_sAddressID . '&AppID=36';
		}
		if ($t_sURL)
		{
			$t_oCURL = curl_init();
			curl_setopt($t_oCURL, CURLOPT_URL, $t_sURL);
			curl_setopt($t_oCURL, CURLOPT_CONNECTTIMEOUT, 2);
			curl_setopt($t_oCURL, CURLOPT_RETURNTRANSFER, 1);
			$t_sResult = curl_exec($t_oCURL);
			curl_close($t_oCURL);

			if ($g_hRequestVars['c'] == 'CheckPostcode')
			{
				echo $t_sResult;
			}
			else if ($g_hRequestVars['c'] == 'CheckAddress')
			{
				if (strpos($t_sResult, '<line1>')) 
				{
					echo $t_sResult;
				}
				else
				{
					echo '<data></data>';
				}
			}
		}
		break;

	default:
		break;
}

?>