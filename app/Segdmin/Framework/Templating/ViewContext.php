<?php

namespace Segdmin\Framework\Templating;

/**
 * Description of ViewContext
 *
 * @author damiannohales
 */
class ViewContext
{
	private $view;
	
	public function __construct(View $view)
	{
		$this->view = $view;
	}
	
	public function extend($viewName)
	{
		$this->view->extend($viewName);
	}
	
	public function partial($viewName, array $parameters = array())
	{
		$this->view->partial($viewName, $parameters);
	}
	
	public function parentBlock()
	{
		return $this->view->parentBlock();
	}
	
	public function block($blockName)
	{
		$this->view->block($blockName);
	}
	
	public function endBlock()
	{
		$this->view->endBlock();
	}
	
	public function asset($name)
	{
		return rtrim($this->request()->getBaseUrl(), '/').'/'.$name;
	}
	
	public function url($routeName, array $parameters = array(), $absolute = false)
	{
		return $this->view->getTemplateManager()->getApplication()->getRouter()->generate($routeName, $parameters, $absolute);
	}
	
	public function request()
	{
		return $this->view->getTemplateManager()->getApplication()->getCurrentRequest();
	}
	
	public function currentUri($absolute = false)
	{
		return $this->request()->absolutize($this->request()->getUri(), $absolute);
	}
	
	public function invokeView()
	{
		extract($this->view->getParameters());
		include($this->view->getViewFile());
	}
}

?>