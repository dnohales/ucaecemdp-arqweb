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
	'trClosure' => function($operation) {
		return 'id="operation_table_row_'.$operation->getId().'"';
	}
)); ?>
<div id="operation_answer_dialog" title="Aprobar/Rechazar cobertura">
	<article></article>
	<footer>
		<div class="pull-left">
			<button class="btn button-cancel" href="#" >Cancelar</button>
		</div>
		<div class="pull-right">
			<button class="btn btn-danger button-reject"><i class="icon icon-remove"></i> Rechazar</button>
			<button class="btn btn-success button-accept"><i class="icon icon-ok"></i> Aprobar</button>
		</div>
	</footer>
	<div class="loading"></div>
</div>
<?php $this->endBlock() ?>