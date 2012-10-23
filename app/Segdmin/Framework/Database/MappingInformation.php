<?php
namespace Segdmin\Framework\Database;

/**
 * Description of MappingInformation
 *
 * @author eagleoneraptor
 */
class MappingInformation
{
	private $tableName;
	
	private $properties;
	
	private $idField;
	
	public function __construct($tableName, array $properties)
	{
		$this->setTableName($tableName);
		$this->setProperties($properties);
	}
	
	public function getTableName()
	{
		return $this->tableName;
	}

	public function setTableName($tableName)
	{
		$this->tableName = $tableName;
	}

	public function getProperties()
	{
		return $this->properties;
	}
	
	public function getSingleProperty($name)
	{
		return array($name => $this->properties[$name]);
	}
	
	public function setProperties(array $properties)
	{
		$this->properties = array();
		$this->idField = null;
		$this->addProperties($properties);
	}
	
	public function addProperties(array $properties)
	{
		foreach($properties as $name => $type){
			$this->addProperty($name, $this->guessType($type));
		}
	}
	
	private function guessType($type)
	{
		if($type instanceof Type\TypeInterface){
			return $type;
		} else {
			$typeClass = 'Segdmin\\Framework\\Database\\Type\\'.ucfirst($type);
			return new $typeClass();
		}
	}

	public function addProperty($name, Type\TypeInterface $type)
	{
		$this->properties[$name] = $type;
		if($type instanceof Type\Id){
			$this->idField = $name;
		}
	}
	
	public function getIdField()
	{
		return $this->idField;
	}

}

?>
