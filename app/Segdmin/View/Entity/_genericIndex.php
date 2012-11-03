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
			<a href="<?= $this->url($addRoute) ?>" class="btn btn-success"><i class="icon-plus-sign icon-white"></i> Añadir</a>
		</div>
	</header>
	<div class="clearfix"></div>
	<?= $this->partial('Entity:_table', array(
		'entities' => $entities,
		'detailRoute' => $detailRoute,
		'fields' => $fields
	)) ?>
</div>
