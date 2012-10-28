<p>
<?php if($entity->getUser()): ?>
	Usuario: <strong><?= $entity->getUser()->getEmail() ?></strong>
	&nbsp;<a href="#" title="Editar usuario" class="btn"><i class="icon icon-pencil"></i></a>
<?php else: ?>
	Usuario: <em>Está compañía no posee un usuario, solo un administrador puede gestionarla.</em>
<?php endif; ?>
</p>
<legend>Datos principales</legend>
<fieldset class="margined">
	<p>Razón social: <strong><?= $entity->getName() ?></strong>
	<p>Dirección: <strong><?= $entity->getAddress() ?></strong>
	<p>RC (en pesos): <strong>$<?= $entity->getLiability() ?></strong>
</fieldset>
<legend>Impuestos para coberturas</legend>
<fieldset class="margined">
	<p>% si es Consumidor final: <strong><?= $entity->getTaxMono() ?>%</strong>
	<p>% si es Monotributo: <strong><?= $entity->getLiability() ?>%</strong>
	<p>% si es Responsable inscripto: <strong><?= $entity->getTaxResp() ?>%</strong>
</fieldset>
<legend>Comisiones y descuentos</legend>
<fieldset class="margined">
	<p>Porcentaje de comisión para productores: <strong><?= $entity->getComission() ?>%</strong>
	<p>Porcentaje de descuento: <strong><?= $entity->getDiscount() ?>%</strong>
</fieldset>
<legend>Coberturas</legend>
<table class="table">
	<tr>
		<th>#</th>
		<th>Descripción</th>
		<th>Taza</th>
	</tr>
	<?php $coverages = $entity->getCoverages() ?>
	<?php if($coverages->isEmpty()): ?>
		<tr><td colspan="3">No hay ninguna cobertura</td></tr>
	<?php else: ?>
		<?php foreach($coverages as $c): ?>
		<tr>
			<td><?= $c->getId() ?></td>
			<td><a href="<?= $this->url('coverage_detail', array('id' => $c->getId())) ?>"><?= $c->getDescription() ?></a></td>
			<td><?= $c->getRate() ?></td>
		</tr>
		<?php endforeach; ?>
	<?php endif; ?>
</table>