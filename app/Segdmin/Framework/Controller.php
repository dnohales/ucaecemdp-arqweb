<?php
namespace Segdmin\Framework;

/**
 * Description of Controller
 *
 * @author eagleoneraptor
 */
class Controller extends ApplicationAggregate
{
	/**
	 * Busca una entidad y arroja un error 404 si no la encuentra
	 * @param string $repoName
	 * @param mixed $id
	 * @return \Segdmin\Model\Entity
	 * @todo Arrojar un error 404
	 */
	public function findEntity($repoName, $id)
	{
		$entity = $this->getOrm()->find($repoName, $id);
		if($entity === null){
			throw $this->createNotFoundException();
		}
		return $entity;
	}
	
	public function createNotFoundException()
	{
		return new Exception\HttpException(404);
	}
	
	public function createForbbidenException()
	{
		return new Exception\HttpException(403);
	}
	
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
	
	public function reloadCurrentUri($absolute)
	{
		return $this->redirect($this->getRequest()->absolutize($this->getRequest()->getUri(), $absolute));
	}
	
	public function generateUrl($routeName, array $params = array(), $absolute = false)
	{
		return $this->getApplication()->getRouter()->generate($routeName, $params, $absolute);
	}
	
	/**
	 * @return Database\ORM 
	 */
	public function getOrm()
	{
		return $this->getApplication()->getOrm();
	}
	
	/**
	 * @return Http\Request 
	 */
	public function getRequest()
	{
		return $this->getApplication()->getCurrentRequest();
	}
	
	/**
	 * @return Security\Session 
	 */
	public function getSession()
	{
		return $this->getApplication()->getSession();
	}
	
	public function getUser()
	{
		return $this->getSession()->getUser();
	}
	
	public function bindIntoEntity($entity, $data)
	{
		$properties = $this->getOrm()->getRepository($entity)->getMappingInformation()->getProperties();
		foreach($data as $key => $value){
			if(isset($properties[$key]) && method_exists($entity, "set$key")){
				$entity->{"set$key"}($properties[$key]->toNative($this->sanitizeBindValue($value)));
			}
		}
	}
	
	private function sanitizeBindValue($value)
	{
		$value = trim($value);
		return $value===''? null:$value;
	}
}

