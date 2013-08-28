<?php $tableClass = isset($tableClass)? $tableClass:'' ?>
<?php $detailRoute = isset($detailRoute)? $detailRoute:null ?>

<?php if(isset($title)): //TODO: BC El título no tendría que ir ?>
	<h1><?= $title ?></h1>
<?php endif ?>

<div class="entity-table-container">
	<header>
		<div>
			<form onsubmit="return false;">
				<div class="input-prepend">
					<span class="add-on"><i class="icon-filter"></i></span>
					<input type="text" placeholder="Filtrar" />
				</div>
			</form>
		</div>
		<div>
		<?php if($this->isGranted($addRoute)): ?>
			<a href="<?= $this->url($addRoute) ?>" class="btn btn-success"><i class="icon-plus-sign icon-white"></i> Añadir</a>
		<?php endif; ?>
		</div>
	</header>
	<div class="clearfix"></div>
	<?= $this->partial('Entity:_table', array(
		'entities' => $entities,
		'detailRoute' => $detailRoute,
		'fields' => $fields,
		'class' => $tableClass
	)) ?>
</div>
