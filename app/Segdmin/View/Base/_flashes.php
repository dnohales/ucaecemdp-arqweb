<?php if($this->session()->hasFlash('error')): ?>
	<div class="alert alert-error">
		<?= $this->session()->getFlash('error'); ?>
	</div>
<?php endif; ?>
<?php if($this->session()->hasFlash('success')): ?>
	<div class="alert alert-success">
		<?= $this->session()->getFlash('success'); ?>
	</div>
<?php endif; ?>
<?php if($this->session()->hasFlash('warning')): ?>
	<div class="alert alert-warning">
		<?= $this->session()->getFlash('warning'); ?>
	</div>
<?php endif; ?>
<?php if($this->session()->hasFlash('info')): ?>
	<div class="alert alert-info">
		<?= $this->session()->getFlash('info'); ?>
	</div>
<?php endif; ?>

