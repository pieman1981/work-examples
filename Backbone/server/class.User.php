<?php

class User
{
	private $m_iID = 0;
	private $m_sFirstname = '';
	private $m_sLastname = '';
	private $m_iAge = 0;
	private $json = '';
	
	

	function __construct($p_iID = 0)
	{
		if ($p_iID != 0)
			$this->load($p_iID);
		
	}

	function load($p_iID)
	{
		global $g_oDatabase;
		
		$t_aRows = $g_oDatabase->selectDatabase(array('*'),'users',"id = '" . $p_iID ."'",true);
		if (sizeof($t_aRows))
		{
			$this->m_iID = $t_aRows['id'];
			$this->m_sFirstname = $t_aRows['firstname'];
			$this->m_sLastname = $t_aRows['lastname'];
			$this->m_iAge = $t_aRows['age'];
			
		}
	}

	function save()
	{
		
		global $g_oDatabase;
		
		 $t_hSave['id'] = $this->m_iID;
		 $t_hSave['firstname'] = $this->m_sFirstname;
		 $t_hSave['lastname'] = $this->m_sLastname;
		 $t_hSave['age'] = $this->m_iAge;

		 
		
		
		if ($this->m_iID != 0)
			$g_oDatabase->updateDatabase($t_hSave,'users',"id = '" .$this->m_iID . "'");
		else
			$this->m_iID = $g_oDatabase->insertDatabase($t_hSave,'users');

		 $t_hSave['id'] = $this->m_iID;

		 $this->makeJson($t_hSave);
			
		

	}

	function destroy()
	{
		
		global $g_oDatabase;
		
		$g_oDatabase->deleteDatabase('users','id = ' . $this->m_iID);
			
		

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
	
	function getFirstname()
	{
		return $this->m_sFirstname;
	}
	
	function getLastname()
	{
		return $this->m_sLastname;
	}
	
	function getAge()
	{
		return $this->m_iAge;
	}
	
	
	function setID($p_sName)
	{
		$this->m_iID = $p_sName;
	}
	function setFirstname($p_sName)
	{
		$this->m_sFirstname = $p_sName;
	}
	function setLastname($p_sName)
	{
		$this->m_sLastname = $p_sName;
	}
	
	function setAge($p_sName)
	{
		$this->m_iAge = $p_sName;
	}

}


?>