<?php

///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
// Communication
// Base class for a form of communication to the user
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

require_once('collection/class.Collection.php');
require_once('collection/class.CollectionIterator.php');

abstract class Communication
{
	protected $m_aRecipientCollection;
	protected $m_sMessage;

	protected $m_sErrorMessage;
	protected $m_sErrorCode;

	abstract public function send();

	function __construct()
	{
		$this->m_sMessage = '';
		$this->m_aRecipientCollection = new Collection();
	}
	
	function addRecipient($p_oRecipient, $p_sIdentifier = '')
	{
		$t_sStringRecipient = $p_oRecipient->getStringRepresentation();
		if (!$p_sIdentifier)
		{
			$p_sIdentifer = $t_sStringRecipient;
		}
		$this->m_aRecipientCollection->addItem($p_oRecipient, $p_sIdentifier);
	}

	function removeRecipient($p_sIdentifier)
	{
		$this->m_aRecipientCollection->removeItem($p_sIdentifier);
	}

	function setMessage($p_sMessage)
	{
		$this->m_sMessage = $p_sMessage;
	}

	function getMessage()
	{
		return $this->m_sMessage;
	}

	function getErrorMessage()
	{
		return $this->m_sErrorMessage;
	}

	function getErrorCode()
	{
		return $this->m_sErrorCode;
	}
}

?>