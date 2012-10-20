<?php
namespace Segdmin\Framework\Routing;

/**
 * Description of Route
 *
 * @author eagleoneraptor
 */
class Route
{
	private $name;
	
	private $path;
	
	private $controllerClass;
	
	private $controllerMethod;
	
	private $controller;
	
	private $roles;
	
	public function __construct($name, $path, $controller, array $roles)
	{
		$this->setName($name);
		$this->setPath($path);
		$this->setController($controller);
		$this->setRoles($roles);
	}
	
	public function getName()
	{
		return $this->name;
	}

	private function setName($name)
	{
		$this->name = $name;
	}

	public function getPath()
	{
		return $this->path;
	}

	private function setPath($path)
	{
		$this->path = $path;
	}

	public function getController()
	{
		return $this->controller;
	}
	
	public function getControllerClass()
	{
		return $this->controllerClass;
	}
	
	public function getControllerMethod()
	{
		return $this->controllerMethod;
	}

	private function setController($controller)
	{
		$controllerParts = explode(':', $controller);
		if(count($controllerParts) != 2){
			throw new \InvalidArgumentException("El controller \"$controller\" no tiene el formato <Clase>:<Método>");
		}
		
		$this->controller = $controller;
		$this->controllerClass = 'Segdmin\\Controller\\'.$controllerParts[0].'Controller';
		$this->controllerMethod = $controllerParts[1];
	}

	public function getRoles()
	{
		return $this->roles;
	}

	private function setRoles(array $roles)
	{
		$this->roles = $roles;
	}



}
