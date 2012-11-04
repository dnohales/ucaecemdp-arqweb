<table class="table tablesorter<?= isset($class)? " $class":'' ?>">
	<thead>
	<tr>
		<th>#</th>
		<?php foreach(array_keys($fields) as $f): ?>
			<th><?= $f ?></th>
		<?php endforeach; ?>
	</tr>
	</thead>
	<tbody>
	<?php if($entities->isEmpty()): ?>
		<tr><td colspan="<?= count($fields) + 1 ?>">No hay resultados disponibles</td></tr>
	<?php else: ?>
		<?php foreach($entities as $e): ?>
		<tr>
			<td><?= $e->getId() ?></td>
			<?php foreach(array_values($fields) as $n => $p): ?>
				<td>
					<?php 
					if($p instanceof \Closure){
						$p = $p($e);
					} else {
						$p = $e->{"get$p"}();
					}
					?>
					<?php if($n == 0 && isset($detailRoute)): ?>
						<a href="<?= $this->url($detailRoute, array('id' => $e->getId())) ?>"><?= $p ?></a>
					<?php else: ?>
						<?= $p ?>
					<?php endif; ?>
				</td>
			<?php endforeach; ?>
		</tr>
		<?php endforeach; ?>
	<?php endif; ?>
	</tbody>
</table>
<?= $this->partial('Base:_pager') ?>