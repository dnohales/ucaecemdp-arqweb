<?php
namespace Segdmin\Framework\Templating;

use Segdmin\Framework\ApplicationAggregate;

/**
 * Description of TemplateManager
 *
 * @author eagleoneraptor
 */
class TemplateManager extends ApplicationAggregate
{
	private $viewBasePath;
	
	private $htmlHelper;
	
	public function __construct($viewBasePath)
	{
		$this->viewBasePath = $viewBasePath;
		$this->htmlHelper = new HtmlHelper();
	}
	
	public function getViewBasePath()
	{
		return $this->viewBasePath;
	}

	public function setViewBasePath($viewBasePath)
	{
		$this->viewBasePath = $viewBasePath;
	}
	
	public function getHtmlHelper()
	{
		return $this->htmlHelper;
	}
	
	public function getViewFile($viewName)
	{
		$viewParts = explode(':', $viewName);
		$viewParts[0] .= $viewParts[0] == ''? '':'/';
		
		return $this->getViewBasePath().'/'.$viewParts[0].$viewParts[1].'.php';
	}
	
	public function createView($viewName, array $parameters)
	{
		return new View($this, $this->getViewFile($viewName), $parameters);
	}

	public function renderView($viewName, array $parameters = array())
	{
		$view = $this->createView($viewName, $parameters);
		$view->run();
		return $view->render();
	}
}
