<?php $this->extend('Base:full') ?>

<?php $this->block('js') ?>
	<?= $this->parentBlock() ?>
	<script type="text/javascript" src="<?= $this->asset('js/user.js') ?>"></script>
<?php $this->endblock() ?>

<?php $this->block('content') ?>
<h1>Añadiendo usuario</h1>

<form id="form" action="<?= $this->currentUri() ?>" method="post">
	<?= $this->partial('User:_form', array('user' => $user)) ?>
	<div class="button-list">
		<button type="submit" class="btn btn-success">Crear usuario</button>
	</div>
</form>
<?php $this->endBlock() ?>