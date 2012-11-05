<?php $this->extend('Base:full') ?>

<?php $this->block('js') ?>
	<?= $this->parentBlock() ?>
	<script type="text/javascript" src="<?= $this->asset('js/operations.js') ?>"></script>
<?php $this->endBlock() ?>

<?php $this->parentBlockPrepending('title', 'Agregar nueva operación - ') ?>

<?php $this->block('content') ?>
<h1>Agregar nueva operación</h1>

<form id="operation_add_form" action="<?= $this->currentUri() ?>" method="post">
	<?= $this->partial('Operation:_form', array(
		'operation' => $operation
	)) ?>
	<div class="button-list">
		<button type="submit" class="btn btn-success" <?= $operation->getCoverage() === null? ' disabled':'' ?>>Crear operación</button>
	</div>
</form>
<?php $this->endBlock() ?>