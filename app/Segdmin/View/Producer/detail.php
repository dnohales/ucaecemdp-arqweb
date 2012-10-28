<?php $this->extend('Base:full') ?>

<?php $this->block('content') ?>
<?= $this->partial('Entity:_genericDetail', array(
	'entity' => $producer,
	'title' => 'Detalles del productor',
	'editView' => 'Producer:_form',
	'showView' => 'Producer:_show',
	'removeRoute' => 'producer_remove'
)) ?>
<?php $this->endBlock() ?>