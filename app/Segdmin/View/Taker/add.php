<?php $this->extend('Base:full') ?>

<?php $this->parentBlockPrepending('title', 'Agregar nuevo cliente - '); ?>

<?php $this->block('content') ?>
<h1>Agregar nuevo cliente</h1>

<form name="addTaker" action="<?= $this->currentUri() ?>" method="post">
	<?php if($this->user()->getProducer() === null): ?>
		<label>Productor</label>
		<select name="producerId" required>
			<option value="">Seleccione...</option>
			<?php foreach($producers as $p): ?>
				<option value="<?= $p->getId() ?>"><?= $p->getId().': '.$p->getFullName() ?></option>
			<?php endforeach; ?>
		</select>
	<?php endif ?>
	<?= $this->partial('Taker:_form', array('taker' => $taker)) ?>
    <div class="button-list">
        <button class="btn btn-success" type="submit">Agregar cliente</button>
    </div>
</form>
<?php $this->endBlock() ?>
