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
		return $this->view->partial($viewName, $parameters);
	}
	
	public function parentBlock()
	{
		return $this->view->parentBlock();
	}
	
	public function parentBlockAppending($blockName, $content)
	{
		$this->block($blockName);
		echo $this->parentBlock();
		echo $content;
		$this->endBlock();
	}
	
	public function parentBlockPrepending($blockName, $content)
	{
		$this->block($blockName);
		echo $content;
		echo $this->parentBlock();
		$this->endBlock();
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
	
	public function app()
	{
		return $this->view->getTemplateManager()->getApplication();
	}
	
	public function url($routeName, array $parameters = array(), $absolute = false)
	{
		return $this->app()->getRouter()->generate($routeName, $parameters, $absolute);
	}
	
	public function request()
	{
		return $this->app()->getCurrentRequest();
	}
	
	public function session()
	{
		return $this->app()->getSession();
	}
	
	public function user()
	{
		return $this->app()->getSession()->getUser();
	}
	
	public function currentUri($absolute = false)
	{
		return $this->request()->absolutize($this->request()->getUri(), $absolute);
	}
	
	public function html()
	{
		return $this->view->getTemplateManager()->getHtmlHelper();
	}
	
	public function invokeView()
	{
		extract($this->view->getParameters());
		include($this->view->getViewFile());
	}
}
