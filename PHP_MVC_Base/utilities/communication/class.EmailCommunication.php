<?php

///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
// EmailCommunication
// Email sending class
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

require_once('communication/class.Communication.php');
require_once('communication/class.EmailRecipient.php');
require_once('communication/class.EmailAttachment.php');

class EmailCommunication extends Communication
{
	private $m_aToRecipients;
	private $m_aCCRecipients;
	private $m_aBCCRecipients;
	private $m_oReplyTo;
	private $m_oSender;

	private $m_sContentType;
	private $m_sMessageType;
	private $m_sEncoding;
	private $m_sCharSet;

	private $m_sBody;
	private $m_sAltBody;
	private $m_sSubject;

	private $m_aBoundaries;
	private $m_aAttachments;

	function __construct()
	{
		$this->m_sEncoding = '8bit';
		$this->m_sCharSet = 'utf-8';

		$this->m_aToRecipients = new Collection();
		$this->m_aCCRecipients = new Collection();
		$this->m_aBCCRecipients = new Collection();
		$this->m_aBoundaries = new Collection();
		$this->m_aAttachments = new Collection();
		parent::__construct();
	}

	function addToRecipient($p_oRecipient)
	{
		if (!$this->m_aToRecipients->exists($p_oRecipient->getStringRepresentation()))
		{
			$this->m_aToRecipients->addItem($p_oRecipient, $p_oRecipient->getStringRepresentation());
		}
	}
	function addCCRecipient($p_oRecipient)
	{
		if (!$this->m_aCCRecipients->exists($p_oRecipient->getStringRepresentation()))
		{
			$this->m_aCCRecipients->addItem($p_oRecipient, $p_oRecipient->getStringRepresentation());
		}
	}
	function addBCCRecipient($p_oRecipient)
	{
		if (!$this->m_aBCCRecipients->exists($p_oRecipient->getStringRepresentation()))
		{
			$this->m_aBCCRecipients->addItem($p_oRecipient, $p_oRecipient->getStringRepresentation());
		}
	}
	function setReplyTo($p_oRecipient)
	{
		$this->m_oReplyTo = clone $p_oRecipient;
	}
	function setSender($p_oRecipient)
	{
		$this->m_oSender = clone $p_oRecipient;
	}

	function setIsHTML($p_bTrueOrFalse) 
	{
		if($p_bTrueOrFalse)
			$this->m_sContentType = 'text/html';
		else
			$this->m_sContentType = 'text/plain';
	}
	function setSubject($p_sSubject)
	{
		$this->m_sSubject = $p_sSubject;
	}
	function setBody($p_sBody)
	{
		$this->m_sBody = $p_sBody;
	}
	function setAltBody($p_sAltBody)
	{
		$this->m_sAltBody = $p_sAltBody;
	}
	function addAttachment($p_oAttachment)
	{
		if(!@is_file($p_oAttachment->getPath()))
		{
			throw new Exception('Invalid attachment');
		}
		$this->m_aAttachments->addItem($p_oAttachment);
	}
	function getAttachments()
	{
		return $this->m_aAttachments;
	}



	private function getRFCDate()
	{
		date_default_timezone_set('Europe/London');
        $t_sTimeZone = date('Z');
        $t_sTimeZoneSign = ($t_sTimeZone < 0) ? '-' : '+';
        $t_sTimeZone = abs($t_sTimeZone);
        $t_sTimeZone = (($t_sTimeZone / 3600) * 100) + (($t_sTimeZone % 3600) / 60);
		while (strlen($t_sTimeZone) < 4)
		{
			$t_sTimeZone = '0' . $t_sTimeZone;
		}
		$t_sDate = date("D, j M Y H:i:s") . " " . $t_sTimeZoneSign . $t_sTimeZone;
        return $t_sDate;
    }

	private function fixEOL($p_sString)
	{
		$p_sString = str_replace("\r\n", "\n", $p_sString);
		$p_sString = str_replace("\r", "\n", $p_sString);
		return $p_sString;
	}

	private function encodeString($p_sString, $p_sEncoding = 'base64')
	{
		switch (strtolower($p_sEncoding))
		{
			case 'base64':
				$t_sEncoded = chunk_split(base64_encode($p_sString));
				break;
			case '7bit':
			case '8bit':
				$t_sEncoded = $this->fixEOL($p_sString);
				if (substr($t_sEncoded, -2) != "\n")
					$t_sEncoded .= "\n";
				break;
			case 'binary':
				$t_sEncoded = $p_sString;
				break;
			default:
				break;
		}
		return $t_sEncoded;
	}

	private function encodeFile($p_sPath, $p_sEncoding = 'base64')
	{
		@$t_oFile = fopen($p_sPath, 'rb');
		$t_sFile = fread($t_oFile, filesize($p_sPath));
		$t_sEncoded = $this->encodeString($t_sFile, $p_sEncoding);
		fclose($t_oFile);

		return $t_sEncoded;
	}

	private function attachAll()
	{
		$t_sText = '';
		foreach ($this->m_aAttachments as $t_oAttachment)
		{
			$t_sPath = $t_oAttachment->getPath();
			$t_sFileName = $t_oAttachment->getFileName();
			$t_sName = $t_oAttachment->getNewName();
			$t_sEncoding = $t_oAttachment->getEncoding();
			$t_sType = $t_oAttachment->getType();
			$t_sDisposition = 'attachment';

			$t_sText .= "--" . $this->m_aBoundaries->getItem(1) . "\n";
			$t_sText .= "Content-Type: " . $t_sType . "; name=\"" . $t_sName . "\"\n";
			$t_sText .= "Content-Transfer-Encoding: " . $t_sEncoding . "\n";
			$t_sText .= "Content-ID: <" . $t_sName . ">\n";
			$t_sText .= "Content-Disposition: " . $t_sDisposition . "; filename=\"" . $t_sName . "\"\n\n";

			$t_sText .= $this->encodeFile($t_sPath, $t_sEncoding) . "\n\n";
			//$t_sText .= "...file data here\n\n";
		}
		$t_sText .= "--" . $this->m_aBoundaries->getItem(1) . "--\n";

		return $t_sText;
	}

	private function createHeader()
	{
		$t_sHeader = '';
		$t_sUniqueHash = md5(uniqid(time()));
		$this->m_aBoundaries->addItem('b1_' . $t_sUniqueHash, 1);
		$this->m_aBoundaries->addItem('b2_' . $t_sUniqueHash, 2);

		$t_sHeader .= "From: " . $this->m_oSender->getStringRepresentation() . "\n";
		if ($this->m_aCCRecipients->length())
		{
			$t_sHeader .= "Cc: "; $i = 0;
			foreach ($this->m_aCCRecipients as $t_oRecipient)
			{
				if ($i > 0){$t_sHeader .= ", ";}
				$t_sHeader .= $t_oRecipient->getStringRepresentation();
				$i++;
			}
			$t_sHeader .= "\n";
		}

		if ($this->m_aBCCRecipients->length())
		{
			$t_sHeader .= "Bcc: "; $i = 0;
			foreach ($this->m_aBCCRecipients as $t_oRecipient)
			{
				if ($i > 0){$t_sHeader .= ", ";}
				$t_sHeader .= $t_oRecipient->getStringRepresentation();
				$i++;
			}
			$t_sHeader .= "\n";
		}

		if (isset($this->m_oReplyTo))
		{
			$t_sHeader .= "Reply-to: " . $this->m_oReplyTo->getStringRepresentation() . "\n";
		}

		//$t_sHeader .= "Return-Path: " . $this->m_oSender->getStringRepresentation() . "\n";
		$t_sHeader .= "MIME-Version: 1.0\n";

		if ($this->m_aAttachments->length() < 1 && strlen($this->m_sAltBody) < 1)
		{
			$this->m_sMessageType = 'plain';
		}
		else
		{
			if ($this->m_aAttachments->length() > 0)
				$this->m_sMessageType = 'attachments';
			if (strlen($this->m_sAltBody) > 0 && $this->m_aAttachments->length() < 1)
				$this->m_sMessageType = 'alt';
			if (strlen($this->m_sAltBody) > 0 && $this->m_aAttachments->length() > 0)
				$this->m_sMessageType = 'alt_attachments';
		}
		
		switch ($this->m_sMessageType)
		{
			case 'plain':
				$t_sHeader .= "Content-Transfer-Encoding: " . $this->m_sEncoding . "\n";
				$t_sHeader .= "Content-Type: " . $this->m_sContentType . "; charset = \"" . $this->m_sCharSet . "\"\n";
				break;
			case 'attachments':
			case 'alt_attachments':
				$t_sHeader .= "Content-Type: multipart/mixed;\n";
				$t_sHeader .= "\tboundary=\"" . $this->m_aBoundaries->getItem(1) . "\"\n";
				break;
			case 'alt':
				$t_sHeader .= "Content-Type: multipart/alternative;\n";
				$t_sHeader .= "\tboundary=\"" . $this->m_aBoundaries->getItem(1) . "\"\n";
				break;
		}

		return $t_sHeader;
	}

	private function createBody()
	{
		$t_sBody = '';

		switch ($this->m_sMessageType)
		{
			case 'alt':
				$t_sBody .= "--" . $this->m_aBoundaries->getItem(1) . "\n";
				$t_sBody .= "Content-Type: text/plain; charset = \"" . $this->m_sCharSet . "\"\n";
				$t_sBody .= "\n" . $this->m_sAltBody . "\n\n";

				$t_sBody .= "--" . $this->m_aBoundaries->getItem(1) . "\n";
				$t_sBody .= "Content-Type: text/html; charset = \"" . $this->m_sCharSet . "\"\n";
				$t_sBody .= "\n" . $this->m_sBody . "\n\n";
				
				$t_sBody .= "\n--" . $this->m_aBoundaries->getItem(1) . "--\n\n";
				break;

			case 'plain':
				$t_sBody .= $this->m_sBody;
				break;

			case 'attachments':
				$t_sBody .= "--" . $this->m_aBoundaries->getItem(1) . "\n";
				$t_sBody .= "Content-Type: " . $this->m_sContentType . "; charset = \"" . $this->m_sCharSet . "\"\n";
				$t_sBody .= $this->m_sBody . "\n\n";
				$t_sBody .= $this->attachAll();
				break;

			case 'alt_attachments':
				$t_sBody .= "--" . $this->m_aBoundaries->getItem(1) . "\n";
				$t_sBody .= "Content-Type: multipart/alternative;\n";
				$t_sBody .= "\tboundary=\"" . $this->m_aBoundaries->getItem(2) . "\"\n\n";

				$t_sBody .= "--" . $this->m_aBoundaries->getItem(2) . "\n";
				$t_sBody .= "Content-Type: text/plain; charset = \"" . $this->m_sCharSet . "\"\n";
				$t_sBody .= "\n" . $this->m_sAltBody . "\n\n";

				$t_sBody .= "--" . $this->m_aBoundaries->getItem(2) . "\n";
				$t_sBody .= "Content-Type: text/html; charset = \"" . $this->m_sCharSet . "\"\n";
				$t_sBody .= "\n" . $this->m_sBody . "\n\n";
				$t_sBody .= "\n--" . $this->m_aBoundaries->getItem(2) . "--\n\n";
				$t_sBody .= $this->attachAll();

				break;
		}

		$t_sBody = $this->encodeString($t_sBody, $this->m_sEncoding);

		return $t_sBody;
	}


	function send()
	{
		$t_sHeader = '';
		$t_sBody = '';

		if ($this->m_aToRecipients->length() + $this->m_aCCRecipients->length() + $this->m_aBCCRecipients->length() < 1)
		{
			throw new Exception('No recipient address');
		}

		if(!empty($this->m_sAltBody))
			$this->m_sContentType = 'multipart/alternative';

		$t_sHeader .= "Date: " . $this->getRFCDate() . "\n";
		$t_sHeader .= $this->createHeader();

		if (!$t_sBody = $this->createBody())
		{
			throw new Exception('No message body');
		}

		$t_sTo = '';
		if ($this->m_aToRecipients->length())
		{
			$i = 0;
			foreach ($this->m_aToRecipients as $t_oRecipient)
			{
				if ($i > 0){$t_sTo .= ", ";}
				$t_sTo .= $t_oRecipient->getStringRepresentation();
				$i++;
			}
		}

		$t_bResult = @mail($t_sTo, $this->m_sSubject, $t_sBody, $t_sHeader);

		if (!$t_bResult)
		{
			throw new Exception('Mail send error');
		}
	}

}

?>