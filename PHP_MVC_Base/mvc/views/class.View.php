<?php

///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
// View
// Base class for different view types
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

abstract class View
{
	protected $m_oDb;

	protected $m_sBaseContent;
	protected $m_sContent;
	protected $m_hVars;
	protected $m_bNoBase;

	function __construct($p_sFileName, $p_hVars, $p_bNoBase = false)
	{
		global $g_oDb;

		$this->m_oDb = $g_oDb;
		$p_sFileName = './mvc/templates/' . $p_sFileName;
		if(!$t_oFile = fopen($p_sFileName, 'r'))
        {
			throw new Exception('The page you were looking for could not be opened');
		}
		else
		{
			$this->m_sContent = fread($t_oFile, filesize($p_sFileName));
			fclose($t_oFile);
			$this->m_hVars = $p_hVars;
			$this->m_bNoBase = $p_bNoBase;
		}
	}

	function getContent()
	{
		return $this->m_sContent;
	}
	function setContent($p_sString)
	{
		$this->m_sContent = $p_sString;
	}

	function setVar($p_sKey, $p_sVal)
	{
		$this->m_hVars[$p_sKey] = $p_sVal;
	}

	function getVar($p_sKey)
	{
		if (!isset($this->m_hVars[$p_sKey]))
			return false;
		else
			return $this->m_hVars[$p_sKey];
	}

	function contentReplace($p_sContent)
	{
		// carry out by subclass
	}

	function render($p_bEchoResult = true)
	{
		// carry out by subclass
	}
}

?>