<?php
namespace Segdmin\Framework\Routing;

/**
 * Description of RouterFactory
 *
 * @author eagleoneraptor
 */
class RouterFactory
{
	static public function createRouterByConfigData(array $data)
	{
		$routes = array();
		
		foreach($data as $routeName => $routeData){
			if(!isset($routeData['roles'])){
				$routeData['roles'] = array();
			}
			$route = new Route();
			$route->setName($routeName);
			$route->setPath($routeData['path']);
			$route->setController($routeData['controller']);
			$route->setRoles($routeData['roles']);
			$route->setAllowedMethods(isset($routeData['allowedMethods'])? $routeData['allowedMethods']:null);
			$routes[$routeName] = $route;
		}
		
		$router = new Router();
		$router->setRoutes($routes);
		
		return $router;
	}
}

