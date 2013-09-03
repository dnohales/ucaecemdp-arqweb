<?php $this->extend('Base:full') ?>

<?php $this->block('content') ?>
	<?= $this->partial('Operation:_detail', array(
		'operation' => $operation
	)); ?>
<?php $this->endBlock() ?>

