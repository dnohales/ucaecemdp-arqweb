<?php if($this->user()->getCompany() === null): ?>
<p>Compañía: <strong><?= $coverage->getCompany()->getName() ?></strong>
&nbsp;<a href="<?= $this->url('company_detail', array('id' => $coverage->getCompany()->getId())) ?>" title="Editar compañía" class="btn"><i class="icon icon-pencil"></i></a>
</p>
<?php endif; ?>
<p>Descripción: <strong><?= $coverage->getDescription() ?></strong></p>
<p>Porcentaje de la tasa: <strong><?= $coverage->getRate() ?>%</strong></p>
