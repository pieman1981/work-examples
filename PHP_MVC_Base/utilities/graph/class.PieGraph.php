<?php
require_once('class.Graph.php');

class PieGraph extends Graph 
{
	//create variables that are specific to this type of graph
	private $m_aWedgeLabels = array();
	private $m_aKeyLabels = array();
	private $m_aWedgeColor = array();
	private $m_iTotal = 0;

	function __construct($p_sFileName,$p_iWidth=300,$p_iHeight=300)
	{
		$this->m_sType = 'p3';
		$this->m_sFileName = $p_sFileName;
		$this->m_iWidth = $p_iWidth;
		$this->m_iHeight = $p_iHeight;
	}
	
	//private function using arrays (private as not want to set outside)
	private function makeWedgeLabels()
	{
		if (sizeof($this->m_aWedgeLabels))
		{
			$t_sData = '';
			foreach ($this->m_aWedgeLabels as $key => $val)
			{
				if ($key > 0)
					$t_sData .= '|';
				$t_iPercent = number_format((($val/$this->m_iTotal)*100),0);
				$t_sData .= $t_iPercent.'%';
			}

			return '&chl='. $t_sData;
		}
	}
	
	//private function using arrays (private as not want to set outside)
	private function makeKeyLabels()
	{
		if (sizeof($this->m_aKeyLabels))
		{
			$t_sData = '';
			foreach ($this->m_aKeyLabels as $key => $val)
			{
				if ($key > 0)
					$t_sData .= '|';
				$t_sData .= urlencode($val);
			}

			return '&chdl='. $t_sData;
		}
	}

	private function makeWedgeColor()
	{
		if (sizeof($this->m_aWedgeColor))
		{
			$t_sData = '';
			foreach ($this->m_aWedgeColor as $key => $val)
			{
				if ($key > 0)
					$t_sData .= ',';
				$t_sData .= $val;
			}

			return '&chco='. $t_sData;
		}
	}

	public function buildGraph()
	{
		Graph::makeGraphURL();
		$this->m_sURL .= $this->makeWedgeLabels();
		$this->m_sURL .= $this->makeKeyLabels();
		$this->m_sURL .= $this->makeWedgeColor();
	
		return Graph::buildGraph();
	}

	//public function used outside the class to set the arrays to use later
	public function setWedgeLabels($p_aWedgeLabels)
	{
		$this->m_aWedgeLabels = $p_aWedgeLabels;
	}
	
	//public function used outside the class to set the arrays to use later
	public function setKeyLabels($p_aKeyLabels)
	{
		$this->m_aKeyLabels = $p_aKeyLabels;
	}

	public function setWedgeColor($p_aWedgeColor)
	{
		$this->m_aWedgeColor = $p_aWedgeColor;
	}

	//public function used to create percent for wedges
	public function setTotal($p_iTotal)
	{
		$this->m_iTotal = $p_iTotal;
	}



}

?>