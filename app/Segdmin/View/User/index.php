<?php
use Segdmin\Framework\Security\Roles;
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
			switch($user->getRelatedRole())
			{
			case Roles::ADMIN:
				if($user->isSuperUser()){
					return 'Administrador principal';
				} else {
					return 'Administrador ('.$user->getAdmin()->getFullName().')';
				}
				
			case Roles::PRODUCER:
				return 'Productor ('.$user->getProducer()->getFullName().')';
				
			case Roles::COMPANY:
				return 'Compañía ('.$user->getCompany()->getName().')';
			}
		},
	)
)); ?>
<?php $this->endBlock() ?>