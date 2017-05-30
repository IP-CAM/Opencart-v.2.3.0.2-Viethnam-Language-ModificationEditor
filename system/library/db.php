<?php
class DB {
	private $adaptor;

	public function __construct($adaptor, $hostname, $username, $password, $database, $port = NULL) {
		$class = 'DB\\' . $adaptor;

		if (class_exists($class)) {
			$this->adaptor = new $class($hostname, $username, $password, $database, $port);
		} else {
			throw new \Exception('Error: Could not load database adaptor ' . $adaptor . '!');
		}
	}

	public function query($sql, $params = array()) {
		return $this->adaptor->query($sql, $params);
	}
	
	/* result */
	
	public function result($columns = '*', $tableName, $type = 'array', $numRows = null) {
	    return $this->adaptor->result($columns, $tableName, $type, $numRows);
	}
	
	/* row */
	public function row($columns = '*', $tableName, $type = 'array') {
	    return $this->adaptor->row($columns, $tableName, $type);
	}
	
	/* update */
	public function update($tableName, $tableData, $numRows = null) {
	    return $this->adaptor->update($tableName, $tableData, $numRows);
	}
	
	/* insert */
	public function insert($tableName, $insertData) {
	    return $this->adaptor->insert($tableName, $insertData);
	}
	
	
	/* where */
	public function where($whereProp, $whereValue, $operator = '=', $cond = 'AND') {
	    return $this->adaptor->where($whereProp, $whereValue, $operator, $cond);
	}
	
	/* order_by */
	public function order_by($orderByField, $orderbyDirection = "DESC", $customFields = null) {
	    return $this->adaptor->order_by($orderByField, $orderbyDirection, $customFields);
	}
	
	/* group_by */
	public function group_by($groupByField) {
	    return $this->adaptor->group_by($groupByField);
	}
	
	/* having */
	public function having($havingProp, $havingValue = 'DBNULL', $operator = '=', $cond = 'AND') {
	    return $this->adaptor->having($havingProp, $havingValue, $operator, $cond);
	}
	
	/* join */
	public function join($joinTable, $joinCondition, $joinType = '') {
	    return $this->adaptor->join($joinTable, $joinCondition, $joinType);
	}
	
	/* get query */
	public function getLastQuery()
	{
	    return $this->adaptor->getLastQuery();
	}
	

	public function escape($value) {
		return $this->adaptor->escape($value);
	}

	public function countAffected() {
		return $this->adaptor->countAffected();
	}

	public function getLastId() {
		return $this->adaptor->getLastId();
	}
	
	public function connected() {
		return $this->adaptor->connected();
	}
}