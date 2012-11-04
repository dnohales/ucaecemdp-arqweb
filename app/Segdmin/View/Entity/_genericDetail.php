<?php $readOnly = isset($readOnly)? $readOnly:false; ?>
<?php $canEdit = isset($canEdit)? $canEdit && !$readOnly:true; ?>
<?php $canRemove = isset($canRemove)? $canRemove && !$readOnly:$this->isGranted($removeRoute); ?>

<?php if(isset($title)): ?>
	<h1><?= $title ?></h1>
<?php endif ?>

<div class="entity-detail">
	<div class="entity-show">
		<div class="pull-right">
			<?php if($canRemove): ?>
			<form method="post" action="<?= $this->url($removeRoute, array('id' => $entity->getId())) ?>" class="form-inline entity-formdelete">
			<?php endif; ?>
			<?php if($canEdit): ?>
				<button type="button" class="btn entity-editbutton"><i class="icon icon-pencil"></i> Editar</button>
			<?php endif; ?>
			<?php if($canRemove): ?>
				<button type="submit" class="btn btn-danger"><i class="icon icon-remove icon-white"></i> Eliminar</button>
			</form>
			<?php endif; ?>
		</div>
		<div class="clearfix"></div>
		<div class="entity-show-data">
			<?= $showView ?>
		</div>
	</div>
	
	<?php if($canEdit): ?>
	<div class="entity-edit hide">
		<div class="pull-right">
			<button type="button" class="btn entity-canceledit">Cancelar</button>
		</div>
		<div class="clearfix"></div>
		<form action="<?= $this->currentUri() ?>" method="post">
			<?= $editView ?>
			<div class="button-list">
				<button type="button" class="btn entity-canceledit">Cancelar</button>
				<button type="submit" class="btn btn-primary">Guardar cambios</button>
			</div>
		</form>
	</div>
	<?php endif; ?>
</div>
