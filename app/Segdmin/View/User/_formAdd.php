<?php use Segdmin\Framework\Security\Roles; ?>
<?= $this->partial('Entity:_singleUserForm') ?>
<?php if(!$user->isSuperUser()): ?>
<div class="form-row">
	<label>Rol</label>
	<select name="rol" required>
		<option value="">Seleccione...</option>
		<option value="<?= Roles::ADMIN ?>">Administrador</option>
		<option value="<?= Roles::PRODUCER ?>">Productor</option>
		<option value="<?= Roles::COMPANY ?>">Compañía</option>
	</select>
</div>
<div id="user_admin_container">
	<div class="form-row">
		<label>Nombre</label>
		<input value="<?= $user->getAdmin() !== null? $user->getAdmin()->getName():'' ?>" name="admin[name]" type="text" />
	</div>
	<div class="form-row">
		<label>Apellido</label>
		<input value="<?= $user->getAdmin() !== null? $user->getAdmin()->getLastName():'' ?>" name="admin[lastName]" type="text" />
	</div>
</div>
<div id="user_producer_container">
	<div class="form-row">
		<label>Productor</label>
		<select name="producerId">
			<?= $this->html()->options(
					$this->app()->getOrm()->getRepository('Producer')->findAll(),
					$user->getProducer(),
					function($p){
						return $p->getId().': '.$p->getFullName();
					}
				);
			?>
		</select>
	</div>
</div>
<div id="user_company_container">
	<div class="form-row">
		<label>Compañía</label>
		<select name="companyId">
			<?= $this->html()->options(
					$this->app()->getOrm()->getRepository('Company')->findAll(),
					$user->getCompany(),
					function($c){
						return $c->getId().': '.$c->getName();
					}
				);
			?>
		</select>
	</div>
</div>
<?php endif; ?>
