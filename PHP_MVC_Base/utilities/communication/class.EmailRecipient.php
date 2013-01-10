<?php

///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
// EmailRecipient
// A recipient for an email
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

require_once('communication/interface.Recipient.php');

class EmailRecipient implements Recipient
{
	private $m_sRecipientName;
	private $m_sRecipientAddress;

	function __construct($p_sRecipientAddress, $p_sRecipientName = '')
	{
		$this->m_sRecipientName = $p_sRecipientName;
		$this->m_sRecipientAddress = trim($p_sRecipientAddress);
	}

	function isValid()
	{
		if (preg_match("/[\<\>\r\n]{1,}/", $this->m_sRecipientName))
		{
			return false;
		}
		if (preg_match("/^[A-Z0-9._%+-]+@[A-Z0-9.-]+\.[A-Z]{2,4}$/i", $this->m_sRecipientAddress))
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
		$t_sString = '';
		if ($this->m_sRecipientName)
		{
			$t_sString .= $this->m_sRecipientName . ' ';
		}
		$t_sString .= '<' . $this->m_sRecipientAddress . '>';
		return $t_sString;
	}

	function getRecipientName()
	{
		return $this->m_sRecipientName;
	}

	function getRecipientAddress()
	{
		return $this->m_sRecipientAddress;
	}
}



?>