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
		$pathName = str_replace(array_keys($parameters), array_values($parameters), $route->getPath());
		$uri = rtrim($this->getContextRequest()->getBaseRoutePath(), '/').'/'.ltrim($pathName, '/');
		return $this->getContextRequest()->absolutize($uri, $absolute);
	}
	
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
