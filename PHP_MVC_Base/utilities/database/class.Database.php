<?php

///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
// Database
// Base class for a connection to some kind of database
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

abstract class Database
{
	protected $m_oConnection;

	static function instance($p_sUsername = '', $p_sPassword = '', $p_sDatabase = '', $p_sHost = 'localhost')
	{
	}

	function select($p_aSelectedFields, $p_aSelectedTables, $p_sWhereClause = '1', $p_bFirstOnly = false)
	{
	}

	function update($p_sTable, $p_hValues, $p_sWhereClause = '1')
	{
	}

	function insert($p_sTable, $p_hValues)
	{
	}

	function delete($p_sTable, $p_sWhereClause = '1')
	{
	}
}

?>