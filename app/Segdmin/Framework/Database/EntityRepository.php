<?php
namespace Segdmin\Framework\Database;

use Segdmin\Framework\Util\ArrayCollection;
use Segdmin\Framework\Exception\ORMException;

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
	
	private $mappingInformation;
	
	final public function __construct(\PDO $pdo)
	{
		$this->pdo = $pdo;
	}
	
	public function getEntityClass()
	{
		$pos = strrpos(get_class($this), 'Repository');
		return substr_replace(get_class($this), '', $pos);
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
	
	public function load($row)
	{
		if(!$row){
			return null;
		}
		
		$mapping = $this->getMappingInformation();
		$reflection = new \ReflectionClass($this->getEntityClass());
		$instance = $reflection->newInstance();
		
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
	
	public function find($id)
	{
		$mapping = $this->getMappingInformation();
		
		$stmt = $this->pdo->prepare('SELECT * FROM '.$mapping->getTableName().' WHERE '.$mapping->getIdField().'= ?');
		$stmt->execute(array($id));
		
		return $this->load($stmt->fetch(\PDO::FETCH_ASSOC));
	}
	
	public function findAll()
	{
		$mapping = $this->getMappingInformation();
		$stmt = $this->pdo->query('SELECT * FROM '.$mapping->getTableName());
		return $this->loadAll($stmt->fetchAll(\PDO::FETCH_ASSOC));
	}
	
	public function loadByQuery($query, array $params)
	{
		$stmt = $this->pdo->prepare($query);
		$stmt->execute($params);
		
		return $this->load($stmt->fetch(\PDO::FETCH_ASSOC));
	}
	
	public function loadAllByQuery($query, array $params)
	{
		$stmt = $this->pdo->prepare($query);
		$stmt->execute($params);
		
		return $this->loadAll($stmt->fetchAll(\PDO::FETCH_ASSOC));
	}
	
	public function insert($entity)
	{
		$mapping = $this->getMappingInformation();
		$stmt = $this->pdo->prepare('INSERT INTO '.$mapping->getTableName().' SET '.$this->generateSetsList());
		$this->bindProperties($stmt, $entity, false);
		
		$this->executeStatement($stmt);
		$idType = new Type\Id();
		$this->setEntityPropertyValue($entity, $mapping->getIdField(), $idType->toNative($this->pdo->lastInsertId()));
	}
	
	public function update($entity)
	{
		$mapping = $this->getMappingInformation();
		$stmt = $this->pdo->prepare('UPDATE '.$mapping->getTableName().' SET '.$this->generateSetsList().' WHERE '.$mapping->getIdField().' = :property_'.$mapping->getIdField());
		$this->bindProperties($stmt, $entity, true);
		
		$this->executeStatement($stmt);
	}
	
	public function remove($entity)
	{
		$mapping = $this->getMappingInformation();
		$stmt = $this->pdo->prepare('DELETE FROM '.$mapping->getTableName().' WHERE '.$mapping->getIdField().' = :id');
		$this->bindPropertiesList($stmt, $entity, ':id', $mapping->getSingleProperty($mapping->getIdField()));
		
		$this->executeStatement($stmt);
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
	
	private function executeStatement(\PDOStatement $stmt, array $params = null)
	{
		if($params){
			$r = $stmt->execute($params);
		} else {
			$r = $stmt->execute();
		}
		
		if(!$r){
			throw new ORMException('Falló la consulta a la base de datos: '.$stmt->errorCode());
		}
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

?>
