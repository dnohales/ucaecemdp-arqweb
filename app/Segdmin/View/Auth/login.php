<?php $this->extend(':base') ?>

<?php $this->block('title'); ?>Iniciar Sesión - <?php echo $this->parentBlock(); $this->endBlock() ?>

<?php $this->block('body') ?>
<div class="login-container">
	<form action="<?php echo $this->url('login') ?>"></form>
</div>
<?php $this->endBlock() ?>
