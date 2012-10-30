<?php $this->extend('Base:full') ?>

<?php $this->block('title'); ?>
Agregar nuevo cliente - 
<?php echo $this->parentBlock();
$this->endBlock() ?>

<?php $this->block('content') ?>
<h1>Agregar nuevo cliente</h1>

<form name="addTaker" action="<?= $this->currentUri() ?>" method="post">
	<?= $this->partial('Taker:_form') ?>
    <div class="button-list">
        <button class="btn btn-success" type="submit">Agregar tomador</button>
    </div>
</form>
<?php $this->endBlock() ?>
