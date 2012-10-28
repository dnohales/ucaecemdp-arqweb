<?php $readOnly = isset($readOnly)? $readOnly:false; ?>

<h1><?= $title ?></h1>

<div class="entity-detail">
	<div class="entity-show">
		<div class="pull-right">
			<form method="post" action="<?= $this->url($removeRoute, array('id' => $entity->getId())) ?>" class="form-inline entity-formdelete">
				<button type="button" class="btn entity-editbutton"><i class="icon icon-pencil"></i> Editar</button>
				<button type="submit" class="btn btn-danger"><i class="icon icon-remove icon-white"></i> Eliminar</button>
			</form>
		</div>
		<div class="clearfix"></div>
		<div class="entity-show-data">
			<?= $this->partial($showView, array('entity' => $entity)) ?>
		</div>
	</div>

	<div class="entity-edit hide">
		<form action="<?= $this->currentUri() ?>" method="post">
			<?= $this->partial($editView, array('entity' => $entity)) ?>
			<div class="button-list">
				<button type="button" class="btn entity-canceledit">Cancelar</button>
				<button type="submit" class="btn btn-primary">Guardar cambios</button>
			</div>
		</form>
	</div>
</div>
