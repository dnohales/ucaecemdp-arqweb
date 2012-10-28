<?php
namespace Segdmin\Repository;

use Segdmin\Framework\Util\ArrayCollection;
use Segdmin\Framework\Exception\ORMException;
use Segdmin\Framework\Database\ORM;
use Segdmin\Framework\Database\MappingInformation;
use Segdmin\Framework\Database\Type\Id;
use Segdmin\Framework\Database\QueryBuilder;

/**
 * Description of BaseRepository
 *
 * @author eagleoneraptor
 */
abstract class EntityRepository
{
	/**
	 * @var \PDO
	 */
	protected $pdo;
	
	protected $orm;
	
	private $mappingInformation;
	
	final public function __construct(ORM $orm)
	{
		$this->orm = $orm;
		$this->pdo = $orm->getPdo();
	}
	
	public function getEntityClass()
	{
		$pos = strrpos(get_class($this), 'Repository');
		$className = substr_replace(get_class($this), '', $pos);
		return str_replace('\\Repository\\', '\\Model\\', $className);
	}
	
	public function load($row)
	{
		return $this->orm->loadEntity($this->getMappingInformation(), $this->getEntityClass(), $row);
	}
	
	public function loadAll(array $rows)
	{
		$mapping = $this->getMappingInformation();
		$entityClass = $this->getEntityClass();
		
		$entities = new ArrayCollection();
		foreach($rows as $row){
			$entities->add($this->orm->loadEntity($mapping, $entityClass, $row));
		}
		return $entities;
	}
	
	public function loadByQuery($query, array $params = array())
	{
		$query = $this->orm->getHelper()->normalizeQuery($query, $this->getMappingInformation());
		$stmt = $this->pdo->prepare($query);
		$this->orm->execute($stmt, $params);
		
		return $this->load($stmt->fetch(\PDO::FETCH_ASSOC));
	}
	
	public function loadAllByQuery($query, array $params = array())
	{
		$query = $this->orm->getHelper()->normalizeQuery($query, $this->getMappingInformation());
		$stmt = $this->pdo->prepare($query);
		$this->orm->execute($stmt, $params);
		
		return $this->loadAll($stmt->fetchAll(\PDO::FETCH_ASSOC));
	}
	
	public function find($id)
	{
		return $this->loadByQuery('SELECT * FROM {table} WHERE {idfield} = ?', array($id));
	}
	
	private function createQuery($criteria = null, $orderBy = null, $limit = null, $offset = null)
	{
		$builder = new QueryBuilder();
		$builder->setOrderBy($orderBy)->setLimit($limit)->setOffset($offset);
		
		$params = array();
		
		if($criteria !== null){
			if(is_array($criteria)){
				$conditions = array();
				foreach($criteria as $key => $value){
					$conditions[] = "$key = ?";
					$params[] = $value;
				}
				$where = implode(' AND ', $conditions);
			} else {
				$where = $criteria;
			}
			$builder->setWhere($where);
		}
		
		return array($builder->getQuery(), $params);
	}
	
	public function findAll($orderBy = null, $limit = null, $offset = null)
	{
		$queryParams = $this->createQuery(null, $orderBy, $limit, $offset); 
		return $this->loadAllByQuery($queryParams[0], $queryParams[1]);
	}
	
	public function findAllBy($criteria = null, $orderBy = null, $limit = null, $offset = null)
	{
		$queryParams = $this->createQuery($criteria, $orderBy, $limit, $offset); 
		return $this->loadAllByQuery($queryParams[0], $queryParams[1]);
	}
	
	public function findOneBy($criteria = null, $orderBy = null, $offset = null)
	{
		$queryParams = $this->createQuery($criteria, $orderBy, 1, $offset); 
		return $this->loadByQuery($queryParams[0], $queryParams[1]);
	}
	
	/**
	 *
	 * @return MappingInformation 
	 */
	public function getMappingInformation()
	{
		if($this->mappingInformation === null){
			$this->mappingInformation = $this->createMappingInformation();
		}
		
		return $this->mappingInformation;
	}
	
	abstract protected function createMappingInformation();
	
	
}

