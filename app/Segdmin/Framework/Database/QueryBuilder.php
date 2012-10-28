<?php
namespace Segdmin\Framework\Database;

/**
 * Description of QueryBuilder
 *
 * @author eagleoneraptor
 */
class QueryBuilder
{
	private $select;
	private $table;
	private $join;
	private $where;
	private $orderBy;
	private $limit;
	private $offset;
	
	public function __construct()
	{
		$this->setSelect('*')->setTable('{table}');
	}
	

	public function getSelect()
	{
		return $this->select;
	}

	public function setSelect($select)
	{
		$this->select = $select;
		return $this;
	}
	
	public function getTable()
	{
		return $this->table;
	}

	public function setTable($table)
	{
		$this->table = $table;
		return $this;
	}
	
	public function getJoin()
	{
		return $this->join;
	}

	public function setJoin($join)
	{
		$this->join = $join;
	}
	
	public function getWhere()
	{
		return $this->where;
	}

	public function setWhere($where)
	{
		$this->where = $where;
		return $this;
	}
	
	public function andWhere($condition)
	{
		return $this->addCondition($condition, 'AND');
	}
	
	public function orWhere($condition)
	{
		return $this->addCondition($condition, 'OR');
	}
	
	public function addCondition($condition, $separator)
	{
		if($this->where){
			$this->where .= " $separator ($condition)";
		} else {
			$this->where = "($condition)";
		}
		return $this;
	}

	public function getOrderBy()
	{
		return $this->orderBy;
	}

	public function setOrderBy($orderBy)
	{
		$this->orderBy = $orderBy;
		return $this;
	}

	public function getLimit()
	{
		return $this->limit;
	}

	public function setLimit($limit)
	{
		$this->limit = $limit;
		return $this;
	}

	public function getOffset()
	{
		return $this->offset;
	}

	public function setOffset($offset)
	{
		$this->offset = $offset;
		return $this;
	}
	
	public function getQuery()
	{
		$query = 'SELECT '.$this->getSelect().' FROM '.$this->getTable();
		
		if($this->getJoin() !== null){
			$query .= ' '.$this->getJoin();
		}
		
		if($this->getWhere() !== null){
			$query .= ' WHERE '.$this->getWhere();
		}
		
		if($this->getOrderBy() !== null){
			$query .= ' ORDER BY '.$this->getOrderBy();
		}
		
		if($this->getLimit() !== null){
			$query .= ' LIMIT '.$this->getLimit();
			if($this->getOffset() !== null){
				$query .= ' OFFSET '.$this->getOffset();
			}
		}
		
		return $query;
	}
}

?>
