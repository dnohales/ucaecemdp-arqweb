<?php
use Segdmin\Model\Operation;
/* @var $operation \Segdmin\Model\Operation */
?>
<p>Estado: <strong><?php
switch ($operation->getAcceptedState())
{
case Operation::STATE_PENDING:
	echo 'Pendiente';
	break;

case Operation::STATE_REJECTED:
	echo 'Rechazado';
	break;

case Operation::STATE_ACCEPTED:
	echo 'Aceptado';
	break;
}
?></strong></p>
<legend>Información del tomador</legend>
<fieldset class="margined">
	<p>Cliente: <strong><?= $operation->getTaker()->getFullName() ?></strong></p>
	<p>Datos de la unidad: <pre><?= $operation->getData() ?></pre></p>
	<p>Modelo: <strong><?= $operation->getModel() ?></strong></p>
	<p>Suma asegurada (en pesos): <strong>$<?= $operation->getInsured() ?></strong></p>
	<p>Fecha de solicitud: <strong>$<?= $operation->getCreationTime()->format('d/m/Y') ?></strong></p>
</fieldset>
<legend>Información de la cobertura</legend>
<fieldset class="margined">
	<?php if ($operation->getCoverage()->getCompany() !== $this->user()->getCompany()): ?>
		<p>Compañía aseguradora: <strong><?= $operation->getCoverage()->getCompany()->getName() ?></strong></p>
	<?php endif; ?>
	<p>Cobertura: <strong><?= $operation->getCoverage()->getDescription() ?></strong></p>
	<p>Porcentaje de disminución de comisión: <strong><?= $operation->getCoverage()->getCompany()->getComission() ?>%</strong></p>
	<p>Costo total: <strong>$<?= $operation->getTotalCost() ?></strong></p>
</fieldset>