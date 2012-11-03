<?php if($this->user()->getProducer() === null): ?>
<p>
	Productor: <strong><?= $taker->getProducer()->getFullName() ?></strong>
</p>
<?php endif; ?>
<legend>Datos Personales</legend>
<fieldset class="margined">
	<p>Nombre: <strong><?= $taker->getName() ?></strong>
	<p>Apellido: <strong><?= $taker->getLastName() ?></strong>
	<p>CUIT: <strong><?= $taker->getCuit() ?></strong>
	<p>DNI: <strong><?= $taker->getDni() ?></strong>
	<p>Fecha de nacimiento: <strong><?= $taker->getBirth()->format('d/m/Y') ?></strong>
	<p>Dirección: <strong><?= $taker->getAddress() ?></strong>
	<p>Correo electrónico: <a href="mailto:<?= $taker->getEmail() ?>"><?= $taker->getEmail() ?></a>
	<p>Teléfonos: <strong><?= $taker->getPhones() ?></strong>
	<p>Situación impositiva: <strong><?= $taker->getSituationAsString() ?></strong>
</fieldset>
