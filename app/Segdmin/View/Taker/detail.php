<?php $this->extend('Base:full') ?>

<?php $this->block('content') ?>
<?= $this->partial('Entity:_genericDetail', array(
	'entity' => $taker,
	'title' => 'Detalles del cliente',
	'editView' => $this->partial('Taker:_form', array('taker' => $taker)),
	'showView' => $this->partial('Taker:_show', array('taker' => $taker)),
	'removeRoute' => 'taker_remove'
)) ?>
<?php $this->endBlock() ?>