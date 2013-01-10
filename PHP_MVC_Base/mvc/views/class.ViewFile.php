<?php

///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
// ViewFile
// View class for generating a text file from given content
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

require_once('class.View.php');

class ViewFile extends View
{
	private $m_sFileName;

	function __construct($p_sFileName, $p_sContent = false)
	{
		$this->m_sFileName = $p_sFileName;
		
		if ($p_sContent)
		{
			$this->m_sContent = $p_sContent;
		}
	}

	function render($p_bEchoResult = true)
	{
		global $g_sTempFolder;

		if ($t_oFile = fopen($g_sTempFolder . $this->m_sFileName, 'w+'))
		{
			fwrite($t_oFile, $this->m_sContent);
			fclose($t_oFile);
		}
		else
		{
			throw new Exception('Could not open file for writing');
		}

		return $this->m_sFileName;
	}
}

?>