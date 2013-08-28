<?php $this->extend('Base:full') ?>

<?php $this->block('js') ?>
	<?= $this->parentBlock() ?>
	<script type="text/javascript" src="<?= $this->asset('js/operation-answer.js') ?>"></script>
<?php $this->endBlock() ?>

<?php $this->block('content') ?>
<h1>Operaciones</h1>
<?= $this->partial('Entity:_genericIndex', array(
	'addRoute' => 'operation_add',
	'entities' => $operations,
	'fields' => $tableFields,
)); ?>
<div id="operation_answer_dialog" title="Aprobar/Rechazar cobertura">
	
</div>
<?php $this->endBlock() ?>