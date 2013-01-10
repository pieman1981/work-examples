<?php

///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
// UserSession
// Records and maintains each user session
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

class UserSession
{
	private $m_iNativeSessionID;
	private $m_sPHPSessionID;
	private $m_oDb;
	private $m_bLoggedIn;
	private $m_iUserID;
	private $m_iSessionTimeout = 18000;
	private $m_iSessionLifespan = 324000;

	function __construct()
	{
		global $g_oDb;

		$this->m_oDb = $g_oDb;

		session_set_save_handler(
			array(&$this, 'sessionOpenMethod'),
			array(&$this, 'sessionCloseMethod'),
			array(&$this, 'sessionReadMethod'),
			array(&$this, 'sessionWriteMethod'),
			array(&$this, 'sessionDestroyMethod'),
			array(&$this, 'sessionGCMethod')
		);
		$t_sUserAgent = '';
		if (isset($_SERVER["HTTP_USER_AGENT"]))
			$t_sUserAgent = $_SERVER["HTTP_USER_AGENT"];
		if (isset($_COOKIE["PHPSESSID"]))
		{
			$this->m_sPHPSessionID = $_COOKIE["PHPSESSID"];
			$t_sWhere = "ascii_session_id = '" . $this->m_oDb->escapeString($this->m_sPHPSessionID) . "' AND ((NOW() - created) < '" . $this->m_iSessionLifespan . " seconds') AND user_agent = '" . $this->m_oDb->escapeString($t_sUserAgent) . "' AND ((NOW() - last_impression) <= '" . $this->m_iSessionTimeout . " seconds' OR last_impression = '0000-00-00 00:00:00')";

			$t_hResult = $this->m_oDb->select(array('id'), array('user_session'), $t_sWhere, true);
			if (sizeof($t_hResult) == 0)
			{
				$t_bFailed = true;

				$this->m_oDb->delete('user_session', "ascii_session_id = '" . $this->m_oDb->escapeString($this->m_sPHPSessionID) . "' OR (NOW() - created) > " . $this->m_iSessionLifespan);
				$this->m_oDb->delete('session_variable', "session_id NOT IN (SELECT id FROM user_session)");
				unset($_COOKIE["PHPSESSID"]);
			}
		}
		session_set_cookie_params($this->m_iSessionLifespan);
		session_start();
	}

	function impress()
	{
		if ($this->m_iNativeSessionID)
		{
			$this->m_oDb->update('user_session', array('last_impression' => 'NOW()'), "id = " . $this->m_iNativeSessionID);
		}
	}

	function isLoggedIn()
	{
		return $this->m_bLoggedIn;
	}

	function getUserID()
	{
		if ($this->m_bLoggedIn)
			return $this->m_iUserID;
		else
			return false;
	}

	function getSessionIdentifier()
	{
		return $this->m_sPHPSessionID;
	}

	function getID()
	{
		return $this->m_iNativeSessionID;
	}

	function logIn($p_sUsername, $p_sPlainPassword)
	{
		global $g_hViewVars;

		$t_sMD5Password = md5($p_sPlainPassword);
		$t_hResult = $this->m_oDb->select(array('id', 'is_activated', 'is_active'), array('user'), "username = '" . $this->m_oDb->escapeString($p_sUsername) . "' AND password = '" . $t_sMD5Password . "'", true);
		if (sizeof($t_hResult) > 0)
		{
			if (!$t_hResult['is_activated'])
			{
				$g_hViewVars['LoginFailed'] = 'account not activated';
				return false;
			}
			else if (!$t_hResult['is_active'])
			{
				$g_hViewVars['LoginFailed'] = 'account disabled';
				return false;
			}
			else
			{
				$this->m_iUserID = $t_hResult['id'];
				$this->m_bLoggedIn = true;
				$this->m_oDb->update('user_session', array('logged_in' => 1, 'user_id' => $this->m_iUserID), "id = " . $this->m_iNativeSessionID);
				$this->m_oDb->insert('log_log_in', array('user_id' => $this->m_iUserID, 'time_stamp' => NOW));
				return true;
			}
		}
		else
		{
			$g_hViewVars['LoginFailed'] = 'login failed';
			return false;
		}
	}

	function logOut()
	{
		if ($this->m_bLoggedIn)
		{
			$this->m_oDb->update('user_session', array('logged_in' => 0, 'user_id' => 0), "id = " . $this->m_iNativeSessionID);
			$this->m_bLoggedIn = false;
			$this->m_iUserID = 0;
			return true;
		}
		else
		{
			return false;
		}
	}

	function __get($p_sName)
	{
		$t_hResult = $this->m_oDb->select(array('variable_value'), array('session_variable'), "session_id = " . $this->m_iNativeSessionID . " AND variable_name = '" . $this->m_oDb->escapeString($p_sName) . "'", true);
		if (sizeof($t_hResult) > 0)
		{
			return unserialize($t_hResult['variable_value']);
		}
		else
		{
			return false;
		}
	}

	function __set($p_sName, $p_oValue)
	{
		$t_sString = serialize($p_oValue);
		$this->m_oDb->delete('session_variable', "session_id = '" . $this->m_iNativeSessionID . "' AND variable_name = '" . $this->m_oDb->escapeString($p_sName) . "'");
		$this->m_oDb->insert('session_variable', array('session_id' => $this->m_iNativeSessionID, 'variable_name' => $p_sName, 'variable_value' => $t_sString));
	}



	function sessionOpenMethod($p_sSavePath, $p_sSessionName)
	{
		return true;
	}

	function sessionCloseMethod()
	{
		return true;
	}

	function sessionReadMethod($p_sID)
	{
		$t_sUserAgent = '';
		if (isset($_SERVER["HTTP_USER_AGENT"]))
			$t_sUserAgent = $_SERVER["HTTP_USER_AGENT"];
		$this->m_sPHPSessionID = $p_sID;
		$t_bFailed = 1;
		$t_hResult = $this->m_oDb->select(array('id', 'logged_in', 'user_id'), array('user_session'), "ascii_session_id = '" . $p_sID . "'", true);
		if (sizeof($t_hResult) > 0)
		{
			$this->m_iNativeSessionID = $t_hResult['id'];
			if ($t_hResult['logged_in'] == 1)
			{
				$this->m_bLoggedIn = true;
				$this->m_iUserID = $t_hResult['user_id'];
			}
			else
			{
				$this->m_bLoggedIn = false;
			}
		}
		else
		{
			$this->m_bLoggedIn = false;
			$this->m_oDb->insert('user_session', array('ascii_session_id' => $p_sID, 'logged_in' => 0, 'user_id' => 0, 'created' => 'NOW()', 'user_agent' => $t_sUserAgent));
			$t_hResult = $this->m_oDb->select(array('id'), array('user_session'), "ascii_session_id = '" . $p_sID . "'", true);
			$this->m_iNativeSessionID = $t_hResult['id'];
		}
		return '';
	}

	function sessionWriteMethod($p_sID, $p_sSessData)
	{
		return true;
	}

	function sessionDestroyMethod($p_sID)
	{
		$this->m_oDb->delete('user_session', "ascii_session_id = '" . $p_sID . "'");
	}

	function sessionGCMethod($p_iMaxLifetime)
	{
		return true;
	}

}

?>