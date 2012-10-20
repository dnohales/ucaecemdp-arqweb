<?php

namespace Segdmin\Framework\Http;

/**
 * Description of ErrorResponse
 *
 * @author eagleoneraptor
 */
class ErrorResponse extends Response
{
	public function __construct($content = '', $status = 500, array $headers = array())
	{
		parent::__construct($content, $status, $headers);
		
		$this->setContent("
<!DOCTYPE HTML PUBLIC \"-//IETF//DTD HTML 2.0//EN\">
<html><head>
<title>{$this->getStatusCode()} {$this->getStatusText()}</title>
</head>
<h1>{$this->getStatusCode()} {$this->getStatusText()}</h1>
<p>$content</p>
<hr>
<address>{$_SERVER['SERVER_SIGNATURE']}</address>
</body></html>
"
);
	}

}
