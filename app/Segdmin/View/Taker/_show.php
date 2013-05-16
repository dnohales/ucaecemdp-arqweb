<?php if($this->user()->getProducer() === null): ?>
<p>
	Productor: <strong><?= $taker->getProducer()->getFullName() ?></strong>
</p>
<?php endif; ?>
<legend>Datos Personales</legend>
<fieldset class="margined">
	<p>Nombre: <strong><?= $taker->getName() ?></strong></p>
	<p>Apellido: <strong><?= $taker->getLastName() ?></strong></p>
	<p>CUIT: <strong><?= $taker->getCuit() ?></strong></p>
	<p>DNI: <strong><?= $taker->getDni() ?></strong></p>
	<p>Fecha de nacimiento: <strong><?= $taker->getBirth()->format('d/m/Y') ?></strong></p>
	<p>Dirección: <strong><?= $taker->getAddress() ?></strong></p>
	<p>Correo electrónico: <a href="mailto:<?= $taker->getEmail() ?>"><?= $taker->getEmail() ?></a></p>
	<p>Teléfonos: <strong><?= $taker->getPhones() ?></strong></p>
	<p>Situación impositiva: <strong><?= $taker->getSituationAsString() ?></strong></p>
</fieldset>
