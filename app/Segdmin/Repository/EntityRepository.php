<?php
namespace Segdmin\Repository;

use Segdmin\Framework\Util\ArrayCollection;
use Segdmin\Framework\Exception\ORMException;
use Segdmin\Framework\Database\ORM;
use Segdmin\Framework\Database\MappingInformation;
use Segdmin\Framework\Database\Type\Id;

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
	
	private function setEntityPropertyValue($entity, $property, $value)
	{
		$reflection = new \ReflectionObject($entity);
		$property = $reflection->getProperty($property);
		$accessible = $property->isPublic();
		$property->setAccessible(true);
		$property->setValue($entity, $value);
		$property->setAccessible($accessible);
	}
	
	private function getEntityPropertyValue($entity, $property)
	{
		$reflection = new \ReflectionObject($entity);
		$property = $reflection->getProperty($property);
		$accessible = $property->isPublic();
		$property->setAccessible(true);
		$value = $property->getValue($entity);
		$property->setAccessible($accessible);
		return $value;
	}
	
	public function isNew($entity)
	{
		return !$this->getEntityPropertyValue($entity, $this->getMappingInformation()->getIdField());
	}
	
	private function normalizeQuery($query)
	{
		$mapping = $this->getMappingInformation();
		$replacements = array(
			'{table}' => $mapping->getTableName(),
			'{idfield}' => $mapping->getIdField()
		);
		
		return str_replace(array_keys($replacements), array_values($replacements), $query);
	}
	
	public function load($row)
	{
		if(!$row){
			return null;
		}
		
		$mapping = $this->getMappingInformation();
		$entityClass = $this->getEntityClass();
		$instance = new $entityClass($this->orm);
		
		foreach($mapping->getProperties() as $name => $type){
			$this->setEntityPropertyValue($instance, $name, $type->toNative($row[$name]));
		}
		
		return $instance;
	}
	
	public function loadAll(array $rows)
	{
		$entities = new ArrayCollection();
		foreach($rows as $row){
			$entities->add($this->load($row));
		}
		return $entities;
	}
	
	public function loadByQuery($query, array $params = array())
	{
		$stmt = $this->pdo->prepare($this->normalizeQuery($query));
		$this->orm->execute($stmt, $params);
		
		return $this->load($stmt->fetch(\PDO::FETCH_ASSOC));
	}
	
	public function loadAllByQuery($query, array $params = array())
	{
		$stmt = $this->pdo->prepare($this->normalizeQuery($query));
		$this->orm->execute($stmt, $params);
		
		return $this->loadAll($stmt->fetchAll(\PDO::FETCH_ASSOC));
	}
	
	public function find($id)
	{
		return $this->loadByQuery('SELECT * FROM {table} WHERE {idfield} = ?', array($id));
	}
	
	public function findAll(array $criteria = array(), $orderBy = null, $limit = null, $offset = null)
	{
		$query = 'SELECT * FROM {table}';
		$params = array();
		
		if(count($criteria) > 0){
			$conditions = array();
			foreach($criteria as $key => $value){
				$conditions[] = "$key = ?";
				$params[] = $value;
			}
			$query .= ' WHERE '.implode(' AND ', $conditions);
		}
		
		if($orderBy !== null){
			$query .= " ORDER BY $orderBy";
		}
		
		if($limit !== null){
			$query .= " LIMIT $limit";
			if($offset !== null){
				$query .= " OFFSET $offset";
			}
		}
		
		return $this->loadAllByQuery($query, $params);
	}
	
	public function insert($entity)
	{
		$mapping = $this->getMappingInformation();
		$query = 'INSERT INTO {table} SET '.$this->generateSetsList();
		$stmt = $this->pdo->prepare($this->normalizeQuery($query));
		$this->bindProperties($stmt, $entity, false);
		
		$this->orm->execute($stmt);
		$idType = new Id();
		$this->setEntityPropertyValue($entity, $mapping->getIdField(), $idType->toNative($this->pdo->lastInsertId()));
	}
	
	public function update($entity)
	{
		$mapping = $this->getMappingInformation();
		$query = 'UPDATE {table} SET '.$this->generateSetsList().' WHERE {idfield} = :property_'.$mapping->getIdField();
		$stmt = $this->pdo->prepare($this->normalizeQuery($query));
		$this->bindProperties($stmt, $entity, true);
		
		$this->orm->execute($stmt);
	}
	
	public function remove($entity)
	{
		$mapping = $this->getMappingInformation();
		$query = 'DELETE FROM {table} WHERE {idfield} = :id';
		$stmt = $this->pdo->prepare($this->normalizeQuery($query));
		$this->bindPropertiesList($stmt, $entity, ':id', $mapping->getSingleProperty($mapping->getIdField()));
		
		$this->orm->execute($stmt);
	}
	
	private function bindPropertiesList(\PDOStatement $stmt, $entity, array $properties)
	{
		foreach($properties as $name => $type){
			$stmt->bindValue(":property_$name", $type->toDatabase($this->getEntityPropertyValue($entity, $name)), $type->bindFormat());
		}
	}
	
	private function bindProperties(\PDOStatement $stmt, $entity, $withId)
	{
		$properties = $this->getMappingInformation()->getProperties();
		if(!$withId){
			unset($properties[$this->getMappingInformation()->getIdField()]);
		}
		$this->bindPropertiesList($stmt, $entity, $properties);
	}
	
	private function generateSetsList()
	{
		$parts = array();
		
		foreach($this->getMappingInformation()->getProperties() as $name => $type){
			if($name != $this->getMappingInformation()->getIdField()){
				$parts[] = "$name = :property_$name";
			}
		}
		
		return implode(',', $parts);
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

