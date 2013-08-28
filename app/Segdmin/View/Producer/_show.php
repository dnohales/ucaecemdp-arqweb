<p>
<?php if($producer->getUser()): ?>
	Usuario: <strong><?= $producer->getUser()->getEmail() ?></strong>
	&nbsp;<a href="<?= $this->url('user_detail', array('id' => $producer->getUser()->getId())); ?>" title="Detalles del usuario" class="btn"><i class="icon icon-search"></i></a>
<?php else: ?>
	Usuario: <em>Este productor no posee un usuario, solo un administrador puede gestionarlo.</em>
<?php endif; ?>
</p>
<legend>Datos Personales</legend>
<fieldset class="margined">
	<p>Nombre: <strong><?= $producer->getName() ?></strong></p>
	<p>Apellido: <strong><?= $producer->getLastName() ?></strong></p>
	<p>DNI: <strong><?= $producer->getDni() ?></strong></p>
	<p>Dirección: <strong><?= $producer->getAddress() ?></strong></p>
	<p>Teléfonos: <strong><?= $producer->getPhones() ?></strong></p>
</fieldset>
