<?php $this->extend('Base:full') ?>

<?php $this->block('content') ?>
<h1>Compañías</h1>
<?= $this->partial('Entity:_genericIndex', array(
	'detailRoute' => 'company_detail',
	'addRoute' => 'company_add',
	'entities' => $companies,
	'fields' => array(
		'Razón social' => 'name',
		'Dirección' => 'address',
	)
)); ?>
<?php $this->endBlock() ?>