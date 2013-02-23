<?php

class Page
{
	private $m_iID = 0;
	private $m_sHeader = '';
	private $m_sContent = '';
	private $m_sName = '';
	private $m_sMetaKeywords = '';
	private $m_sMetaDescription = '';
	private $json = '';
	
	

	function __construct($p_iID = 0)
	{
		if ($p_iID != 0)
			$this->load($p_iID);
		
	}

	function load($p_iID)
	{
		global $g_oDatabase;
		
		$t_aRows = $g_oDatabase->selectDatabase(array('*'),'pages',"id = '" . $p_iID ."'",true);
		if (sizeof($t_aRows))
		{
			$this->m_iID = $t_aRows['id'];
			$this->m_sHeader = $t_aRows['header'];
			$this->m_sContent = $t_aRows['content'];
			$this->m_sName = $t_aRows['name'];
			$this->m_sMetaKeywords = $t_aRows['meta_keywords'];
			$this->m_sMetaDescription = $t_aRows['meta_description'];
			
		}
	}

	function save()
	{
		
		global $g_oDatabase;
		
		 $t_hSave['id'] = $this->m_iID;
		 $t_hSave['header'] = $this->m_sHeader;
		 $t_hSave['content'] = $this->m_sContent;
		 $t_hSave['name'] = $this->m_sName;
		 $t_hSave['meta_keywords'] = $this->m_sMetaKeywords;
		 $t_hSave['meta_description'] = $this->m_sMetaDescription;

		 
		
		
		if ($this->m_iID != 0)
			$g_oDatabase->updateDatabase($t_hSave,'pages',"id = '" .$this->m_iID . "'");
		else
			$this->m_iID = $g_oDatabase->insertDatabase($t_hSave,'pages');

		 $t_hSave['id'] = $this->m_iID;

		 $this->makeJson($t_hSave);
			
		

	}

	function destroy()
	{
		global $g_oDatabase;
		
		$g_oDatabase->deleteDatabase('pages','id = ' . $this->m_iID);
	}

	function makeJson($p_aArray)
	{
		$this->json = json_encode($p_aArray);
	}

	function getJson() 
	{
		return $this->json;
	}

	function getID()
	{
		return $this->m_iID;
	}
	
	function getHeader()
	{
		return $this->m_sHeader;
	}
	
	function getContent()
	{
		return $this->m_sContent;
	}
	
	function getName()
	{
		return $this->m_sName;
	}

	function getMetaKeywords()
	{
		return $this->m_sMetaKeywords;
	}

	function getMetaDescription()
	{
		return $this->m_sMetaDescription;
	}
	
	
	function setID($p_sName)
	{
		$this->m_iID = $p_sName;
	}
	function setHeader($p_sName)
	{
		$this->m_sHeader= $p_sName;
	}
	function setContent($p_sName)
	{
		$this->m_sContent = $p_sName;
	}
	
	function setName($p_sName)
	{
		$this->m_sName = $p_sName;
	}

	function setMetaKeywords($p_sName)
	{
		$this->m_sMetaKeywords = $p_sName;
	}

	function setMetaDescription($p_sName)
	{
		$this->m_sMetaDescription = $p_sName;
	}

}


?>