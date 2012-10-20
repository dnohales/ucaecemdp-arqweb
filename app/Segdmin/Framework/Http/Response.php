<?php

namespace Segdmin\Framework\Http;

use Segdmin\Framework\Util\ArrayCollection;

/**
 * Description of Response
 *
 * @author eagleoneraptor
 */
class Response
{

	protected $headers;
	protected $content;
	protected $statusCode;
	protected $statusText;
	protected $charset;
	protected $contentType;

	public function __construct($content = '', $status = 200, array $headers = array())
	{
		$this->headers = new ArrayCollection($headers);
		$this->setContent($content);
		$this->setStatusCode($status);
		$this->setCharset('UTF-8');
		$this->setContentType('text/html');
	}

	public function setContent($content)
	{
		$this->content = (string) $content;
	}

	public function getContent()
	{
		return $this->content;
	}

	public function setStatusCode($code, $text = null)
	{
		$this->statusCode = (int) $code;
		if (!StatusCode::isValid($this->statusCode)) {
			throw new \InvalidArgumentException('El código de estado HTTP "' . $this->statusCode . '" no es válido');
		}

		$this->statusText = $text ? : StatusCode::getMessageByCode($this->statusCode);
	}

	public function getStatusCode()
	{
		return $this->statusCode;
	}

	public function setStatusText($text)
	{
		$this->statusText = $text;
	}

	public function getStatusText()
	{
		return $this->statusText;
	}

	public function getHeaders()
	{
		return $this->headers;
	}

	public function getCharset()
	{
		return $this->charset;
	}

	public function setCharset($charset)
	{
		$this->charset = $charset;
	}

	public function getContentType()
	{
		return $this->contentType;
	}

	public function setContentType($contentType)
	{
		$this->contentType = $contentType;
	}

	public function sendHeaders()
	{
		if (headers_sent()) {
			return;
		}

		$this->getHeaders()->set('Content-Type', $this->getContentType() . '; charset=' . $this->getCharset());

		header(sprintf('HTTP/1.1 %s %s', $this->statusCode, $this->statusText));

		foreach ($this->headers as $name => $value) {
			header($name . ': ' . $value, false);
		}
	}

	public function sendContent()
	{
		echo $this->content;
	}

	public function send()
	{
		$this->sendHeaders();
		$this->sendContent();
	}

}
