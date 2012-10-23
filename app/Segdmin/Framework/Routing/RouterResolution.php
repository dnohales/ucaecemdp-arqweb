<?php
namespace Segdmin\Framework\Routing;

/**
 * Description of RouterResolution
 *
 * @author eagleoneraptor
 */
class RouterResolution
{
	private $route;
	private $parameters;
	
	/**
	 * @return Route
	 */
	public function getRoute()
	{
		return $this->route;
	}

	public function getParameters()
	{
		return $this->parameters;
	}

	public function match(Route $route, $pathName)
	{
		$matches = null;
		preg_match_all('/\{([a-zA-z_0-9]+)\}/', $route->getPath(), $matches, PREG_OFFSET_CAPTURE | PREG_SET_ORDER);
		
		$parameters = array();
		$regexedPath = $route->getPath();
		
		foreach($matches as $match){
			$regexedPath = str_replace($match[0][0], '(.*)', $regexedPath);
		}
		$regexedPath = str_replace('/', '\/', $regexedPath);
		
		
		$requestMatches = null;
		if(preg_match_all('/^'.$regexedPath.'$/', $pathName, $requestMatches) == 0){
			return false;
		}
		
		foreach($matches as $i => $match){
			$parameterName = $match[1][0];
			$parameterValue = $requestMatches[$i+1][0];
			
			$parameters[$parameterName] = $parameterValue;
		}
		
		$this->route = $route;
		$this->parameters = $parameters;
		
		return true;
	}
}

