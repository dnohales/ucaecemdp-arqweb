<?php
use Segdmin\Framework\Security\Roles;

return array
(
	'login' => array(
		'path' => '/login',
		'controller' => 'Auth:login',
		'roles' => array(
			Roles::ANONYMOUS,
		)
	),
	
	'logout' => array(
		'path' => '/logout',
		'controller' => 'Auth:logout',
		'roles' => array(
			Roles::LOGGEDIN,
		)
	),
	
	'index' => array(
		'path' => '/',
		'controller' => 'Main:index',
		'roles' => array(
			Roles::LOGGEDIN,
		)
	)
);
?>
