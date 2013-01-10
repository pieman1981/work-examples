<?php

///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
// EmailAttachment
// An attachment for an email
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

class EmailAttachment
{
	private $m_sPath;
	private $m_sNewName;
	private $m_sEncoding;
	private $m_sType;

	function __construct()
	{
		$this->m_sEncoding = 'base64';
		$this->m_sType = 'application/octet-stream';
	}

  	function setPath($p_sPath)
	{
		$this->m_sPath = $p_sPath;

        $t_sFileName = basename($p_sPath);
		if (substr($t_sFileName,-1,3) == 'htm' || substr($t_sFileName,-1,3) == 'html')
		{
			$this->m_sEncoding = '8bit';
			$this->m_sType = 'text/html';
		}
	}
	function getPath()
	{
		return $this->m_sPath;
	}
	function getFileName()
	{
		return basename($this->m_sPath);
	}

	function setNewName($p_sNewName)
	{
		$this->m_sNewName = $p_sNewName;
	}

	function setEncoding($p_sEncoding)
	{
		$this->m_sEncoding = $p_sEncoding;
	}

	function getEncoding()
	{
		return $this->m_sEncoding;
	}

	function setType($p_sType)
	{
		$this->m_sType = $p_sType;
	}

	function getType()
	{
		return $this->m_sType;
	}

	function getNewName()
	{
        $t_sFileName = basename($this->m_sPath);
        if (!$this->m_sNewName)
            $this->m_sNewName = $t_sFileName;
		return $this->m_sNewName;
	}


}




?>