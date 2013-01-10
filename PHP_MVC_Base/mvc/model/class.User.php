<?php

///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
// User
// Class for a user on the system
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

class User
{
	private $m_oDb;

	private $m_iID = 0;
	private $m_sUsername = '';
	private $m_sPassword = '';
	private $m_bIsActivated = false;
	private $m_bIsActive = false;

	function __construct($p_iUserID = 0)
	{
		global $g_oDb;

		$this->m_oDb = $g_oDb;
		$p_iUserID = InputFilter::filterPositiveInteger($p_iUserID);
		if ($p_iUserID)
		{
			$this->load($p_iUserID);
		}
	}

	function load($p_iUserID)
	{
		$p_iUserID = InputFilter::filterPositiveInteger($p_iUserID);
		$t_hResult = $this->m_oDb->select(array('*'), array('user'), "id = " . $p_iUserID, true);
		if (sizeof($t_hResult) > 0)
		{
			$this->m_iID = $t_hResult['id'];
			$this->m_sUsername = $t_hResult['username'];
			$this->m_sPassword = $t_hResult['password'];
			$this->m_bIsActivated = ($t_hResult['is_activated'] == 1 ? true : false);
			$this->m_bIsActive = ($t_hResult['is_active'] == 1 ? true : false);
		}
	}

	function save()
	{
		$t_hSave['username'] = $this->m_sUsername;
		$t_hSave['password'] = $this->m_sPassword;
		$t_hSave['is_activated'] = ($this->m_bIsActivated ? 1 : 0);
		$t_hSave['is_active'] = ($this->m_bIsActive ? 1 : 0);

		$t_bSaveNew = true;
		if ($this->m_iID)
		{
			$t_hResult = $this->m_oDb->select(array('id'), array('user'), "id = " . $this->m_iID, true);
			if (sizeof($t_hResult) > 0)
			{
				$t_bSaveNew = false;
			}
		}

		if ($t_bSaveNew)
		{
			$this->m_iID = $this->m_oDb->insert('user', $t_hSave);
		}
		else
		{
			$this->m_oDb->update('user', $t_hSave, "id = " . $this->m_iID);
		}
	}

	function setUsername($p_sString)
	{
		$this->m_sUsername = $p_sString;
	}
	function setPassword($p_sString)
	{
		$this->m_sPassword = md5($p_sString);
	}
	function setIsActivated($p_sString)
	{
		$p_sString = InputFilter::filterBool($p_sString);
		$this->m_bIsActivated = $p_sString;
	}
	function setIsActive($p_sString)
	{
		$p_sString = InputFilter::filterBool($p_sString);
		$this->m_bIsActive = $p_sString;
	}

	function getID()
	{
		return $this->m_iID;
	}
	function getUsername()
	{
		return $this->m_sUsername;
	}
	function getPassword()
	{
		return $this->m_sPassword;
	}
	function getIsActivated()
	{
		return $this->m_bIsActivated;
	}
	function getIsActive()
	{
		return $this->m_bIsActive;
	}


	function randomisePassword()
	{
		$t_sNewPassword = '';
		$t_aCharacters = array('a', 'b', 'c', 'd', 'e', 'f', 'g', 'h', 'j', 'k', 'm', 'n', 'p', 'q', 'r', 's', 't', 'u', 'v', 'w', 'x', 'y', 
			'z', 'A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'J', 'K', 'M', 'N', 'P', 'Q', 'R', 'S', 'T', 'U', 'V', 'W', 'X', 'Y', 'Z', '2', '3', 
			'4', '5', '6', '7', '8', '9');

		for ($i = 0; $i < 8; $i++)
		{
			$r = mt_rand(0,53);
			$t_sNewPassword .= $t_aCharacters[$r];
		}

		$this->setPassword($t_sNewPassword);

		return $t_sNewPassword;
	}


}

?>
