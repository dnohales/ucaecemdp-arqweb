<?php $this->extend('Base:full') ?>

<?php $this->block('content') ?>
<h1>Añadiendo compañía</h1>

<form action="<?= $this->currentUri() ?>" method="post">
	<fieldset class="margined">
		<legend>Datos principales</legend>
		<label>Razón social</label>
		<input name="name" type="text" required="required" />
		<label>Dirección</label>
		<input name="address" type="text" required="required" />
		<label>RC (en pesos)</label>
		<input name="liability" type="number" required="required" />
	</fieldset>
	<fieldset class="margined">
		<legend>Impuestos para coverturas</legend>
		<label>% si es Consumidor final</label>
		<input name="taxEnd" type="number" required="required" />
		<label>% si es Monotributo</label>
		<input name="taxMono" type="number" required="required" />
		<label>% si es Responsable inscripto</label>
		<input name="taxResp" type="number" required="required" />
	</fieldset>
	<fieldset class="margined">
		<legend>Comisiones y descuentos</legend>
		<label>Porcentaje de comisión para productores</label>
		<input name="comission" type="number" required="required" />
		<label>Porcentaje de descuento</label>
		<input name="discount" type="number" required="required" />
	</fieldset>
	<button type="submit" class="btn btn-success">Crear compañía</button>
</form>
<?php $this->endBlock() ?>