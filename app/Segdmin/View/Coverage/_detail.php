<?php $this->extend('Entity:_genericDetail') ?>

<?php $this->block('left_buttons') ?>
<?php if($this->isGranted('operation_add_by_coverage')): ?>
<a class="btn pull-right" href="<?= $this->url('operation_add_by_coverage', array('coverageId' => $entity->getId())) ?>"><i class="icon icon-plus"></i> Añadir operación</a>
<?php endif; ?>
<?php $this->endBlock() ?>