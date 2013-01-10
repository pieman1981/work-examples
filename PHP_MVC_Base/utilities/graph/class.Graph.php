<?php

abstract class Graph 
{

	protected $m_sSitePathUnsecure;

	protected $m_sType = '';
	protected $m_iWidth = 300;
	protected $m_iHeight = 300;
	protected $m_aData = array();
	protected $m_sFileName = '';
	protected $m_sURL = '';

	private function stringData()
	{
		$t_sData = '';
		if (sizeof($this->m_aData))
		{
			foreach ($this->m_aData as $key => $val)
			{
				if ($key > 0)
					$t_sData .= ',';
				$t_sData .= $val;
			}
		}
		return $t_sData;
	}

	//public function used outside the class to set the arrays for data
	public function setData($p_aData)
	{
		$this->m_aData = $p_aData;
	}

	//get file name outside object
	public function getFileName()
	{
		return $this->m_sFileName;
	}

	//used to stop cache when creatye image outside function
	public function getHash()
	{
		$t_sHash = array_sum(explode(" ", microtime()));
		$t_sHash .= '|' . rand(1, 1000000);
		$t_sHash = md5($t_sHash);

		return $t_sHash;
	}
	
	protected function makeGraphURL()
	{
		$this->m_sURL = 'http://209.85.227.113/chart?&cht='.$this->m_sType.'&chd=t:'. $this->stringData() .'&chs='.$this->m_iWidth.'x'.$this->m_iHeight;
	}

	protected function buildGraph()
	{
		$ch = curl_init($this->m_sURL);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_HEADER, 0);
		$t_sImage = curl_exec($ch);
		curl_close($ch);

		if ($t_oFile = fopen($this->m_sFileName, 'w'))
		{
			fwrite($t_oFile, $t_sImage);
			fclose($t_oFile);
			
			return true;
		}
		else
		{
			return false;
		}
	}



}
?>