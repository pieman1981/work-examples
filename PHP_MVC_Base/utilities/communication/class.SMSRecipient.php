<?php

///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
// SMSRecipient
// A recipient device for an SMS message
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

require_once('communication/interface.Recipient.php');

class SMSRecipient implements Recipient
{
	private $m_sRecipientNumber;

	function __construct($p_sRecipientNumber)
	{
		$p_sRecipientNumber = str_replace(' ', '', $p_sRecipientNumber);
		$p_sRecipientNumber = preg_replace("/^(0)/i", "44", $p_sRecipientNumber);

		$this->m_sRecipientNumber = $p_sRecipientNumber;
	}

	function isValid()
	{
		if (preg_match("/^[0-9+ ]+$/i", $this->m_sRecipientNumber))
		{
			return true;
		}
		else
		{
			return false;
		}
	}

	function getStringRepresentation()
	{
		$t_sString = preg_replace("/^00/i", "+", $this->m_sRecipientNumber);
		return $t_sString;
	}

	function getRecipientNumber()
	{
		return $this->m_sRecipientNumber;
	}
}

?>