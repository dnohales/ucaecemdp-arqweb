<?php $this->extend('Base:full') ?>

<?php $this->block('content') ?>
<h1>Añadiendo compañía</h1>

<form id="form" action="<?= $this->currentUri() ?>" method="post">
	<?= $this->partial('Company:_formAdd', array('company' => $company)) ?>
	<div class="button-list">
		<button type="submit" class="btn btn-success">Crear compañía</button>
	</div>
</form>
<?php $this->endBlock() ?>