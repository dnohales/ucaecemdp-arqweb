<?php $this->extend('Base:full') ?>

<?php $this->block('content') ?>
<?= $this->partial('Entity:_genericIndex', array(
	'title' => 'Clientes',
	'detailRoute' => 'taker_detail',
	'addRoute' => 'taker_add',
	'entities' => $takers,
	'fields' => array(
		'Nombre' => 'fullName',
		'DNI' => 'dni',
		'Coberturas' => function(){
		},
	)
)); ?>
<?php $this->endBlock() ?>