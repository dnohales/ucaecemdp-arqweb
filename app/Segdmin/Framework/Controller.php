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
	
	public function getOrm()
	{
		return $this->getApplication()->getOrm();
	}
}

