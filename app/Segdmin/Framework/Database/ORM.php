<?php
namespace Segdmin\Framework\Database;

use Segdmin\Framework\Exception\ORMException;

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
			$repositoryClass = "Segdmin\\Model\\{$nameOLoQueSea}Repository";
		}
		
		if(!isset($this->repositories[$repositoryClass])){
			$this->repositories[$repositoryClass] = new $repositoryClass($this->pdo);
		}
		
		return $this->repositories[$repositoryClass];
	}
	
}

?>
