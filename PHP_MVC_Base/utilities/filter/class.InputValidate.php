<?php

///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
// InputValidate
// Validates input in the request array against expected results
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

abstract class InputValidate
{

	// check a non empty value has been given (but allow 0)
	static function validateExistsNonEmpty($p_sName)
	{
		global $g_hRequestVars;

		if (!isset($g_hRequestVars[$p_sName]) || (!$g_hRequestVars[$p_sName] && $g_hRequestVars[$p_sName] !== 0))
			return false;
		else
			return true;
	}

	// validate against a typical email address format
	static function validateEmail($p_sName)
	{
		global $g_hRequestVars;

		if (!isset($g_hRequestVars[$p_sName]))
			return false;
		else
		{
			if (preg_match("/\b[A-Z0-9._%+-]+@[A-Z0-9.-]+\.[A-Z]{2,4}\b/i", $g_hRequestVars[$p_sName]))
				return true;
			else
				return false;
		}
	}

	// validate against a english date format
	static function validateDate($p_sName)
	{
		global $g_hRequestVars;

		if (!isset($g_hRequestVars[$p_sName]))
			return false;
		else
		{
			if (preg_match("/[0-9][0-9]\/[0-9][0-9]\/[0-9][0-9][0-9][0-9]/", $g_hRequestVars[$p_sName]))
				return true;
			else
				return false;
		}
	}

	// check passed value does not already exist in the database
	static function validateUniqueRecord($p_sName, $p_sTable, $p_sField, $p_iSelfID)
	{
		global $g_hRequestVars, $g_oDb;

		$t_hResult = $g_oDb->select(array('id'), array($p_sTable), $p_sField . " = '" . $g_oDb->escapeString($g_hRequestVars[$p_sName]) . "' AND id != '" . $p_iSelfID . "'");
		if (sizeof($t_hResult) > 0)
			return false;
		else
			return true;
	}

	// check passed value already exists in the database
	static function validateMatchRecord($p_sName, $p_sTable, $p_sField)
	{
		global $g_hRequestVars, $g_oDb;

		$t_hResult = $g_oDb->select(array('id'), array($p_sTable), $p_sField . " = '" . $g_oDb->escapeString($g_hRequestVars[$p_sName]) . "'");
		if (sizeof($t_hResult) > 0)
			return true;
		else
			return false;
	}

	// get the ID or IDs from the database that match the given value
	static function getIDMatchRecord($p_sName, $p_sTable, $p_sField)
	{
		global $g_hRequestVars, $g_oDb;

		$t_hResult = $g_oDb->select(array('id'), array($p_sTable), $p_sField . " = '" . $g_oDb->escapeString($g_hRequestVars[$p_sName]) . "'");
		if (sizeof($t_hResult) > 0)
		{
			$t_aResults = array();
			foreach ($t_hResult as $key => $val)
			{
				$t_aResults[] = $t_hResult[$key]['id'];
			}
			return $t_aResults;;
		}
		else
			return false;
	}

	// check that the given value appears somewhere within the reference string
	static function validateSinglePartialTextMatch($p_sName, $p_sReferenceString)
	{
		global $g_hRequestVars;

		$t_iMatches = 0;
		str_replace(strtolower($g_hRequestVars[$p_sName]), '', strtolower($p_sReferenceString), $t_iMatches);
		if ($t_iMatches)
			return true;
		else
			return false;
	}

}

?>