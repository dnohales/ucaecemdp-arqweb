<?php $this->extend('Base:full') ?>

<?php $this->block('content') ?>
<?= $this->partial('Entity:_genericDetail', array(
	'entity' => $company,
	'title' => 'Detalles de la compañía',
	'editView' => 'Company:_form',
	'showView' => 'Company:_show',
	'removeRoute' => 'company_remove'
)) ?>
<?php $this->endBlock() ?>