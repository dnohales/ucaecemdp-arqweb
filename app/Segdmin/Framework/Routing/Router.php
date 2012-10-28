<?php
namespace Segdmin\Framework\Routing;

use Segdmin\Framework\Http\Request;
use Segdmin\Framework\Exception\RouterException;

/**
 * Description of Router
 *
 * @author eagleoneraptor
 */
class Router
{
	private $routes = array();
	private $contextRequest = null;
	
	public function getRoutes()
	{
		return $this->routes;
	}

	public function setRoutes(array $routes)
	{
		$this->routes = $routes;
	}
	
	public function getRoute($name)
	{
		return $this->routes[$name];
	}
	
	public function getContextRequest()
	{
		return $this->contextRequest;
	}

	public function setContextRequest(Request $contextRequest)
	{
		$this->contextRequest = $contextRequest;
	}
	
	public function generate($routeName, array $parameters = array(), $absolute = false)
	{
		$route = $this->getRoute($routeName);
		
		$pathName = $route->getPath();
		foreach($parameters as $pName => $pValue){
			$pathName = str_replace('{'.$pName.'}', $pValue, $pathName);
		}
		
		
		$uri = rtrim($this->getContextRequest()->getBaseRoutePath(), '/').'/'.ltrim($pathName, '/');
		return $this->getContextRequest()->absolutize($uri, $absolute);
	}
	
	/**
	 * Parsea un request para obtener la ruta con los parámetros indicados en 
	 * la URL.
	 * @param Request $request El request a partir del cual se buscará la ruta
	 * indicada.
	 * @return RouterResolution La respuesta del ruteador en la que se encapsulan
	 * los parámetros resueltos y el objeto Route correspondiente.
	 * @throws RouterException 
	 */
	public function match(Request $request)
	{
		$resolution = new RouterResolution();
		
		foreach($this->getRoutes() as $route){
			if($resolution->match($route, $request->getPathName())){
				return $resolution;
			}
		}
		
		throw new RouterException('No se puede encontrar la ruta '.$request->getPathName());
	}
	
}
