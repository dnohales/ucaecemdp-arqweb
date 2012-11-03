<?php $this->extend('Base:full') ?>

<?php $this->block('content') ?>
<h1>Coberturas</h1>
<?= $this->partial('Entity:_genericIndex', array(
	'detailRoute' => 'coverage_detail',
	'addRoute' => 'coverage_add',
	'entities' => $coverages,
	'fields' => $tableFields
)); ?>
<?php $this->endBlock() ?>