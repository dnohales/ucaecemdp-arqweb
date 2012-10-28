<?php $this->extend('Base:full') ?>

<?php $this->block('content') ?>
<h1>Compañías aseguradoras</h1>

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
			<a href="<?= $this->url('company_add') ?>" class="btn btn-success" type="submit"><i class="icon-plus-sign icon-white"></i> Añadir compañía</a>
		</div>
	</header>
	<div class="clearfix"></div>
	<table class="table">
		<tr>
			<th>#</th>
			<th>Razón social</th>
			<th>Dirección</th>
		</tr>
		<?php if($companies->isEmpty()): ?>
			<tr><td colspan="3">No hay ninguna compañía en el sistema</td></tr>
		<?php else: ?>
			<?php foreach($companies as $c): ?>
			<tr>
				<td><?= $c->getId() ?></td>
				<td><a href="<?= $this->url('company_detail', array('id' => $c->getId())) ?>"><?= $c->getName() ?></a></td>
				<td><?= $c->getAddress() ?></td>
			</tr>
			<?php endforeach; ?>
		<?php endif; ?>
	</table>
</div>
<?php $this->endBlock() ?>