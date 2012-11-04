<?php $this->extend('Base:full') ?>

<?php $this->block('content') ?>
<h1>Detalles del cliente</h1>
<?= $this->partial('Entity:_genericDetail', array(
	'entity' => $taker,
	'editView' => $this->partial('Taker:_form', array('taker' => $taker)),
	'showView' => $this->partial('Taker:_show', array('taker' => $taker)),
	'removeRoute' => 'taker_remove',
	'updateRoute' => 'taker_update'
)) ?>
<?php $this->endBlock() ?>