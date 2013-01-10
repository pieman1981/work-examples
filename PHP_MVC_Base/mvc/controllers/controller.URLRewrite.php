<?php

// take url parts and use to work out what section of site is being accessed

function URLRewrite()
{
	global $g_oDb, $g_hRequestVars;

	// concatenate url string
	$t_sDisplayURL = '';
	if (getRequestValue('p5'))
		$t_sDisplayURL = getRequestValue('p1') . '/' . getRequestValue('p2') . '/' . getRequestValue('p3') . '/' . getRequestValue('p4') . '/' . getRequestValue('p5');
	if (getRequestValue('p4'))
		$t_sDisplayURL = getRequestValue('p1') . '/' . getRequestValue('p2') . '/' . getRequestValue('p3') . '/' . getRequestValue('p4');
	else if (getRequestValue('p3'))
		$t_sDisplayURL = getRequestValue('p1') . '/' . getRequestValue('p2') . '/' . getRequestValue('p3');
	else if (getRequestValue('p2'))
		$t_sDisplayURL = getRequestValue('p1') . '/' . getRequestValue('p2');
	else if (getRequestValue('p1'))
		$t_sDisplayURL = getRequestValue('p1');

	// check against custom page urls
	$t_hResult = $g_oDb->select(array('url', 'name'), array('custom_page'), "url = '" . $g_oDb->escapeString($t_sDisplayURL) . "'", true);
	if (sizeof($t_hResult))
	{
		$g_hRequestVars['a'] = 'public';
		$g_hRequestVars['b'] = 'custom';
		$g_hRequestVars['c'] = $t_hResult['name'];
		return;
	}

	if (!getRequestValue('p1') && !getRequestValue('a'))
	{
		$g_hRequestVars['a'] = 'public';
		return;
	}

	if (getRequestValue('p1') == 'travel-news')
	{
		$g_hRequestVars['a'] = 'public';
		$g_hRequestVars['b'] = 'news';
		$g_hRequestVars['c'] = getRequestValue('p2');
		return;
	}
	else if (getRequestValue('p1') == 'media-desk')
	{
		$g_hRequestVars['a'] = 'public';
		$g_hRequestVars['b'] = 'media-desk';
		$g_hRequestVars['c'] = getRequestValue('p2');
		return;
	}

	if (getRequestValue('p3'))
	{
		$g_hRequestVars['a'] = getRequestValue('p1');
		$g_hRequestVars['b'] = getRequestValue('p2');
		$g_hRequestVars['c'] = getRequestValue('p3');
		$g_hRequestVars['d'] = getRequestValue('p4');
		$g_hRequestVars['e'] = getRequestValue('p5');

		//echo 'p3:' . $g_hRequestVars['p3'];

		$t_aVarParts = explode('?', $g_hRequestVars['c']);
		if (sizeof($t_aVarParts) > 1)
		{
			$t_aGetParts = explode('&', $t_aVarParts[1]);
			if (sizeof($t_aGetParts))
			{
				foreach ($t_aGetParts as $val)
				{
					$t_aGet = explode('=', $val);
					$g_hRequestVars[$t_aGet[0]] = $t_aGet[1];
				}
			}
			else
			{
				$t_aGet = explode('=', $t_aVarParts[1]);
				$g_hRequestVars[$t_aGet[0]] = $t_aGet[1];
			}
		}

		return;
	}
	if (getRequestValue('p2'))
	{
		$g_hRequestVars['a'] = getRequestValue('p1');
		$g_hRequestVars['b'] = getRequestValue('p2');
		return;
	}
	if (getRequestValue('p1'))
	{
		$g_hRequestVars['a'] = getRequestValue('p1');
		return;
	}
}

?>