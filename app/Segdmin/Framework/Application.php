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

	public function handle(Http\Request $request)
	{
		return new Http\Response();
	}
}

?>
