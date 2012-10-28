<?php $this->extend('Base:full') ?>

<?php $this->block('content') ?>
<h1>Editando compañía</h1>

<form action="<?= $this->currentUri() ?>" method="post">
	<?= $this->partial('Company:_form', array('company' => $company)) ?>
	<div class="button-list">
		<button type="submit" name="edit" class="btn btn-success">Guardar cambios</button>
		<button type="submit" name="remove" class="btn btn-danger">Eliminar compañía</button>
	</div>
</form>
<?php $this->endBlock() ?>