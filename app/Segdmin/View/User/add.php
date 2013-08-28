<?php $this->extend('Base:full') ?>

<?php $this->block('js') ?>
	<?= $this->parentBlock() ?>
	<script type="text/javascript" src="<?= $this->asset('js/user.js') ?>"></script>
<?php $this->endblock() ?>

<?php $this->block('content') ?>
<h1>Añadiendo usuario</h1>

<div class="alert alert-info">
	Tenga en cuenta que luego de crear el usuario, lo único que podrá modificar
	es su contraseña o en caso de ser un administrador, su nombre y apellido.
</div>

<form id="form" action="<?= $this->currentUri() ?>" method="post">
	<?= $this->partial('User:_formAdd', array('user' => $user)) ?>
	<div class="button-list">
		<button type="submit" class="btn btn-success">Crear usuario</button>
	</div>
</form>
<?php $this->endBlock() ?>