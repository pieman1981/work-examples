<?php

///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
// CollectionIterator
// Iterator for navigating through a collection object
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

require_once('collection/class.Collection.php');

class CollectionIterator implements Iterator
{
	private $m_oCollection;
	private $m_iCurrIndex = 0;
	private $m_aKeys;

	function __construct(Collection $p_oCollection)
	{
		$this->m_oCollection = $p_oCollection;
		$this->m_aKeys = $this->m_oCollection->keys();
	}

	function rewind()
	{
		$this->m_iCurrIndex = 0;
	}

	public function hasMore()
	{
		return $this->m_iCurrIndex < $this->m_oCollection->length();
	}

	function valid()
	{
		if (isset($this->m_aKeys[$this->m_iCurrIndex]))
		{
			return $this->m_oCollection->exists($this->m_aKeys[$this->m_iCurrIndex]);
		}
		else
		{
			return false;
		}
	}

	function key()
	{
		return $this->m_aKeys[$this->m_iCurrIndex];
	}

	function current()
	{
		return $this->m_oCollection->getItem($this->m_aKeys[$this->m_iCurrIndex]);
	}

	function next()
	{
		$this->m_iCurrIndex++;
	}
}

?>