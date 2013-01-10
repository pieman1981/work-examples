<?php

///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
// SMSCommunication
// Class for sending a text message to a mobile device
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

require_once('communication/class.Communication.php');
require_once('communication/class.SMSRecipient.php');

class SMSCommunication extends Communication
{
	private $m_sSender;

	function __construct()
	{
		$this->m_sSender = '';
		parent::__construct();
	}

	function setSender($p_sString)
	{
		$this->m_sSender = $p_sString;
	}

	function getRecipientCount()
	{
		return $this->m_aRecipientCollection->length();
	}

	function send()
	{
		global $g_sSMSUser, $g_sSMSPassword;

		if ($this->m_aRecipientCollection->length() < 1)
		{
			throw new Exception('No recipient number');
		}
		if (!$this->m_sMessage)
		{
			throw new Exception('No message specified');
		}

		$t_aResults = array();
		foreach ($this->m_aRecipientCollection as $t_oRecipient)
		{
			$t_sRequest = 'https://sms.mxtelecom.com/SMSSend?user=' . $g_sSMSUser . '&pass=' . $g_sSMSPassword . '&split=3';
			if ($this->m_sSender)
				$t_sRequest .= '&smsfrom=' . urlencode($this->m_sSender);
			$t_sRequest .= '&smsto=' . $t_oRecipient->getRecipientNumber() . '&smsmsg=' . urlencode($this->m_sMessage);

			$t_oCurl = curl_init($t_sRequest);

			curl_setopt($t_oCurl, CURLOPT_SSL_VERIFYPEER, false);
			curl_setopt($t_oCurl, CURLOPT_SSL_VERIFYHOST, false);
			curl_setopt($t_oCurl, CURLOPT_RETURNTRANSFER, true);

			$t_aResults[] = curl_exec($t_oCurl);
			curl_close($t_oCurl);
		}
		return $t_aResults;
	}
}





?>