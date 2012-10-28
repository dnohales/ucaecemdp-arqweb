<?php $this->block('content') ?>
<legend>Datos personales</legend>
<fieldset class="margined">
	<label>Nombre</label>
	<input value="<?= $entity->getName() ?>" name="name" type="text" required />
	<label>Apellido</label>
	<input value="<?= $entity->getAddress() ?>" name="lastName" type="text" required />
	<label>DNI</label>
	<input value="<?= $entity->getDni() ?>" name="dni" type="text" required />
	<label>Dirección</label>
	<input value="<?= $entity->getAddress() ?>" name="address" type="text" required />
	<label>Teléfonos</label>
	<input value="<?= $entity->getPhones() ?>" name="phones" type="text" required />
</fieldset>
<?php $this->endBlock() ?>
