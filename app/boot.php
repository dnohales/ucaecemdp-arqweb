<?php
namespace {

use \InvalidArgumentException;

/**
 * Esta clase se encarga de autocargar los archivos PHP con sus respectivas
 * clases.
 * 
 * Se usará como el autoloader de PHP.
 * 
 * @author Damián Nohales <damiannohales@gmail.com>
 */
class ClassLoader
{
	private $namespaceBasePath;

	public function __construct($namespaceBasePath)
	{
		$this->namespaceBasePath = $namespaceBasePath;
	}

	public function register()
	{
		spl_autoload_register(array($this, 'loadClass'), true, false);
	}

	public function loadClass($class)
	{
		$file = $this->findFileByClass($class);
		
		if(!file_exists($file)){
			throw new InvalidArgumentException(sprintf('No se puede cargar la clase "%s" ya que no se encontró el archivo "%s"', $class, $file));
		} else {
			require $this->findFileByClass($class);
			
			//Se verifica si la clase existe incluso los traits para mantener
			//compatibilidad con PHP 5.4
			if(!class_exists($class) && !interface_exists($class) && (!function_exists('trait_exists') || !trait_exists($class))) {
                throw new InvalidArgumentException(sprintf('No se pudo cargar la clase "%s", asegúres que la clase declarada se llame igual que el archivo donde se ha guardado.', $class));
            }
		}
	}

	/**
	 * Devuelve el nombre de archivo de una clase a partir del nombre de la 
	 * misma.
	 * @param string $class el nombre de la clase
	 * @return string el nombre completo del archivo que contiene la clase
	 */
	public function findFileByClass($class)
	{
		$file = str_replace('\\', DIRECTORY_SEPARATOR, $class);
		return $this->namespaceBasePath.'/'.trim($file, DIRECTORY_SEPARATOR).'.php';
	}
}

//Registrar el autoloader
$loader = new ClassLoader(__DIR__);
$loader->register();

}
