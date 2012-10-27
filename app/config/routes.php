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
	'user_edit' => array(
		'path' => '/usuario/{id}/modificacion',
        'controller' => 'User:edit',
        'roles' => array(
            Roles::ADMIN,
        )
	),
    'user_remove' => array(
        'path' => '/usuario/{id}/baja',
        'controller' => 'User:remove',
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
        'roles' => array(
            Roles::ADMIN, Roles::COMPANY,
        )
    ),
    'company_edit' => array(
        'path' => '/compania/{id}/modificacion',
        'controller' => 'Company:edit',
        'roles' => array(
            Roles::ADMIN, Roles::COMPANY,
        )
    ),
    'coverage_add' => array(
        'path' => '/covertura/alta',
        'controller' => 'Coverage:add',
        'roles' => array(
            Roles::ADMIN, Roles::COMPANY,
        )
    ),
    'coverage_remove' => array(
        'path' => '/covertura/{id}/baja',
        'controller' => 'Coverage:remove',
        'roles' => array(
            Roles::ADMIN, Roles::COMPANY,
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
        'roles' => array(
            Roles::ADMIN, Roles::PRODUCER,
        )
    ),
    'producer_edit' => array(
        'path' => '/productor/{id}/modificacion',
        'controller' => 'Producer:edit',
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
        'roles' => array(
            Roles::ADMIN, Roles::PRODUCER,
        )
    ),
    'request_edit' => array(
        'path' => '/solicitud/{id}/modificacion',
        'controller' => 'Request:edit',
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
        'roles' => array(
            Roles::ADMIN, Roles::PRODUCER
        )
    ),
    'taker_edit' => array(
        'path' => '/cliente/{id}/modificacion',
        'controller' => 'Taker:edit',
        'roles' => array(
            Roles::ADMIN, Roles::PRODUCER
        )
    ),
);
?>
