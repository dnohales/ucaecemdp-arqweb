<?php
namespace Segdmin\Framework\Routing;

use Segdmin\Framework\Security\UserInterface;

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
	
	private $allowedMethods;
	
	public function __construct()
	{
	}
	
	public function getName()
	{
		return $this->name;
	}

	public function setName($name)
	{
		$this->name = $name;
	}

	public function getPath()
	{
		return $this->path;
	}

	public function setPath($path)
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

	public function setController($controller)
	{
		$controllerParts = explode(':', $controller);
		if(count($controllerParts) != 2){
			throw new \InvalidArgumentException("El controller \"$controller\" no tiene el formato <Clase>:<Método>");
		}
		
		$this->controller = $controller;
		$this->controllerClass = 'Segdmin\\Controller\\'.$controllerParts[0].'Controller';
		$this->controllerMethod = $controllerParts[1].'Action';
	}

	public function getRoles()
	{
		return $this->roles;
	}

	public function setRoles(array $roles)
	{
		$this->roles = $roles;
	}

	public function isUserGranted(UserInterface $user)
	{
		return count(array_intersect($this->getRoles(), $user->getRoles())) > 0;
	}
	
	public function getAllowedMethods()
	{
		return $this->allowedMethods;
	}
	
	public function setAllowedMethods(array $allowedMethods = null)
	{
		if($allowedMethods === null){
			$this->allowedMethods = $allowedMethods;
		} else {
			$this->allowedMethods = array();
			foreach($allowedMethods as $method){
				$this->allowedMethods[] = strtoupper($method);
			}
		}
	}
	
	public function isMethodAllowed($method)
	{
		if($this->getAllowedMethods() === null){
			return true;
		}
		return in_array($method, $this->getAllowedMethods(), true);
	}

}
