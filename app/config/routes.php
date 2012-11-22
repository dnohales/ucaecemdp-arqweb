<?php

use Segdmin\Framework\Security\Roles;

return array
(
	//Autentificación
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
	
	//Rutas generales
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
	
	//Administración de usuarios
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
	'user_remove' => array(
		'path' => '/usuario/{id}/baja',
		'controller' => 'User:remove',
		'allowedMethods' => array('POST'),
		'roles' => array(
			Roles::ADMIN,
		)
	),
	'user_update' => array(
		'path' => '/usuario/{id}/modificar',
		'controller' => 'User:update',
		'allowedMethods' => array('POST'),
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
	
	//Administración de compañías
	'company_index' => array(
		'path' => '/compania',
		'controller' => 'Company:index',
		'roles' => array(
			Roles::ADMIN, Roles::PRODUCER
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
			Roles::ADMIN,
		)
	),
	'company_update' => array(
		'path' => '/compania/{id}/modificar',
		'controller' => 'Company:update',
		'allowedMethods' => array('POST'),
		'roles' => array(
			Roles::ADMIN,
		)
	),
	'company_detail' => array(
		'path' => '/compania/{id}/detalle',
		'controller' => 'Company:detail',
		'roles' => array(
			Roles::ADMIN, Roles::PRODUCER
		)
	),
	
	//Administración de coberturas
	'coverage_index' => array(
		'path' => '/cobertura',
		'controller' => 'Coverage:index',
		'roles' => array(
			Roles::ADMIN, Roles::COMPANY, Roles::PRODUCER
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
	'coverage_update' => array(
		'path' => '/cobertura/{id}/modificar',
		'controller' => 'Coverage:update',
		'allowedMethods' => array('POST'),
		'roles' => array(
			Roles::ADMIN, Roles::COMPANY,
		)
	),
	'coverage_detail' => array(
		'path' => '/cobertura/{id}/detalle',
		'controller' => 'Coverage:detail',
		'roles' => array(
			Roles::ADMIN, Roles::COMPANY, Roles::PRODUCER
		)
	),
	
	//Administración de productores
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
			Roles::ADMIN,
		)
	),
	'producer_update' => array(
		'path' => '/productor/{id}/modificar',
		'controller' => 'Producer:update',
		'allowedMethods' => array('POST'),
		'roles' => array(
			Roles::ADMIN,
		)
	),
	'producer_detail' => array(
		'path' => '/productor/{id}/detalle',
		'controller' => 'Producer:detail',
		'roles' => array(
			Roles::ADMIN,
		)
	),
	
	//Administración de operaciones
	'operation_index' => array(
		'path' => '/solicitudes',
		'controller' => 'Operation:index',
		'roles' => array(
			Roles::ADMIN, Roles::PRODUCER, Roles::COMPANY
		)
	),
	'operation_add' => array(
		'path' => '/solicitud/alta',
		'controller' => 'Operation:add',
		'roles' => array(
			Roles::ADMIN, Roles::PRODUCER,
		)
	),
	'operation_add_by_coverage' => array(
		'path' => '/solicitud/cobertura/{coverageId}/alta',
		'controller' => 'Operation:addByCoverage',
		'roles' => array(
			Roles::ADMIN, Roles::PRODUCER,
		)
	),
	'operation_company_info' => array(
		'path' => '/solicitud/compania/{id}/informacion',
		'controller' => 'Operation:getCompanyInfo',
		'roles' => array(
			Roles::ADMIN, Roles::PRODUCER,
		)
	),
	'operation_total_cost' => array(
		'path' => '/solicitud/costo_total',
		'controller' => 'Operation:getOperationTotalCost',
		'roles' => array(
			Roles::ADMIN, Roles::PRODUCER,
		),
		'allowedMethods' => array('POST'),
	),
	'operation_remove' => array(
		'path' => '/solicitud/{id}/baja',
		'controller' => 'Operation:remove',
		'allowedMethods' => array('POST'),
		'roles' => array(
			Roles::ADMIN, Roles::PRODUCER,
		)
	),
	'operation_detail' => array(
		'path' => '/solicitud/{id}/detalle',
		'controller' => 'Operation:detail',
		'roles' => array(
			Roles::ADMIN, Roles::PRODUCER
		)
	),
	'answeroperation' => array(
		'path' => '/solicitud/{id}/responder',
		'controller' => 'Operation:answer',
		'roles' => array(
			Roles::ADMIN, Roles::COMPANY
		)
	),
	
	//Administración de clientes
	'taker_index' => array(
		'path' => '/cliente',
		'controller' => 'Taker:index',
		'roles' => array(
			Roles::ADMIN, Roles::PRODUCER, Roles::COMPANY
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
	'taker_update' => array(
		'path' => '/cliente/{id}/modificar',
		'controller' => 'Taker:update',
		'allowedMethods' => array('POST'),
		'roles' => array(
			Roles::ADMIN, Roles::PRODUCER
		)
	),
	'taker_detail' => array(
		'path' => '/cliente/{id}/detalle',
		'controller' => 'Taker:detail',
		'roles' => array(
			Roles::ADMIN, Roles::PRODUCER, Roles::COMPANY
		)
	),
);
?>
