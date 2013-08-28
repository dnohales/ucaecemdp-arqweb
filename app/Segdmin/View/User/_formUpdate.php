<?php
use Segdmin\Model\Admin;

$relatedEntity = $user->getRelatedEntity();
?>

<?= $this->partial('User:_show', array('user' => $user)); ?>
<?= $this->partial('User:_password', array('isUpdating' => true)); ?>
<?php if($relatedEntity instanceof Admin): ?>
	<div class="form-row">
		<label>Nombre</label>
		<input value="<?= $user->getAdmin() !== null? $user->getAdmin()->getName():'' ?>" name="admin[name]" type="text" />
	</div>
	<div class="form-row">
		<label>Apellido</label>
		<input value="<?= $user->getAdmin() !== null? $user->getAdmin()->getLastName():'' ?>" name="admin[lastName]" type="text" />
	</div>
<?php endif; ?>
