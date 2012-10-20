<?php
namespace Segdmin\Framework\Routing;

use Segdmin\Framework\Http\Request;

/**
 * Description of Router
 *
 * @author eagleoneraptor
 */
class Router
{
	private $routes = array();
	
	public function getRoutes()
	{
		return $this->routes;
	}

	public function setRoutes(array $routes)
	{
		$this->routes = $routes;
	}
	
	public function generatePath($routeName, array $parameters)
	{
		
	}
	
	public function resolveRequest(Request $request)
	{
		
	}
	
}
