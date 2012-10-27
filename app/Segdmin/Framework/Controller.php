<?php
namespace Segdmin\Framework;

/**
 * Description of Controller
 *
 * @author eagleoneraptor
 */
class Controller extends ApplicationAggregate
{
	public function render($viewName, array $parameters = array())
	{
		return new Http\Response($this->getApplication()->getTemplateManager()->renderView($viewName, $parameters));
	}
	
	public function redirect($url)
	{
		return new Http\RedirectResponse($url);
	}
	
	public function redirectByRoute($routeName, array $params = array(), $absolute = false)
	{
		return $this->redirect($this->generateUrl($routeName, $params, $absolute));
	}
	
	public function generateUrl($routeName, array $params = array(), $absolute = false)
	{
		return $this->getApplication()->getRouter()->generate($routeName, $params, $absolute);
	}
	
	public function getOrm()
	{
		return $this->getApplication()->getOrm();
	}
	
	public function getRequest()
	{
		return $this->getApplication()->getCurrentRequest();
	}
}

