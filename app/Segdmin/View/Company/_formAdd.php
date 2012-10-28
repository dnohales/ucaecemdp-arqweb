<?php $this->extend('Company:_form') ?>

<?php $this->block('content') ?>
<legend>Información de acceso</legend>
<fieldset class="margined">
	<?= $this->partial('Entity:_singleUserForm') ?>
</fieldset>
<?= $this->parentBlock() ?>
<?php $this->endBlock() ?>
