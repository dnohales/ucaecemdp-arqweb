<?php

namespace Segdmin\Framework\Form;

use Segdmin\Framework\Database\ORM;
use Segdmin\Model\Entity;

/**
 * Description of Form
 *
 * @author damiannohales
 */
abstract class Form
{
	private $fields;
	
	private $entity;
	
	private $orm;
	
	final public function __construct(Entity $entity)
	{
		$this->entity = $entity;
		$this->build();
	}
	
	public function getEntity()
	{
		return $this->entity;
	}

	public function getOrm()
	{
		return $this->entity->getOrm();
	}
	
	public function getMappingInformation()
	{
		return $this->getOrm()->getRepository($this->getEntity())->getMappingInformation();
	}
	
	public function getFields()
	{
		return $this->fields;
	}
	
	public function getField($name)
	{
		return $this->fields[$name]; 
	}
	
	public function addField($name, $type, array $options = array())
	{
		if(!$type instanceof Type\FormTypeInterface){
			$typeClass = "Segdmin\\Framework\\Form\\Type\\".ucfirst($type)."Type";
			$type = new $typeClass();
		}
		$this->fields[$name] = new FormField($this, $name, $type, $options);
		return $this->fields[$name];
	}
	
	public function bind($data)
	{
		foreach($this->fields as $name => $field){
			if(isset($data[$name])){
				$field->bind($data[$n]);
				$setter = "set$name";
				$this->getEntity()->$setter($field->getNormData());
			}
		}
	}
	
	public function isValid()
	{
		foreach($this->fields as $field){
			if(!$field->isValid()){
				return false;
			}
		}
		
		return true;
	}
	
	abstract protected function build();
}
