<?php
use Segdmin\Helper\UserRoleAsString;
?>
<?php $this->extend('Base:full') ?>

<?php $this->block('content') ?>
<?= $this->partial('Entity:_genericIndex', array(
	'title' => 'Usuarios',
	'detailRoute' => 'user_detail',
	'addRoute' => 'user_add',
	'entities' => $users,
	'fields' => array(
		'Correo electrónico' => 'email',
		'Rol' => function($user){
			return UserRoleAsString::toText($user);
		},
	)
)); ?>
<?php $this->endBlock() ?>