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
	
	/**
	 * @var Templating\TemplateManager 
	 */
	private $templateManager;
	
	/**
	 * @var Database\ORM
	 */
	private $orm;
	
	/**
	 * @var Logger
	 */
	private $logger;
	
	/**
	 * @var Session
	 */
	private $session;
	
	public function __construct($webPath, $basePath)
	{
		$this->webPath = $webPath;
		$this->basePath = $basePath;
		$this->router = Routing\RouterFactory::createRouterByConfigData(include $this->getBasePath().'/config/routes.php');
		$this->templateManager = new Templating\TemplateManager($this->basePath.'/Segdmin/View');
		$this->templateManager->setApplication($this);
		$this->orm = new Database\ORM($this->createPdo());
		$this->logger = Logger::createInstance();
		$this->session = Security\Session::createInstance($this->orm);
	}
	
	public function getWebPath()
	{
		return $this->webPath;
	}

	public function getBasePath()
	{
		return $this->basePath;
	}
	
	/**
	 * @return Routing\Router 
	 */
	public function getRouter()
	{
		return $this->router;
	}
	
	/**
	 * @return Http\Request 
	 */
	public function getCurrentRequest()
	{
		return $this->currentRequest;
	}
	
	/**
	 * @return Templating\TemplateManager 
	 */
	public function getTemplateManager()
	{
		return $this->templateManager;
	}
	
	/**
	 * @return Database\ORM 
	 */
	public function getOrm()
	{
		return $this->orm;
	}
	
	/**
	 * @return Logger 
	 */
	public function getLogger()
	{
		return $this->logger;
	}
	
	/**
	 * @return Security\Session 
	 */
	public function getSession()
	{
		return $this->session;
	}
	
	/**
	 * @param Http\Request $request
	 * @return Http\Response 
	 */
	public function handle(Http\Request $request)
	{
		$this->currentRequest = $request;
		$this->router->setContextRequest($request);
		$this->session->setContextRequest($request);
		$exception = null;
		
		try{
			$resolution = $this->router->match($request);
			
			if( !$resolution->getRoute()->isUserGranted($this->session->getUser()) ) {
				if(!$this->session->isLoggedIn()){
					return new Http\RedirectResponse($this->router->generate('login'));
				} else {
					return new Http\ErrorResponse(null, 403);
				}
			}
			
			if(!$resolution->getRoute()->isMethodAllowed($request->getMethod())){
				return new Http\ErrorResponse(null, 400);
			}
			
			$response = $this->invokeController($resolution);
			return $this->sanitizeResponse($response);
		} catch(Exception\RouterException $e){
			return new Http\ErrorResponse($e->getMessage(), 404);
		} catch(Exception\HttpException $e){
			$exception = $e;
			$response = $e->createResponse();
		} catch(\Exception $e){
			$exception = $e;
			$response = new Http\ErrorResponse($e->getMessage(), 500);
		}
		
		Logger::error($exception->getMessage(), 'app.exception');
		return $response;
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
	
	public function handleError($errno, $errstr, $errfile, $errline, $errcontext)
	{
		throw new RuntimeException("$errstr en $errfile en la línea $errline");
	}
	
	private function sanitizeResponse($response)
	{
		if($response instanceof Http\Response){
			return $response;
		} else if(is_scalar($response)){
			return new Http\Response((string)$response);
		} else {
			throw new \Exception('El controlador debe devolver un objeto Segdmin\Framework\Http\Response o un escalar');
		}
	}
	
	private function createPdo()
	{
		$configFile = $this->getBasePath().'/config/database.php';
		if(!file_exists($configFile)){
			throw new \Exception("Tienes que crear el archivo \"$configFile\" a partir del archivo database.dist.php en el mismo directorio.");
		}
		
		$config = include($configFile);
		return new \PDO($config['dsn'], $config['username'], $config['password'], $config['options']);
	}
}

