<fieldset class="margined">
	<legend>Datos principales</legend>
	<label>Razón social</label>
	<input value="<?= $company->getName() ?>" name="name" type="text" required="required" />
	<label>Dirección</label>
	<input value="<?= $company->getAddress() ?>" name="address" type="text" required="required" />
	<label>RC (en pesos)</label>
	<input value="<?= $company->getLiability() ?>" name="liability" type="number" required="required" />
</fieldset>
<fieldset class="margined">
	<legend>Impuestos para coverturas</legend>
	<label>% si es Consumidor final</label>
	<input value="<?= $company->getTaxEnd() ?>" name="taxEnd" type="number" required="required" />
	<label>% si es Monotributo</label>
	<input value="<?= $company->getTaxMono() ?>" name="taxMono" type="number" required="required" />
	<label>% si es Responsable inscripto</label>
	<input value="<?= $company->getTaxResp() ?>" name="taxResp" type="number" required="required" />
</fieldset>
<fieldset class="margined">
	<legend>Comisiones y descuentos</legend>
	<label>Porcentaje de comisión para productores</label>
	<input value="<?= $company->getComission() ?>" name="comission" type="number" required="required" />
	<label>Porcentaje de descuento</label>
	<input value="<?= $company->getDiscount() ?>" name="discount" type="number" required="required" />
</fieldset>