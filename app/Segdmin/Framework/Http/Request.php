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
	const HTTP_PORT = 80;
	const HTTPS_PORT = 443;
	
	private $_query;
	private $_post;
	private $_attributes;
	private $_cookies;
	private $_files;
	private $_server;
	private $method;
	private $baseUrl;
	private $baseRoutePath;
	private $pathName;
	
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
		$this->baseUrl = $this->prepareBaseUrl();
		$this->baseRoutePath = $this->prepareBaseRoutePath();
		$this->pathName = $this->preparePathName();
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
	
	private function prepareBaseUrl()
	{
		return dirname($this->server()->get('SCRIPT_NAME'));
	}
	
	/**
	 * Devuelve la URL base del sistema, esto es, la URL que apunta a la carpeta
	 * web. Este método nunca devuelve el nombre del script ejecutado. Además
	 * la URL es devuelta sin información del servidor y protocolo.
	 * 
	 * http://localhost/sitio/web/index.php/login -> /sitio/web
	 * http://localhost/ -> /
	 * 
	 * @return string La URL base
	 */
	public function getBaseUrl()
	{
		return $this->baseUrl;
	}
	
	private function prepareBaseRoutePath()
	{
		if( $this->server()->has('REDIRECT_URL') ){
			//Es una URL sin index.php (con rewrite)
			return $this->getBaseUrl();
		} else {
			//Es una URL con index.php (sin rewrite)
			return ($this->getBaseUrl() == '/'? '':$this->getBaseUrl()).'/'.trim(basename($this->server()->get('SCRIPT_NAME')), '/');
		}
	}
	
	/**
	 * Devuelve el path base para generar las rutas al sistema, se diferencia
	 * con getBaseUrl en que este método puede devolver el nombre del controlador
	 * frontal (index.php) si no está presente la reescritura de URL.
	 * 
	 * @return string La URL base para generar rutas.
	 */
	public function getBaseRoutePath()
	{
		return $this->baseRoutePath;
	}

	private function preparePathName()
	{
		$path = '';
		
		if($this->server()->has('PATH_INFO')){
			$path = trim($this->server()->get('PATH_INFO'), '/');
		} else if($this->server()->has('REDIRECT_URL')) {
			$path = trim(substr_replace($this->server()->get('REDIRECT_URL'), '', 0, strlen($this->getBaseUrl())), '/');
		}
		
		if(empty($path)){
			return '/';
		} else {
			return '/'.$path;
		}
	}
	
	/**
	 * El nombre del path.
	 * 
	 * @return string El nombre del path
	 */
	public function getPathName()
	{
		return $this->pathName;
	}
	
	public function isSecure()
	{
		return $this->server()->get('HTTPS') != '';
	}
	
	public function getScheme()
	{
		return $this->isSecure()? 'https':'http';
	}
	
	public function getHost()
	{
		$hostName = $this->server()->get('HTTP_HOST');
		$port = $this->server()->get('SERVER_PORT');
		
		if(!$this->isSecure() && $port == self::HTTP_PORT || $this->isSecure() && $port == self::HTTPS_PORT){
			return $hostName;
		} else {
			return "$hostName:$port";
		}
	}
	
	public function getUri()
	{
		return $this->server()->get('REQUEST_URI');
	}
	
	public function absolutize($uri, $absolutize = true)
	{
		if($absolutize){
			return $this->getScheme().'://'.$this->getHost().$uri;
		} else {
			return $uri;
		}
	}

}
