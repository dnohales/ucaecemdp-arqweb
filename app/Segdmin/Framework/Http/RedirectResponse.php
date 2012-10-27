<?php

namespace Segdmin\Framework\Http;

/**
 * Description of RedirectResponse
 *
 * @author eagleoneraptor
 */
class RedirectResponse extends Response
{
	public function __construct($url = '', $status = 302, array $headers = array())
	{
		parent::__construct(null, $status, $headers);
		
		$this->getHeaders()->set('Location', $url);
		
		$this->setContent("
<!DOCTYPE HTML PUBLIC \"-//IETF//DTD HTML 2.0//EN\">
<html><head>
<title>{$this->getStatusCode()} {$this->getStatusText()}</title>
</head>
<h1>{$this->getStatusCode()} {$this->getStatusText()}</h1>
<p>Redirigiendo a $url</p>
<hr>
<address>{$_SERVER['SERVER_SIGNATURE']}</address>
</body></html>
"
);
	}

}
