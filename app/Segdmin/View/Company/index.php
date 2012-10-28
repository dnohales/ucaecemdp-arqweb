<?php $this->extend('Base:full') ?>

<?php $this->block('content') ?>
<?= $this->partial('Entity:_genericIndex', array(
	'title' => 'Compañías',
	'detailRoute' => 'company_detail',
	'addRoute' => 'company_add',
	'entities' => $companies,
	'fields' => array(
		'Razón social' => 'name',
		'Dirección' => 'address',
	)
)); ?>
<?php $this->endBlock() ?>