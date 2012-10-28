<?php
namespace Segdmin\Framework\Database;

use Segdmin\Framework\Exception\ORMException;
use Segdmin\Framework\Logger;

/**
 * Description of ORM
 *
 * @author eagleoneraptor
 */
class ORM
{
	private $pdo;
	
	private $repositories;
	
	private $helper;
	
	private $identityMap;
	
	public function __construct(\PDO $pdo)
	{
		$this->pdo = $pdo;
		$this->repositories = array();
		$this->helper = new ORMHelper();
		$this->identityMap = array();
	}
	
	public function loadEntity(MappingInformation $mapping, $entityClass, $row)
	{
		if(!$row){
			return null;
		}
		
		if(!isset($this->identityMap[$entityClass][(string)$row[$mapping->getIdField()]])){
			$instance = new $entityClass($this);
			foreach($mapping->getProperties() as $name => $type){
				$this->helper->setEntityPropertyValue($instance, $name, $type->toNative($row[$name]));
			}
			$this->identityMap[$entityClass][(string)$row[$mapping->getIdField()]] = $instance;
		}
		
		return $this->identityMap[$entityClass][(string)$row[$mapping->getIdField()]];
	}
	
	public function save($entity)
	{
		if($this->isNew($entity)){
			return $this->insert($entity);
		} else {
			return $this->update($entity);
		}
	}
	
	private function insert($entity)
	{
		$mapping = $this->getRepository($entity)->getMappingInformation();
		$query = 'INSERT INTO {table} SET '.$this->helper->generateSetsList($mapping);
		$stmt = $this->pdo->prepare($this->helper->normalizeQuery($query, $mapping));
		$this->helper->bindProperties($stmt, $mapping, $entity, false);
		
		$this->execute($stmt);
		$idType = new Type\Id();
		$this->helper->setEntityPropertyValue($entity, $mapping->getIdField(), $idType->toNative($this->pdo->lastInsertId()));
		
		$entityId = $this->helper->getEntityPropertyValue($entity, $mapping->getIdField());
		$this->identityMap[get_class($entity)][(string)$entityId] = $entity;
	}
	
	private function update($entity)
	{
		$mapping = $this->getRepository($entity)->getMappingInformation();
		$query = 'UPDATE {table} SET '.$this->helper->generateSetsList($mapping).' WHERE {idfield} = :property_'.$mapping->getIdField();
		$stmt = $this->pdo->prepare($this->helper->normalizeQuery($query, $mapping));
		$this->helper->bindProperties($stmt, $mapping, $entity, true);
		
		$this->execute($stmt);
	}
	
	public function remove($entity)
	{
		$mapping = $this->getRepository($entity)->getMappingInformation();
		$query = 'DELETE FROM {table} WHERE {idfield} = :property_'.$mapping->getIdField();
		$stmt = $this->pdo->prepare($this->helper->normalizeQuery($query, $mapping));
		$this->helper->bindPropertiesList($stmt, $entity, $mapping->getSingleProperty($mapping->getIdField()));
		
		$this->execute($stmt);
	}
	
	public function find($repoName, $id)
	{
		return $this->getRepository($repoName)->find($id);
	}
	
	public function isNew($entity)
	{
		$mapping = $this->getRepository($entity)->getMappingInformation();
		$entityId = $this->helper->getEntityPropertyValue($entity, $mapping->getIdField());
		return !isset($this->identityMap[get_class($entity)][(string)$entityId]);
	}
	
	public function execute(\PDOStatement $stmt, array $params = array())
	{
		if($params){
			$r = $stmt->execute($params);
		} else {
			$r = $stmt->execute();
		}
		
		Logger::debug('Ejecutada consulta SQL: '.$stmt->queryString, 'orm.query');
		
		if(!$r){
			throw new ORMException('Falló la consulta a la base de datos ('.$stmt->errorCode().'): '.$stmt->queryString);
		}
	}
	
	public function getRepository($nameOLoQueSea)
	{
		if(is_object($nameOLoQueSea)){
			if($nameOLoQueSea instanceof EntityRepository){
				return $nameOLoQueSea;
			} else {
				$nameOLoQueSea = get_class($nameOLoQueSea);
			}
		}
		
		if(strpos($nameOLoQueSea, '\\') !== false){
			$repositoryClass = $nameOLoQueSea.'Repository';
			$repositoryClass = str_replace('\\Model\\', '\\Repository\\', $repositoryClass);
		} else {
			$repositoryClass = "Segdmin\\Repository\\{$nameOLoQueSea}Repository";
		}
		
		if(!isset($this->repositories[$repositoryClass])){
			$this->repositories[$repositoryClass] = new $repositoryClass($this);
		}
		
		return $this->repositories[$repositoryClass];
	}
	
	public function getPdo()
	{
		return $this->pdo;
	}
	
	public function getHelper()
	{
		return $this->helper;
	}
	
}

