<?php
namespace Segdmin\Framework\Exception;

use Segdmin\Framework\Http\StatusCode;
use Segdmin\Framework\Http\ErrorResponse;

/**
 * Description of HttpException
 *
 * @author damiannohales
 */
class HttpException extends \RuntimeException
{
    private $statusCode;
    private $headers;

    public function __construct($statusCode, $message = null, \Exception $previous = null, array $headers = array(), $code = 0)
    {
        $this->statusCode = $statusCode;
        $this->headers = $headers;
		
		if($message === null){
			$message = StatusCode::getMessageByCode($statusCode);
		}

        parent::__construct($message, $code, $previous);
    }

    public function getStatusCode()
    {
        return $this->statusCode;
    }

    public function getHeaders()
    {
        return $this->headers;
    }
	
	public function createResponse()
	{
		return new ErrorResponse($this->getMessage(), $this->getStatusCode(), $this->getHeaders());
	}
}
