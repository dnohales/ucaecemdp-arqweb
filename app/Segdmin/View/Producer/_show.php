<p>
	Usuario: <strong><?= $entity->getUser()->getEmail() ?></strong>
	&nbsp;<a href="#" title="Editar usuario" class="btn"><i class="icon icon-pencil"></i></a>
</p>
<legend>Datos Personales</legend>
<fieldset class="margined">
	<p>Nombre: <strong><?= $entity->getName() ?></strong>
	<p>Apellido: <strong><?= $entity->getLastName() ?></strong>
	<p>DNI: <strong><?= $entity->getDni() ?></strong>
	<p>Dirección: <strong><?= $entity->getAddress() ?></strong>
	<p>Teléfonos: <strong><?= $entity->getPhones() ?></strong>
</fieldset>
