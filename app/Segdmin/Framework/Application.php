<?php
namespace Segdmin\Framework;

/**
 * Description of Application
 *
 * @author eagleoneraptor
 */
class Application
{
	private $webPath;
	private $basePath;
	
	/**
	 * @var Routing\Router
	 */
	private $router;
	
	/**
	 * @var Http\Request
	 */
	private $currentRequest;
	
	public function __construct($webPath, $basePath)
	{
		$this->webPath = $webPath;
		$this->basePath = $basePath;
		$this->router = Routing\RouterFactory::createRouterByConfigData(include $this->getBasePath().'/config/routes.php');
	}
	
	public function getWebPath()
	{
		return $this->webPath;
	}

	public function getBasePath()
	{
		return $this->basePath;
	}
	
	public function getRouter()
	{
		return $this->router;
	}

	public function getCurrentRequest()
	{
		return $this->currentRequest;
	}

	public function handle(Http\Request $request)
	{
		$this->currentRequest = $request;
		$this->router->setContextRequest($request);
		
		try{
			$resolution = $this->router->match($request);
			$response = $this->invokeController($resolution);
			return $this->sanitizeResponse($response);
		} catch(Exception\RouterException $e){
			return new Http\ErrorResponse($e->getMessage(), 404);
		}
	}
	
	private function invokeController(Routing\RouterResolution $resolution)
	{
		$controllerClass = $resolution->getRoute()->getControllerClass();
		$controllerMethod = $resolution->getRoute()->getControllerMethod();
		$controller = new $controllerClass;
		
		if(!$controller instanceof ApplicationAggregateInterface){
			throw new \Exception('La clase "'.$controllerClass.'" debe implementar Segdmin\Framework\ApplicationAggregateInterface');
		}
		
		$controller->setApplication($this);
		
		$reflection = new \ReflectionObject($controller);
		
		if(!$reflection->hasMethod($controllerMethod)){
			throw new \Exception('No se encotró el método "'.$controllerClass.'::'.$controllerMethod.'"');
		}
		
		$reflectionMethod = $reflection->getMethod($controllerMethod);
		if(!$reflectionMethod->isPublic()){
			throw new \Exception('El método "'.$controllerClass.'::'.$controllerMethod.'" debe ser público');
		}
		
		$methodParameters = $reflectionMethod->getParameters();
		$resParameters = $resolution->getParameters();
		$invokeParameters = array();
		foreach($methodParameters as $par){
			if(!isset($resParameters[$par->getName()])){
				if(!$par->isOptional()){
					throw new \Exception('El parámetro llamado "'.$par->getName().'" del método "'.$controllerClass.'::'.$controllerMethod.'" es obligatorio y no está presente');
				}
			} else {
				$invokeParameters[] = $resParameters[$par->getName()];
			}
		}
		
		return $reflectionMethod->invokeArgs($controller, $invokeParameters);
	}
	
	private function sanitizeResponse($response)
	{
		if($response instanceof Http\Response){
			return $response;
		} else if(is_scalar($response) || $response === null){
			return new Http\Response((string)$response);
		} else {
			throw new \Exception('El controlador debe devolver un objeto Segdmin\Framework\Http\Response, un escalar o null');
		}
	}
}

?>
