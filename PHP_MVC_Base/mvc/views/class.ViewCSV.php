<?php

///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
// ViewCSV
// View class for generating a csv file from a given array of data
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

require_once('class.View.php');

class ViewCSV extends View
{
	private $m_aData;
	private $m_sFileName;

	function __construct($p_sFileName, $p_aDataTable = false)
	{
		$this->m_sFileName = $p_sFileName;

		if (is_array($p_aDataTable))
		{
			$this->m_aData = $p_aDataTable;
		}
		else
		{
			$this->m_aData = array();
		}
	}

	function addRow($p_aRow)
	{
		if (!is_array($p_aRow))
			$p_aRow = array($p_aRow);

		$this->m_aData[] = $p_aRow;
	}

	function render($p_bEchoResult = true)
	{
		global $g_sTempFolder;

		if ($t_oFile = fopen($g_sTempFolder . $this->m_sFileName, 'w+'))
		{
			$t_iWidth = sizeof($this->m_aData);
			$t_iHeight = sizeof($this->m_aData[0]);
			
			$t_sString = '';
			for ($i = 0; $i < $t_iHeight; $i++)
			{
				for ($j = 0; $j < $t_iWidth; $j++)
				{
					if (isset($this->m_aData[$j][$i]))
						$t_sString .= '"' . $this->m_aData[$j][$i] . '"';
					if ($j < $t_iWidth - 1)
						$t_sString .= ',';
				}
				$t_sString .= "\n";
			}

			fwrite($t_oFile, $t_sString);
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