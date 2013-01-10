<?php

///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
// Encrypt
// Class that returns an encrypted version of a string based on global salt settings
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

abstract class Encrypt
{
	// encrypt given string
	static function encryptString($p_sString)
	{
		global $g_sEncryptionSaltFront, $g_sEncryptionSaltBack;

		return md5($g_sEncryptionSaltFront . $p_sString . $g_sEncryptionSaltBack);
	}

	// brute force number decrypt attempt
	static function decryptNumberString($p_String, $p_sLimit = '100000')
	{
		global $g_sEncryptionSaltFront, $g_sEncryptionSaltBack;
		
		for ($i = 0; $i < $p_sLimit; $i++)
		{
			if (Encrypt::encryptString($i) == $p_sString)
				return $i;
		}

		return false;
	}
}

?>