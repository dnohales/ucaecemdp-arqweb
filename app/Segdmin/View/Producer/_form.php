<?php $this->block('content') ?>
<legend>Datos personales</legend>
<fieldset class="margined">
	<label>Nombre</label>
	<input value="<?= $producer->getName() ?>" name="name" type="text" required />
	<label>Apellido</label>
	<input value="<?= $producer->getAddress() ?>" name="lastName" type="text" required />
	<label>DNI</label>
	<input value="<?= $producer->getDni() ?>" name="dni" type="text" required />
	<label>Dirección</label>
	<input value="<?= $producer->getAddress() ?>" name="address" type="text" required />
	<label>Teléfonos</label>
	<input value="<?= $producer->getPhones() ?>" name="phones" type="text" required />
</fieldset>
<?php $this->endBlock() ?>
