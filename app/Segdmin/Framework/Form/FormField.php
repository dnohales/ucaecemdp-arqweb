<?php

namespace Segdmin\Framework\Form;

use Segdmin\Framework\Database\Type\TypeInterface;
use Segdmin\Framework\Exception\ValidatorException;

/**
 * Description of FormField
 *
 * @author damiannohales
 */
class FormField
{
	private $form;
	
	private $type;
	
	private $name;
	
	private $validators;
	
	private $errors;
	
	private $options;
	
	private $viewData;
	
	private $normData;
	
	public function __construct(Form $form, $name, Type\FormTypeInterface $type, array $options)
	{
		$this->form = $form;
		$this->name = $name;
		$this->type = $type;
		$this->options = $this->initOptions($options);
		$this->errors = array();
		$this->initValidators();
	}
	
	private function initOptions(array $options)
	{
		$defaults = array(
			'label' => ucfirst($this->getName()),
			'validators' => array()
		);
		
		return array_replace($options, $defaults);
	}
	
	private function initValidators()
	{
		$this->validators = array_merge(
			$this->normalizeValidatorArray($this->getType()->guessValidators()),
			$this->normalizeValidatorArray($this->guessValidatorsByOptions()),
			$this->normalizeValidatorArray($this->getOption('validators', array()))
		);
	}
	
	private function normalizeValidatorArray(array $validators)
	{
		$newValidators = array();
		foreach($validators as $v){
			$newValidators[str_replace('Segdmin\Framework\Validator\\', '', get_class($v))] = $v;
		}
		return $newValidators;
	}
	
	private function guessValidatorsByOptions()
	{
		return array();
	}
	
	public function getOption($name, $default = null)
	{
		return isset($this->options[$name])? $this->options[$name]:$default;
	}
	
	public function bind($data)
	{
		$this->errors = array();
		$this->viewData = $data;
		
		$dataType = $this->getForm()->getMappingInformation()->getPropertyType($this->getName());
		$this->normData = $this->sanitizeBindValue($data, $dataType);
		
		foreach($this->getValidators() as $validator){
			try {
				$validator->validate($this->normData);
			} catch(ValidatorException $e){
				$this->errors[] = $e->getMessage();
			}
		}
	}
	
	private function sanitizeBindValue($value, TypeInterface $type)
	{
		$value = trim($value);
		
		if($value === ''){
			return null;
		} else {
			if($type instanceof Database\Type\Date){
				return \DateTime::createFromFormat('d/m/Y', $value);
			} else if($type instanceof Database\Type\DateTime){
				throw new \Exception('No pueden convertir valores de formularios en DateTime');
			} else {
				return $type->toNative($value);
			}
		}
	}
	
	public function render()
	{
		return $this->getType()->render($this);
	}
	
	public function isValid()
	{
		return count($this->errors) > 0;
	}
	
	public function getForm()
	{
		return $this->form;
	}

	public function getType()
	{
		return $this->type;
	}

	public function getName()
	{
		return $this->name;
	}

	public function getValidators()
	{
		return $this->validators;
	}

	public function getErrors()
	{
		return $this->errors;
	}

	public function getOptions()
	{
		return $this->options;
	}

	public function getViewData()
	{
		return $this->viewData;
	}

	public function getNormData()
	{
		return $this->normData;
	}

	public function getLabel()
	{
		return $this->getOption('label');
	}
	
	public function isRequired()
	{
		
	}
}

?>