<?php

class User
{
	private $m_iID = 0;
	private $m_sUsername = '';
	private $m_sPassword = '';
	private $m_iAdmin = 0;
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
			$this->m_sUsername = $t_aRows['username'];
			$this->m_sPassword = $t_aRows['password'];
			$this->m_iAdmin = $t_aRows['admin'];
			
		}
	}

	function save()
	{
		
		global $g_oDatabase;
		
		 $t_hSave['id'] = $this->m_iID;
		 $t_hSave['username'] = $this->m_sUsername;
		 $t_hSave['password'] = $this->m_sPassword;
		 $t_hSave['admin'] = $this->m_iAdmin;

		 
		
		
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
	
	function getUsername()
	{
		return $this->m_sUsername;
	}
	
	function getPassword()
	{
		return $this->m_sPassword;
	}
	
	function getAdmin()
	{
		return $this->m_iAdmin;
	}
	
	
	function setID($p_sName)
	{
		$this->m_iID = $p_sName;
	}
	function setUsername($p_sName)
	{
		$this->m_sUsername= $p_sName;
	}
	function setPassword($p_sName)
	{
		$this->m_sPassword = $p_sName;
	}
	
	function setAdmin($p_sName)
	{
		$this->m_iAdmin = $p_sName;
	}

}


?>