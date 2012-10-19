<?php
namespace Segdmin\Framework;

use Segdmin\Framework\Http\Request;

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
	}
	
	public function getWebPath()
	{
		return $this->webPath;
	}

	public function getBasePath()
	{
		return $this->basePath;
	}

	public function handle(Request $request)
	{
		return new Http\Response();
	}
}

?>
