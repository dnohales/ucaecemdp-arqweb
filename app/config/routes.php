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
    ),
	'profile' => array(
        'path' => '/micuenta',
        'controller' => 'Main:profile',
        'roles' => array(
            Roles::LOGGEDIN,
        )
    ),
    'user_index' => array(
        'path' => '/usuario',
        'controller' => 'User:index',
        'roles' => array(
            Roles::ADMIN,
        )
    ),
    'user_add' => array(
        'path' => '/usuario/alta',
        'controller' => 'User:add',
        'roles' => array(
            Roles::ADMIN,
        )
    ),
	'user_detail' => array(
		'path' => '/usuario/{id}/detalle',
        'controller' => 'User:detail',
        'roles' => array(
            Roles::ADMIN,
        )
	),
    'user_remove' => array(
        'path' => '/usuario/{id}/baja',
        'controller' => 'User:remove',
		'allowedMethods' => array('POST'),
        'roles' => array(
            Roles::ADMIN,
        )
    ),
    'company_index' => array(
        'path' => '/compania',
        'controller' => 'Company:index',
        'roles' => array(
            Roles::ADMIN,
        )
    ),
    'company_add' => array(
        'path' => '/compania/alta',
        'controller' => 'Company:add',
        'roles' => array(
            Roles::ADMIN,
        )
    ),
    'company_remove' => array(
        'path' => '/compania/{id}/baja',
        'controller' => 'Company:remove',
		'allowedMethods' => array('POST'),
        'roles' => array(
            Roles::ADMIN, Roles::COMPANY,
        )
    ),
    'company_detail' => array(
        'path' => '/compania/{id}/detalle',
        'controller' => 'Company:detail',
        'roles' => array(
            Roles::ADMIN, Roles::COMPANY,
        )
    ),
	'coverage_index' => array(
        'path' => '/cobertura',
        'controller' => 'Coverage:index',
        'roles' => array(
            Roles::ADMIN, Roles::COMPANY,
        )
    ),
    'coverage_add' => array(
        'path' => '/cobertura/alta',
        'controller' => 'Coverage:add',
        'roles' => array(
            Roles::ADMIN, Roles::COMPANY,
        )
    ),
    'coverage_remove' => array(
        'path' => '/cobertura/{id}/baja',
        'controller' => 'Coverage:remove',
		'allowedMethods' => array('POST'),
        'roles' => array(
            Roles::ADMIN, Roles::COMPANY,
        )
    ),
	'coverage_detail' => array(
        'path' => '/cobertura/{id}/detalle',
        'controller' => 'Coverage:detail',
        'roles' => array(
            Roles::ADMIN, Roles::COMPANY,
        )
    ),
	'producer_index' => array(
        'path' => '/productor',
        'controller' => 'Producer:index',
        'roles' => array(
            Roles::ADMIN,
        )
    ),
    'producer_add' => array(
        'path' => '/productor/alta',
        'controller' => 'Producer:add',
        'roles' => array(
            Roles::ADMIN,
        )
    ),
    'producer_remove' => array(
        'path' => '/productor/{id}/baja',
        'controller' => 'Producer:remove',
		'allowedMethods' => array('POST'),
        'roles' => array(
            Roles::ADMIN, Roles::PRODUCER,
        )
    ),
    'producer_detail' => array(
        'path' => '/productor/{id}/detalle',
        'controller' => 'Producer:detail',
        'roles' => array(
            Roles::ADMIN, Roles::PRODUCER,
        )
    ),
    'request_add' => array(
        'path' => '/solicitar/alta',
        'controller' => 'Request:add',
        'roles' => array(
            Roles::ADMIN, Roles::PRODUCER,
        )
    ),
    'request_remove' => array(
        'path' => '/solicitud/{id}/baja',
        'controller' => 'Request:remove',
		'allowedMethods' => array('POST'),
        'roles' => array(
            Roles::ADMIN, Roles::PRODUCER,
        )
    ),
    'request_detail' => array(
        'path' => '/solicitud/{id}/detalle',
        'controller' => 'Request:detail',
        'roles' => array(
            Roles::ADMIN, Roles::PRODUCER
        )
    ),
    'answerrequest' => array(
        'path' => '/solicitud/{id}/responder',
        'controller' => 'Request:answer',
        'roles' => array(
            Roles::ADMIN, Roles::COMPANY
        )
    ),
	'taker_index' => array(
        'path' => '/cliente',
        'controller' => 'Taker:index',
        'roles' => array(
            Roles::ADMIN, Roles::PRODUCER
        )
    ),
    'taker_add' => array(
        'path' => '/cliente/alta',
        'controller' => 'Taker:add',
        'roles' => array(
            Roles::ADMIN, Roles::PRODUCER
        )
    ),
    'taker_remove' => array(
        'path' => '/cliente/{id}/baja',
        'controller' => 'Taker:remove',
		'allowedMethods' => array('POST'),
        'roles' => array(
            Roles::ADMIN, Roles::PRODUCER
        )
    ),
    'taker_detail' => array(
        'path' => '/cliente/{id}/detalle',
        'controller' => 'Taker:detail',
        'roles' => array(
            Roles::ADMIN, Roles::PRODUCER
        )
    ),
);
?>
