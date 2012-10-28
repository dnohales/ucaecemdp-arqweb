<?php
namespace Segdmin\Framework\Database;

/**
 * Description of ORMHelper
 *
 * @author eagleoneraptor
 */
class ORMHelper
{
	public function bindPropertiesList(\PDOStatement $stmt, $entity, array $properties)
	{
		foreach($properties as $name => $type){
			$stmt->bindValue(":property_$name", $type->toDatabase($this->getEntityPropertyValue($entity, $name)), $type->bindFormat());
		}
	}
	
	public function bindProperties(\PDOStatement $stmt, MappingInformation $mapping, $entity, $withId)
	{
		$properties = $mapping->getProperties();
		if(!$withId){
			unset($properties[$mapping->getIdField()]);
		}
		$this->bindPropertiesList($stmt, $entity, $properties);
	}
	
	public function generateSetsList(MappingInformation $mapping)
	{
		$parts = array();
		
		foreach($mapping->getProperties() as $name => $type){
			if($name != $mapping->getIdField()){
				$parts[] = "$name = :property_$name";
			}
		}
		
		return implode(', ', $parts);
	}
	
	public function setEntityPropertyValue($entity, $property, $value)
	{
		$reflection = new \ReflectionObject($entity);
		$property = $reflection->getProperty($property);
		$accessible = $property->isPublic();
		$property->setAccessible(true);
		$property->setValue($entity, $value);
		$property->setAccessible($accessible);
	}
	
	public function getEntityPropertyValue($entity, $property)
	{
		$reflection = new \ReflectionObject($entity);
		$property = $reflection->getProperty($property);
		$accessible = $property->isPublic();
		$property->setAccessible(true);
		$value = $property->getValue($entity);
		$property->setAccessible($accessible);
		return $value;
	}
	
	public function normalizeQuery($query, MappingInformation $mapping)
	{
		$replacements = array(
			'{table}' => $mapping->getTableName(),
			'{idfield}' => $mapping->getIdField()
		);
		
		return str_replace(array_keys($replacements), array_values($replacements), $query);
	}
}

?>
