<?php $this->block('content') ?>
<legend>Datos principales</legend>
<fieldset class="margined">
	<label>Razón social</label>
	<input value="<?= $entity->getName() ?>" name="name" type="text" required="required" />
	<label>Dirección</label>
	<input value="<?= $entity->getAddress() ?>" name="address" type="text" required="required" />
	<label>RC (en pesos)</label>
	<input value="<?= $entity->getLiability() ?>" name="liability" type="number" required="required" />
</fieldset>
<legend>Impuestos para coverturas</legend>
<fieldset class="margined">
	<label>% si es Consumidor final</label>
	<input value="<?= $entity->getTaxEnd() ?>" name="taxEnd" type="number" required="required" />
	<label>% si es Monotributo</label>
	<input value="<?= $entity->getTaxMono() ?>" name="taxMono" type="number" required="required" />
	<label>% si es Responsable inscripto</label>
	<input value="<?= $entity->getTaxResp() ?>" name="taxResp" type="number" required="required" />
</fieldset>
<legend>Comisiones y descuentos</legend>
<fieldset class="margined">
	<label>Porcentaje de comisión para productores</label>
	<input value="<?= $entity->getComission() ?>" name="comission" type="number" required="required" />
	<label>Porcentaje de descuento</label>
	<input value="<?= $entity->getDiscount() ?>" name="discount" type="number" required="required" />
</fieldset>
<?php $this->endBlock() ?>
