<?php $this->extend('Base:full') ?>

<?php $this->block('content') ?>
<?= $this->partial('Entity:_genericDetail', array(
	'entity' => $producer,
	'title' => 'Detalles del productor',
	'editView' => $this->partial('Producer:_form', array('producer' => $producer)),
	'showView' => $this->partial('Producer:_show', array('producer' => $producer)),
	'removeRoute' => 'producer_remove'
)) ?>
<?php $this->endBlock() ?>