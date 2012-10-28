<h1><?= $title ?></h1>

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
	<table class="table">
		<tr>
			<th>#</th>
			<?php foreach(array_keys($fields) as $f): ?>
				<th><?= $f ?></th>
			<?php endforeach; ?>
		</tr>
		<?php if($entities->isEmpty()): ?>
			<tr><td colspan="<?= count($fields) + 1 ?>">No hay resultados disponibles</td></tr>
		<?php else: ?>
			<?php foreach($entities as $e): ?>
			<tr>
				<td><?= $e->getId() ?></td>
				<?php foreach(array_values($fields) as $n => $p): ?>
					<td>
						<?php if($n == 0): ?>
							<a href="<?= $this->url($detailRoute, array('id' => $e->getId())) ?>"><?= $e->{"get$p"}() ?></a>
						<?php else: ?>
							<?= $e->{"get$p"}() ?>
						<?php endif; ?>
					</td>
				<?php endforeach; ?>
			</tr>
			<?php endforeach; ?>
		<?php endif; ?>
	</table>
</div>
