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
	
	public function reloadCurrentUri($absolute = false)
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
	
	public function bindIntoEntity($entity, $data, array $onlyBind = null)
	{
		$properties = $this->getOrm()->getRepository($entity)->getMappingInformation()->getProperties();
		foreach($data as $key => $value){
			$type = isset($properties[$key])? $properties[$key]:null;
			if($type !== null && !($type instanceof Database\Type\Id) &&
			   ($onlyBind === null || in_array($key, $onlyBind, true)) &&
			   method_exists($entity, "set$key")){
				$entity->{"set$key"}($this->sanitizeBindValue($value, $type));
			}
		}
	}
	
	private function sanitizeBindValue($value, Database\Type\TypeInterface $type)
	{
		$value = trim($value);
		
		if($value === ''){
			return null;
		} else {
			if($type instanceof Database\Type\Date){
				return \DateTime::createFromFormat('d/m/Y', $value);
			} else if($type instanceof Database\Type\DateTime){
				throw new \Exception('No pueden convertir valores de formularios en DateTime');
			} else {
				return $type->toNative($value);
			}
		}
	}
}

