<?php $this->block('content') ?>
<legend>Información del tomador</legend>
<fieldset class="margined">
	<div class="form-row">
		<label>Cliente</label>
		<select name="takerId" required>
			<?= $this->html()->options(
					$this->app()->getOrm()->getRepository('Taker')->findAll(),
					$operation->getTaker(),
					function($t){
						return $t->getId().': '.$t->getFullName();
					}
				);
			?>
		</select>
	</div>
	<div class="form-row">
		<label>Datos de la unidad</label>
		<textarea name="data" required><?= $operation->getData() ?></textarea>
	</div>
	<div class="form-row">
		<label>Modelo</label>
		<select name="model" required>
			<option value="">Seleccione...</option>
			<?php $today = new \DateTime('today'); ?>
			<?php foreach(range(((int)$today->format('Y'))-15, (int)$today->format('Y')) as $n): ?>
			<option value="<?= $n ?>"><?= $n ?></option>
			<?php endforeach; ?>
		</select>
	</div>
	<div class="form-row">
		<label>Suma asegurada (en pesos)</label>
		<input value="<?= $operation->getInsured() ?>" name="insured" type="text" pattern="[0-9]+(\.[0-9]+)?" data-custom-validity="Debe ingresar un número decimal" required />
	</div>
</fieldset>
<legend>Información de la cobertura</legend>
<fieldset class="margined">
	<div class="form-row">
		<label>Compañía aseguradora</label>
		<select name="companyId" required>
			<?= $this->html()->options(
					$this->app()->getOrm()->getRepository('Company')->findAll(),
					$operation->getCoverage() !== null? $operation->getCoverage()->getCompany():null,
					function($t){
						return $t->getId().': '.$t->getName();
					}
				);
			?>
		</select>
	</div>
	<div class="form-row">
		<label>Cobertura</label>
		<select name="coverageId" required<?= $operation->getCoverage() === null? ' disabled':'' ?>>
			<?php if($operation->getCoverage() !== null): ?>
			<?= $this->html()->options(
					$this->app()->getOrm()->getRepository('Coverage')->findAllBy(array(
						'companyId' => $operation->getCoverage()->getCompany()->getId()
					)),
					$operation->getCoverage(),
					function($t){
						return $t->getId().': '.$t->getDescription();
					}
				);
			?>
			<?php endif; ?>
		</select>
	</div>
	<div class="form-row">
		<label>Porcentaje de disminución de comisión</label>
		<input value="<?= $operation->getCoverage() !== null? $operation->getCoverage()->getCompany()->getComission():'' ?>" name="comission" type="text" pattern="[0-9]+(\.[0-9]+)?" data-custom-validity="Debe ingresar un número decimal" required<?= $operation->getCoverage() === null? ' disabled':'' ?> />
	</div>
	<div class="form-row">
		<p>Costo final del seguro:
		<span class="operation-total error">
		<?php if($operation->isTotalCostCalculable()): ?>
			$<?= $operation->getTotalCost() ?>
		<?php else: ?>
			Algunos campos no están completos o son incorrectos
		<?php endif; ?>
		</span>
		</p>
	</div>
</fieldset>
<?php $this->endBlock() ?>
