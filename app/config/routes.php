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
            Roles::ANONYMOUS,
        )
    ),
    'addadmin' => array(
        'path' => '/addadmin',
        'controller' => 'Admin:add',
        'roles' => array(
            Roles::ADMIN,
        )
    ),
    'removeadmin' => array(
        'path' => '/removeadmin',
        'controller' => 'Admin:remove',
        'roles' => array(
            Roles::ADMIN,
        )
    ),
    'addcompany' => array(
        'path' => '/addcompany',
        'controller' => 'Company:add',
        'roles' => array(
            Roles::ADMIN,
        )
    ),
    'removecompany' => array(
        'path' => '/removecompany',
        'controller' => 'Company:remove',
        'roles' => array(
            Roles::ADMIN, Roles::COMPANY,
        )
    ),
    'editcompany' => array(
        'path' => '/editcompany',
        'controller' => 'Company:edit',
        'roles' => array(
            Roles::ADMIN, Roles::COMPANY,
        )
    ),
    'addcoverage' => array(
        'path' => '/addcoverage',
        'controller' => 'Coverage:add',
        'roles' => array(
            Roles::ADMIN, Roles::COMPANY,
        )
    ),
    'removecoverage' => array(
        'path' => '/removecoverage',
        'controller' => 'Coverage:remove',
        'roles' => array(
            Roles::ADMIN, Roles::COMPANY,
        )
    ),
    'addproducer' => array(
        'path' => '/addproducer',
        'controller' => 'Producer:add',
        'roles' => array(
            Roles::ADMIN,
        )
    ),
    'removeproducer' => array(
        'path' => '/removeproducer',
        'controller' => 'Producer:remove',
        'roles' => array(
            Roles::ADMIN, Roles::PRODUCER,
        )
    ),
    'editproducer' => array(
        'path' => '/editproducer',
        'controller' => 'Producer:edit',
        'roles' => array(
            Roles::ADMIN, Roles::PRODUCER,
        )
    ),
    'addrequest' => array(
        'path' => '/addrequest',
        'controller' => 'Request:add',
        'roles' => array(
            Roles::ADMIN, Roles::PRODUCER,
        )
    ),
    'removerequest' => array(
        'path' => '/removerequest',
        'controller' => 'Request:remove',
        'roles' => array(
            Roles::ADMIN, Roles::PRODUCER,
        )
    ),
    'editrequest' => array(
        'path' => '/editrequest',
        'controller' => 'Request:edit',
        'roles' => array(
            Roles::ADMIN, Roles::PRODUCER
        )
    ),
    'answerrequest' => array(
        'path' => '/answerrequest',
        'controller' => 'Request:answer',
        'roles' => array(
            Roles::ADMIN, Roles::COMPANY
        )
    ),
    'addtaker' => array(
        'path' => '/addtaker',
        'controller' => 'Taker:add',
        'roles' => array(
            Roles::ADMIN, Roles::PRODUCER
        )
    ),
    'removetaker' => array(
        'path' => '/removetaker',
        'controller' => 'Taker:remove',
        'roles' => array(
            Roles::ADMIN, Roles::PRODUCER
        )
    ),
    'edittaker' => array(
        'path' => '/edittaker',
        'controller' => 'Taker:edit',
        'roles' => array(
            Roles::ADMIN, Roles::PRODUCER
        )
    ),
);
?>
