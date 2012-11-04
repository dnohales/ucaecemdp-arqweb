<div class="form-row">
	<label>Descripción</label>
	<input value="<?= $coverage->getDescription() ?>" type="text" name="description" required />
</div>
<div class="form-row">
	<label>Porcentaje de la tasa</label>
	<input value="<?= $coverage->getRate() ?>" type="text" name="rate" pattern="[0-9]+(\.[0-9]+)?" data-custom-validity="Debe ingresar un número decimal" required />
</div>
