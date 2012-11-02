<?php $this->extend('Base:full') ?>

<?php $this->block('content') ?>
<?= $this->partial('Entity:_genericDetail', array(
	'entity' => $company,
	'title' => 'Detalles de la compañía',
	'editView' => $this->partial('Company:_form', array('company' => $company)),
	'showView' => $this->partial('Company:_show', array('company' => $company)),
	'removeRoute' => 'company_remove'
)) ?>
<?php $this->endBlock() ?>