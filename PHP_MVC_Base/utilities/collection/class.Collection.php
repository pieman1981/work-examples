<?php

///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
// Collection
// A class to allow a collection of objects to be iterated like an array
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

class Collection implements IteratorAggregate
{
	private $m_aMembers = array();
	private $m_sOnLoad;
	private $m_bIsLoaded = false;

	public function addItem($p_oObject, $p_sKey = null)
	{
		$this->checkCallback();
		if ($p_sKey)
		{
			if (isset($this->m_aMembers[$p_sKey]))
			{
				throw new Exception("Key $p_sKey already in use");
			}
			else
			{
				$this->m_aMembers[$p_sKey] = $p_oObject;
			}
		}
		else
		{
			$this->m_aMembers[] = $p_oObject;
		}
	}

	public function removeItem($p_sKey)
	{
		$this->checkCallback();
		if (isset($this->m_aMembers[$p_sKey]))
		{
			unset($this->m_aMembers[$p_sKey]);
		}
		else
		{
			throw new Exception("Invalid key $p_sKey");
		}
	}

	public function getItem($p_sKey)
	{
		$this->checkCallback();
		if (isset($this->m_aMembers[$p_sKey]))
		{
			return $this->m_aMembers[$p_sKey];
		}
		else
		{
			throw new Exception("Invalid key $p_sKey");
		}
	}

	public function keys()
	{
		$this->checkCallback();
		return array_keys($this->m_aMembers);
	}

	public function length()
	{
		$this->checkCallback();
		return sizeof($this->m_aMembers);
	}

	public function exists($p_sKey)
	{
		$this->checkCallback();
		return isset($this->m_aMembers[$p_sKey]);
	}

	public function setLoadCallback($p_sFunctionName, $p_oObjOrClass = null)
	{
		if ($p_oObjOrClass)
		{
			$t_sCallback = array($p_oObjOrClass, $p_sFunctionName);
		}
		else
		{
			$t_sCallback = $p_sFunctionName;
		}

		if (!is_callable($t_sCallback, false, $t_sCallableName))
		{
			throw new Exception("$t_sCallableName is not callable as a parameter to onload");
			return false;
		}
		$this->m_sOnLoad = $t_sCallback;
	}

	private function checkCallback()
	{
		if (isset($this->m_sOnLoad) && !$this->m_bIsLoaded)
		{
			$this->m_bIsLoaded = true;
			call_user_func($this->m_sOnLoad, $this);
		}
	}

	public function getIterator()
	{
		$this->checkCallback();
		return new CollectionIterator(clone $this);
	}
}

?>