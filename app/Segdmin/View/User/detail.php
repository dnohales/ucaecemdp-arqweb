<?php $this->extend('Base:full') ?>

<?php $this->block('content') ?>
<?= $this->partial('Entity:_genericDetail', array(
	'entity' => $user,
	'title' => 'Detalles del usuario',
	'editView' => $this->partial('User:_formUpdate', array('user' => $user)),
	'showView' => $this->partial('User:_show', array('user' => $user)),
	'removeRoute' => 'user_remove',
	'updateRoute' => 'user_update',
)) ?>
<?php $this->endBlock() ?>