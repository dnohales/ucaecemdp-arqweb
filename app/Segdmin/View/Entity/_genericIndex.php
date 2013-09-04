<?php $tableClass = isset($tableClass)? $tableClass:'' ?>
<?php $detailRoute = isset($detailRoute)? $detailRoute:null ?>

<?php if(isset($title)): //TODO: BC El título no tendría que ir ?>
	<h1><?= $title ?></h1>
<?php endif ?>

<div class="pull-right">
	<?php if($this->isGranted($addRoute)): ?>
		<a href="<?= $this->url($addRoute) ?>" class="btn btn-success"><i class="icon-plus-sign icon-white"></i> Añadir</a>
	<?php endif; ?>
</div>

<div class="entity-table-container clearfix">
	<?= $this->partial('Entity:_table', array(
		'entities' => $entities,
		'detailRoute' => $detailRoute,
		'fields' => $fields,
		'class' => $tableClass,
		'trClosure' => isset($trClosure)? $trClosure:function() { return ''; }
	)) ?>
</div>
