<?php use Segdmin\Model\Taker ?>

<legend>Datos Personales</legend>
<fieldset class="margined">
	<div class="form-row">
		<label for="name">Nombre</label>
		<input value="<?= $taker->getName() ?>" type="text" name="name" required />
	</div>
	<div class="form-row">
		<label for="lastname">Apellido</label>
		<input value="<?= $taker->getLastName() ?>" type="text" name="lastName" required />
	</div>
	<div class="form-row">
		<label for="dni">DNI</label>
		<input value="<?= $taker->getDni() ?>" type="text" name="dni" pattern="[0-9]{8}" data-custom-validity="Debe ingresar únicamente números en este campo" required />
	</div>
	<div class="form-row">
		<label for="cuit">CUIT</label>
		<input value="<?= $taker->getCuit() ?>" type="text" name="cuit" required />
	</div>
	<div class="form-row">
		<label for="birth">Fecha de nacimiento</label>
		<input value="<?= $taker->getBirth() !== null? $taker->getBirth()->format('d/m/Y'):'' ?>" class="date" type="text" name="birth" data-custom-validity="El formato de la fecha (dd/mm/aaaa) no es válido" required />
	</div>
	<div class="form-row">
		<label for="address">Dirección</label>
		<input value="<?= $taker->getAddress() ?>" type="text" name="address" required />
	</div>
	<div class="form-row">
		<label for="email">Correo electrónico</label>
		<input value="<?= $taker->getEmail() ?>" type="email" name="email" required />
	</div>
	<div class="form-row">
		<label for="phones">Teléfonos</label>
		<input value="<?= $taker->getPhones() ?>" type="text" name="phones" required />
	</div>
	<div class="form-row">
		<label for="situation">Situación impositiva</label>
		<select name="situation" required>
			<?php if($taker->getSituation() === null): ?>
				<option value="" selected>Seleccione...</option>
			<?php endif; ?>
			<option value="<?= Taker::COND_FINALCONSUMER ?>"<?= $taker->getSituation() === Taker::COND_FINALCONSUMER? ' selected':'' ?>>Consumidor final</option>
			<option value="<?= Taker::COND_MONO ?>"<?= $taker->getSituation() === Taker::COND_MONO? ' selected':'' ?>>Monotributista</option>
			<option value="<?= Taker::COND_REGRESPONSIBLE ?>"<?= $taker->getSituation() === Taker::COND_REGRESPONSIBLE? ' selected':'' ?>>Responsable inscripto</option>
		</select>
	</div>
</fieldset>