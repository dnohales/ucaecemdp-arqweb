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
	
	public function __construct(\PDO $pdo)
	{
		$this->pdo = $pdo;
		$this->repositories = array();
	}
	
	public function insert($entity)
	{
		return $this->repository($entity)->insert($entity);
	}
	
	public function update($entity)
	{
		return $this->repository($entity)->update($entity);
	}
	
	public function remove($entity)
	{
		return $this->repository($entity)->remove($entity);
	}
	
	public function find($repoName, $id)
	{
		return $this->repository($repoName)->find($id);
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
	
	public function repository($nameOLoQueSea)
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
	
}

