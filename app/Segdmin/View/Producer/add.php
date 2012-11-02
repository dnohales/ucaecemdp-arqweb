<?php $this->extend('Base:full') ?>

<?php $this->block('content') ?>
<h1>Añadiendo compañía</h1>

<form id="form" action="<?= $this->currentUri() ?>" method="post">
	<?= $this->partial('Producer:_formAdd', array('producer' => $producer)) ?>
	<div class="button-list">
		<button type="submit" class="btn btn-success">Crear productor</button>
	</div>
</form>
<?php $this->endBlock() ?>