<?php

///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
// DatabaseMySQL
// Connects to a MySQL database using mysqli
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

require_once('class.Database.php');

class DatabaseMySQL extends Database
{
	private function __construct($p_sUsername = '', $p_sPassword = '', $p_sDatabase = '', $p_sHost = 'localhost')
	{
		$this->m_oConnection = new mysqli($p_sHost, $p_sUsername, $p_sPassword, $p_sDatabase);

		if ($this->m_oConnection->connect_error)
		{
			throw new Exception('Connect Error (' . $this->m_oConnection->connect_errno . ') ' . $this->m_oConnection->connect_error);
			unset($this->m_oConnection);
		}
	}

	static function instance($p_sUsername = '', $p_sPassword = '', $p_sDatabase = '', $p_sHost = 'localhost')
	{
		static $t_oObject;
		if (!isset($t_oObject))
		{
			$t_oObject = new DatabaseMySQL($p_sUsername, $p_sPassword, $p_sDatabase, $p_sHost);
		}
		return $t_oObject;
	}

	function __destruct()
	{
		if ($this->m_oConnection)
			$this->m_oConnection->close();
	}

	function select($p_aSelectedFields, $p_aSelectedTables, $p_sWhereClause = '1', $p_bFirstOnly = false)
	{
		$t_sQuery = 'SELECT ';
		foreach ($p_aSelectedFields as $key => $val)
		{
			if ($key > 0){$t_sQuery .= ', ';}
			$t_sQuery .= $val;
		}
		$t_sQuery .= ' FROM ';
		foreach ($p_aSelectedTables as $key => $val)
		{
			if ($key > 0){$t_sQuery .= ', ';}
			$t_sQuery .= $val;
		}
		$t_sQuery .= ' WHERE ' . $p_sWhereClause;

		$t_oResult = $this->m_oConnection->query($t_sQuery);

		if ($t_oResult)
		{
			if ($p_bFirstOnly)
			{
				$t_hResultSet = $t_oResult->fetch_array(MYSQLI_ASSOC);
			}
			else
			{
				while ($t_hRow = $t_oResult->fetch_array(MYSQLI_ASSOC))
				{
					$t_hResultSet[] = $t_hRow;
				}
			}

			$t_oResult->close();

			if (isset($t_hResultSet))
				return $t_hResultSet;	
		}
		else
		{
			throw new Exception('SQL Select Error (' . $this->m_oConnection->errno . ') ' . $this->m_oConnection->error);
		}
	}

	function update($p_sTable, $p_hValues, $p_sWhereClause = '1')
	{
		global $g_iUserID;

		$t_sQuery = 'UPDATE ' . $p_sTable . ' SET ';
		$i = 0;
		foreach ($p_hValues as $key => $val)
		{
			if ($i > 0){$t_sQuery .= ', ';}
			$t_sQuery .= $key . ' = ';
			if ($val == 'NOW()' || $val == 'CURDATE()' || $val == 'NULL')
				$t_sQuery .= $val;
			else
				$t_sQuery .= "'" . $this->escapeString($val) . "'";
			$i++;
		}
		$t_sQuery .= ' WHERE ' . $p_sWhereClause;

		$t_bResult = $this->m_oConnection->query($t_sQuery);
		if ($t_bResult === true)
		{
			return $this->m_oConnection->affected_rows;
		}
		else
		{
			throw new Exception('SQL Update Error (' . $this->m_oConnection->errno . ') ' . $this->m_oConnection->error);
		}
	}

	function insert($p_sTable, $p_hValues)
	{
		global $g_iUserID;

		$t_sQuery = 'INSERT INTO ' . $p_sTable . ' (';
		$i = 0;
		foreach ($p_hValues as $key => $val)
		{
			if ($i > 0){$t_sQuery .= ', ';}
			$t_sQuery .= $key;
			$i++;
		}
		$t_sQuery .= ') VALUES (';
		$i = 0;
		foreach ($p_hValues as $key => $val)
		{
			if ($i > 0){$t_sQuery .= ', ';}
			if ($val == 'NOW()' || $val == 'CURDATE()' || $val == 'NULL')
				$t_sQuery .= $val;
			else
				$t_sQuery .= "'" . $this->escapeString($val) . "'";
			$i++;
		}
		$t_sQuery .= ')';

		$t_bResult = $this->m_oConnection->query($t_sQuery);
		if ($t_bResult === true)
		{
			$t_iNewID = $this->m_oConnection->insert_id;

			return $t_iNewID;
		}
		else
		{
			throw new Exception('SQL Insert Error (' . $this->m_oConnection->errno . ') ' . $this->m_oConnection->error);
		}
	}

	function delete($p_sTable, $p_sWhereClause = '1')
	{
		global $g_iUserID;

		$t_sQuery = 'DELETE FROM ' . $p_sTable . ' WHERE ' . $p_sWhereClause;

		$t_bResult = $this->m_oConnection->query($t_sQuery);
		if ($t_bResult === true)
		{
			return $this->m_oConnection->affected_rows;
		}
		else
		{
			throw new Exception('SQL Delete Error (' . $this->m_oConnection->errno . ') ' . $this->m_oConnection->error);
		}
	}

	function startTransaction()
	{
		$this->m_oConnection->autocommit(false);
	}

	function commitTransaction()
	{
		if ($this->m_oConnection->commit())
		{
			$this->m_oConnection->autocommit(true);
			return true;
		}
		else
		{
			$this->m_oConnection->autocommit(true);
			throw new Exception('SQL Commit Error (' . $this->m_oConnection->errno . ') ' . $this->m_oConnection->error);
		}
	}

	function abortTransaction()
	{
		if ($this->m_oConnection->rollback())
		{
			$this->m_oConnection->autocommit(true);
			return true;
		}
		else
		{
			$this->m_oConnection->autocommit(true);
			throw new Exception('SQL Rollback Error (' . $this->m_oConnection->errno . ') ' . $this->m_oConnection->error);
		}
	}

	function escapeString($p_sString)
	{
		$p_sString = str_replace('Â£', '£', $p_sString);
		return $this->m_oConnection->real_escape_string($p_sString);
	}
}

?>