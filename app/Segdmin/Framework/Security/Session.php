<?php
namespace Segdmin\Framework\Security;

use Segdmin\Framework\Util\ArrayCollection;
use Segdmin\Framework\Http\Request;
use Segdmin\Framework\Database\ORM;
use Segdmin\Model\Entity;

/**
 * Description of Session
 *
 * @author eagleoneraptor
 */
class Session
{
	static private $singletonInstance;
	
	private $user;
	
	/**
	 * Una petición HTTP que se usará para settear el path a la cookie, usualmente
	 * es la petición actual y la aplicación se encargará de llenarlo.
	 * @var Request 
	 */
	private $contextRequest;
	
	private function __construct(ORM $orm)
	{
		session_start();
		if(isset($_SESSION['user'])){
			try{
				$this->user = $orm->find($_SESSION['user']['class'], $_SESSION['user']['id']);
				if($this->user === null){
					throw new \Exception('No se encontró al usuario guardado en sesión');
				}
			} catch(\Exception $e){
				$this->user = new AnonymousUser();
			}
		} else {
			$this->user = new AnonymousUser();
		}
		
		if(!isset($_SESSION['flashes'])){
			$_SESSION['flashes'] = array();
		}
	}
	
	static public function createInstance(ORM $orm)
	{
		if(self::$singletonInstance === null){
			self::$singletonInstance = new Session($orm);
		}
		
		return self::$singletonInstance;
	}
	
	static public function getInstance()
	{
		if(self::$singletonInstance === null){
			throw new \Exception('Necesitas crear la sesión primero usando Session::createInstance');
		}
		
		return self::$singletonInstance;
	}

	public function getUser()
	{
		return $this->user;
	}
	
	public function login(UserEntity $user, $lifeTime)
	{
		if($this->getContextRequest() === null){
			session_set_cookie_params($lifeTime);
		} else {
			session_set_cookie_params($lifeTime, $this->getContextRequest()->getBaseUrl());
		}
		session_regenerate_id();
		$this->user = $user;
		$_SESSION['user'] = array(
			'class' => get_class($user),
			'id' => $user->getId()
		);
		$_SESSION['flashes'] = array();
	}
	
	public function logout()
	{
		if(session_id() != ''){
			$this->user = new AnonymousUser();
			session_unset();
			session_destroy();
		}
	}
	
	public function isLoggedIn()
	{
		return in_array(Roles::LOGGEDIN, $this->getUser()->getRoles());
	}
	
	public function getContextRequest()
	{
		return $this->contextRequest;
	}

	public function setContextRequest(Request $contextRequest)
	{
		$this->contextRequest = $contextRequest;
	}
	
	public function setFlash($key, $value)
	{
		$_SESSION['flashes'][$key] = $value;
	}
	
	public function getFlash($key, $remove = true)
	{
		if(isset($_SESSION['flashes'][$key])){
			$o = $_SESSION['flashes'][$key];
			if($remove){
				unset($_SESSION['flashes'][$key]);
			}
			return $o;
		} else {
			return null;
		}
	}
	
	public function hasFlash($key)
	{
		return isset($_SESSION['flashes'][$key]);
	}

}

