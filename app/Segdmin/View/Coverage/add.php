<?php $this->extend('Base:full') ?>

<?php $this->parentBlockPrepending('title', 'Agregar nueva cobertura - ') ?>

<?php $this->block('content') ?>
<h1>Agregar nueva cobertura</h1>

<form action="<?= $this->currentUri() ?>" method="post">
	<label>Compañía</label>
	<select name="companyId" required>
		<option value="">Seleccione...</option>
		<?php foreach($companies as $c): ?>
			<option value="<?= $c->getId() ?>"><?= $c->getId().': '.$c->getName() ?></option>
		<?php endforeach; ?>
	</select>
	<label>Descripcion</label>
	<input type="text" name="description" required />
	<label>Porcentaje de la tasa</label>
	<input type="text" name="rate" required />
	<div class="button-list">
		<button type="submit" class="btn btn-success">Crear cobertura</button>
	</div>
</form>
<?php $this->endBlock() ?>