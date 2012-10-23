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
			$routes[$routeName] = new Route($routeName, $routeData['path'], $routeData['controller'], $routeData['roles']);
		}
		
		$router = new Router();
		$router->setRoutes($routes);
		
		return $router;
	}
}

