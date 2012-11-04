<?php $this->extend('Base:full') ?>

<?php $this->parentBlockPrepending('title', 'Detalles de cobertura - ') ?>

<?php $this->block('content') ?>
<h1>Detalles de cobertura</h1>
<?= $this->partial('Coverage:_detail', array(
	'entity' => $coverage,
	'editView' => $this->partial('Coverage:_form', array('coverage' => $coverage)),
	'showView' => $this->partial('Coverage:_show', array('coverage' => $coverage)),
	'removeRoute' => 'coverage_remove',
	'updateRoute' => 'coverage_update',
)) ?>
<?php $this->endBlock() ?>