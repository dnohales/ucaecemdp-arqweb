<?php $this->block('content') ?>
<legend>Datos personales</legend>
<fieldset class="margined">
	<div class="form-row">
		<label>Nombre</label>
		<input value="<?= $producer->getName() ?>" name="name" type="text" required />
	</div>
	<div class="form-row">
		<label>Apellido</label>
		<input value="<?= $producer->getAddress() ?>" name="lastName" type="text" required />
	</div>
	<div class="form-row">
		<label>DNI</label>
		<input value="<?= $producer->getDni() ?>" name="dni" type="text" required />
	</div>
	<div class="form-row">
		<label>Dirección</label>
		<input value="<?= $producer->getAddress() ?>" name="address" type="text" required />
	</div>
	<div class="form-row">
		<label>Teléfonos</label>
		<input value="<?= $producer->getPhones() ?>" name="phones" type="text" required />
	</div>
</fieldset>
<?php $this->endBlock() ?>
