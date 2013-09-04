<p>
<?php if($company->getUser()): ?>
	Usuario: <strong><?= $company->getUser()->getEmail() ?></strong>
	&nbsp;<a href="<?= $this->url('user_detail', array('id' => $company->getUser()->getId())); ?>" title="Detalles del usuario" class="btn"><i class="icon icon-search"></i></a>
<?php else: ?>
	Usuario: <em>Esta compañía no posee un usuario, solo un administrador puede gestionarla.</em>
<?php endif; ?>
</p>
<legend>Datos principales</legend>
<fieldset class="margined">
	<p>Razón social: <strong><?= $company->getName() ?></strong></p>
	<p>Dirección: <strong><?= $company->getAddress() ?></strong></p>
	<p>RC (en pesos): <strong>$<?= $company->getLiability() ?></strong></p>
</fieldset>
<legend>Impuestos para coberturas</legend>
<fieldset class="margined">
	<p>% si es Consumidor final: <strong><?= $company->getTaxMono() ?>%</strong></p>
	<p>% si es Monotributo: <strong><?= $company->getLiability() ?>%</strong></p>
	<p>% si es Responsable inscripto: <strong><?= $company->getTaxResp() ?>%</strong></p>
</fieldset>
<legend>Comisiones y descuentos</legend>
<fieldset class="margined">
	<p>Porcentaje de comisión para productores: <strong><?= $company->getComission() ?>%</strong></p>
	<p>Porcentaje de descuento: <strong><?= $company->getDiscount() ?>%</strong></p>
</fieldset>
<legend>Coberturas</legend>
<?php
	$coverageTableFields = array(
		'Descripción' => 'description',
		'Tasa' => function($coverage){
			return $coverage->getRate().'%';
		},
	);
		
	if($this->isGranted('operation_add_by_coverage')){
		$view = $this;
		$coverageTableFields['Acción'] = function($coverage) use($view){
			return '<a class="btn" href="'.$view->url('operation_add_by_coverage', array('coverageId' => $coverage->getId())).'"><i class="icon icon-plus"></i> Añadir operación</a>';
		};
	}
?>
<?= $this->partial('Entity:_table', array(
	'entities' => $company->getCoverages(),
	'fields' => $coverageTableFields
)); ?>
