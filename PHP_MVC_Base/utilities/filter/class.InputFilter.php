<?php

///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
// InputFilter
// Provides filters for input variables to transform into a desired format or range
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

abstract class InputFilter
{
	// filter to a boolean value
	static function filterBool($p_sInput)
	{
		if ($p_sInput)
			return true;
		else
			return false;
	}

	// filter a currency value of type £1,000.00 into a plain float 1000.00
	static function filterCleanCurrency($p_sInput)
	{
		$p_sInput = str_replace('Â£', '', $p_sInput);
		$p_sInput = str_replace('£', '', $p_sInput);
		$p_sInput = str_replace(',', '', $p_sInput);

		return floatval($p_sInput);
	}

	// filter to a whole number greater or equal to 0
	static function filterPositiveInteger($p_sInput)
	{
		$p_sInput = str_replace(',', '', $p_sInput);
		if (!is_numeric($p_sInput)){$p_sInput = 0;}
		$p_sInput = round($p_sInput);
		if ($p_sInput < 0){$p_sInput = 0;}
		return $p_sInput;
	}

	// filter a floating point number of fixed decimal places using trailing 0's if needed
	static function filterFloat($p_sInput, $p_iDecimalPlaces = 0)
	{
		if (!is_numeric($p_sInput)){$p_sInput = 0;}

		$p_sInput = number_format($p_sInput, $p_iDecimalPlaces, '.', '');

		return $p_sInput;
	}

	// filter to a standard date string
	static function filterDate($p_sString, $p_bFromDatePicker = false)
	{
		// date picker dates arrive in the form 21/03/2009
		if ($p_bFromDatePicker)
		{
			$t_aParts = explode('/', $p_sString);
			if (sizeof($t_aParts) > 1)
			{
				$p_sString = $t_aParts[2] . '-' . $t_aParts[1] . '-' . $t_aParts[0];
			}
		}

		// chop off any time portion
		$t_aParts = explode(' ', $p_sString);
		$p_sString = $t_aParts[0];

		if (!preg_match("/^([0-9][0-9][0-9][0-9])-([0-9][0-9])-([0-9][0-9])$/", $p_sString))
		{
			$p_sString = '0000-00-00';
		}
		return $p_sString;
	}

	// filter to a date string with a time element
	static function filterDateTime($p_sString)
	{
		// add a blank time portion if needed
		if (preg_match("/^([0-9][0-9][0-9][0-9])-([0-9][0-9])-([0-9][0-9])$/", $p_sString))
		{
			$p_sString .= ' 00:00:00';
		}

		if (!preg_match("/^([0-9][0-9][0-9][0-9])-([0-9][0-9])-([0-9][0-9]) ([0-9][0-9]):([0-9][0-9]):([0-9][0-9])$/", $p_sString))
		{
			$p_sString = '0000-00-00 00:00:00';
		}
		return $p_sString;
	}

	// get a timestamp from a date that can be used in date calculations
	static function filterTimeStampFromDate($p_sString)
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

	// add a number of days, months or years to a given date
	static function filterDateAdd($p_sStartDate, $p_iDays = 0, $p_iMonths = 0, $p_iYears = 0)
	{
		$p_sStartDate = InputFilter::filterDateTime($p_sStartDate);
		$t_aDateParts = explode(' ', $p_sStartDate);
		$t_sDate = $t_aDateParts[0];
		$t_sTime = $t_aDateParts[1];
		$t_aDateParts2 = explode('-', $t_sDate);
		$t_aDateParts3 = explode(':', $t_sTime);
		
		return date('Y-m-d H:i:s', mktime($t_aDateParts3[0], $t_aDateParts3[1], $t_aDateParts3[2], $t_aDateParts2[1] + $p_iMonths, 
											$t_aDateParts2[2] + $p_iDays, $t_aDateParts2[0] + $p_iYears));
	}

	// get the days difference between two dates
	static function filterDateDiff($p_sStartDate, $p_sEndDate)
	{
		$t_sDate1 = InputFilter::filterTimeStampFromDate($p_sStartDate);
		$t_sDate2 = InputFilter::filterTimeStampFromDate($p_sEndDate);
		$t_sDate2 += 86399;

		$t_iDiffSeconds = $t_sDate2 - $t_sDate1;
		$t_iDiffDays = floor($t_iDiffSeconds / 86400);

		return $t_iDiffDays;
	}

	// get an age from a date of birth
	static function filterAgeFromDateOfBirth($p_sDOB, $p_sCurrentDate = TODAY, $p_bFromDatePicker = false)
	{
		$t_sDOB = InputFilter::filterDate($p_sDOB, $p_bFromDatePicker);


		$t_iYear = substr($t_sDOB,0,4);
		if ($p_sCurrentDate == TODAY)
		{
			$t_iAge = intval(date("Y")) - intval($t_iYear);
			if (($t_iYear . '-' . date("m-d")) < $t_sDOB)
				$t_iAge--;
		}
		else
		{
			$t_aParts = explode('-', $p_sCurrentDate);
			$t_iAge = intval($t_aParts[0]) - intval($t_iYear);
			if (($t_iYear . '-' . $t_aParts[1] . '-' . $t_aParts[2]) < $t_sDOB)
				$t_iAge--;
		}
		return $t_iAge;
	}

	// filter based on a string array of acceptable values
	static function filterArray($p_sInput, $p_aValues)
	{
		$t_iIndex = array_search($p_sInput, $p_aValues);
		if ($t_iIndex || $t_iIndex === 0)
		{
			return $p_aValues[$t_iIndex];
		}
		return 'Unknown';
	}

	// try and break up a string based on some common separators
	static function filterParts($p_sString)
	{
		$t_aParts = array();
		while (true)
		{
			// try new lines
			$t_aParts = explode("\n", $p_sString);
			if (sizeof($t_aParts) > 1){break;}
			// try ;
			$t_aParts = explode(';', $p_sString);
			if (sizeof($t_aParts) > 1){break;}
			// try ,
			$t_aParts = explode(',', $p_sString);
			if (sizeof($t_aParts) > 1){break;}
			// try space character
			$t_aParts = explode(' ', $p_sString);
			if (sizeof($t_aParts) > 1){break;}
			
			// failed to break up string
			$t_aParts = array($p_sString);
			break;
		}
		foreach ($t_aParts as $key => $val)
		{
			$t_aParts[$key] = trim($val);
		}

		return $t_aParts;
	}

}

?>