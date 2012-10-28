<?php $this->extend('Base:full') ?>

<?php $this->block('content') ?>
<?= $this->partial('Entity:_genericIndex', array(
	'title' => 'Productores',
	'detailRoute' => 'producer_detail',
	'addRoute' => 'producer_add',
	'entities' => $producers,
	'fields' => array(
		'Nombre' => 'fullName',
		'DNI' => 'dni',
		'Dirección' => 'address',
	)
)); ?>
<?php $this->endBlock() ?>