<?php
namespace Segdmin\Framework\Http;

/**
 * Description of Request
 *
 * @author eagleoneraptor
 */
class Request
{
	/**
	 * @todo
	 * @return Request Devuelve un objeto Request a partir de las variables
	 * globales de PHP (POST, GET, etc)
	 */
	static public function createFromPhpGlobals()
	{
		return new Request();
	}
}
