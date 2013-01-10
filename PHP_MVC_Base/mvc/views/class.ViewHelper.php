<?php

///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
// ViewHelper
// Functions for transforming raw data into a view form
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

abstract class ViewHelper
{
	// format into HTML ready for display on a web page
	static function formatHTML($p_sString)
	{
		$p_sString = htmlentities($p_sString, ENT_COMPAT);
		$p_sString = preg_replace("(\r\n|\n|\r)", '<br />', $p_sString);
		return $p_sString;
	}

	// format into all lower case
	static function formatLowerCase($p_sString)
	{
		return strtolower($p_sString);
	}

	// format an input array into a list string
	static function formatList($p_sInput, $p_sSeparator = ', ', $p_sFinalSeparator = '')
	{
		$t_sString = '';
		if (is_array($p_sInput))
		{
			foreach ($p_sInput as $key => $val)
			{
				if ($key == sizeof($p_sInput) - 1 && sizeof($p_sInput) > 1)
				{
					if ($p_sFinalSeparator)
						$t_sString .= $p_sFinalSeparator;
					else
						$t_sString .= $p_sSeparator;
				}
				else if ($key > 0){$t_sString .= $p_sSeparator;}
				$t_sString .= $val;
			}
		}
		else
		{
			$t_sString = $p_sInput;
		}
		return $t_sString;
	}

	// returns a string in a percentage format with optional decimal places
	static function formatPercentage($p_sString, $p_iDecimalPlaces = 0, $p_bMultiplyUp = false)
	{
		if (!is_numeric($p_sString)){$p_sString = 0;}
		if ($p_bMultiplyUp){$p_sString *= 100;}
		$p_sString = number_format($p_sString, $p_iDecimalPlaces, '.', '');
		$p_sString .= '%';
		return $p_sString;
	}

	// formats a float input into a premium or price style string in sterling
	static function formatPremium($p_sString)
	{
		if (!is_numeric($p_sString)){$p_sString = 0;}
		if (!$p_sString || $p_sString == -1.00 || $p_sString == 0.00)
		{
			$p_sString = '-';
		}
		else
		{
			if ($p_sString < 0)
				$p_sString = '-£' . number_format($p_sString * -1, 2);
			else
				$p_sString = '£' . number_format($p_sString, 2);
		}
		return $p_sString;
	}

	// formats a price in a long benefit style with no pennies included
	static function formatBenefit($p_sString)
	{
		if (!is_numeric($p_sString)){$p_sString = 0;}
		$p_sString = '£' . number_format($p_sString, 0);
		return $p_sString;
	}

	// turns a date into a time stamp to use in other functions
	static function formatTimeStampFromDate($p_sString)
	{
		$t_aDateParts = explode(' ', $p_sString);
		$t_sDate = $t_aDateParts[0];
		$t_aDateParts2 = explode('-', $t_sDate);
		if (isset($t_aDateParts[1]))
		{
			$t_sTime = $t_aDateParts[1];
			$t_aDateParts3 = explode(':', $t_sTime);
		}
		else
		{
			$t_aDateParts3[0] = 0;
			$t_aDateParts3[1] = 0;
			$t_aDateParts3[2] = 0;
		}

		return mktime($t_aDateParts3[0], $t_aDateParts3[1], $t_aDateParts3[2], $t_aDateParts2[1], $t_aDateParts2[2], $t_aDateParts2[0]);
	}

	// formats a date into a type of date string
	static function formatDate($p_sString, $p_sType)
	{
		$t_sString = '';
		if ($p_sString == '0000-00-00' || $p_sString == '0000-00-00 00:00:00')
		{
			return '-';
		}
		else
		{
			$t_sDate = ViewHelper::formatTimeStampFromDate($p_sString);
			switch ($p_sType)
			{
				case 'ClassicDateFullYear':
					$t_sString = date("d/m/Y", $t_sDate);
					break;

				case 'ClassicDate':
				default:
					$t_sString = date("d/m/y", $t_sDate);
					break;

				case 'ClassicDateTime':
					$t_sString = date("d/m/y g:i A", $t_sDate);
					break;

				case 'LongDate':
					$t_sString = date("d F Y", $t_sDate);
					break;
			}
			return $t_sString;
		}
	}

	// formats a dear name for a letter based on an input string containing a full or partial name
	static function formatAddressee($p_sString)
	{
		global $g_aTitles;

		$t_sString = '';
		$t_aParts = explode(' ', $p_sString);
		switch (sizeof($t_aParts))
		{
			case 1:
				$t_sString = $p_sString;
				break;

			default:
				$t_iIndex = array_search($t_aParts[0], $g_aTitles);
				if (strlen($t_aParts[0]) == 1 || $t_index || $t_iIndex === 0)
					$t_sString = $p_sString;
				else
					$t_sString = $t_aParts[0];
				break;
		}

		return $t_sString;
	}
}

?>