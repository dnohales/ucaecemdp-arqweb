<?php
namespace Segdmin\Framework\Http;

use Segdmin\Framework\Util\ArrayCollection;

/**
 * Description of Request
 *
 * @author eagleoneraptor
 */
class Request
{
	private $_query;
	
	private $_post;
	
	private $_attributes;
	
	private $_cookies;
	
	private $_files;
	
	private $_server;
	
	private $method;
	
	public function __construct(array $query = array(), array $post = array(),
								 array $attributes = array(), array $cookies = array(),
								 array $files = array(), array $server = array())
	{
		$this->_query = new ArrayCollection($query);
		$this->_post = new ArrayCollection($post);
		$this->_attributes = new ArrayCollection($attributes);
		$this->_cookies = new ArrayCollection($cookies);
		$this->_files = new ArrayCollection($files);
		$this->_server = new ArrayCollection($server);
		
		$this->method = strtoupper($this->server()->get('REQUEST_METHOD', 'GET'));
	}
	
	/**
	 * @todo
	 * @return Request Devuelve un objeto Request a partir de las variables
	 * globales de PHP (POST, GET, etc)
	 */
	static public function createFromPhpGlobals()
	{
		return new static($_GET, $_POST, array(), $_COOKIE, $_FILES, $_SERVER);
	}
	
	public function query()
	{
		return $this->_query;
	}

	public function post()
	{
		return $this->_post;
	}

	public function attributes()
	{
		return $this->_attributes;
	}

	public function cookies()
	{
		return $this->_cookies;
	}

	public function files()
	{
		return $this->_files;
	}

	public function server()
	{
		return $this->_server;
	}
	
	public function getMethod()
	{
		return $this->method;
	}
	
	public function isPost()
	{
		return $this->getMethod() == 'POST';
	}
}
