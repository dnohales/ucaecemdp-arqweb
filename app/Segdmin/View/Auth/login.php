<?php $this->extend('Base:nomenu'); ?>

<?php $this->block('title'); ?>Iniciar Sesión - <?php echo $this->parentBlock(); $this->endBlock() ?>

<?php $this->block('css') ?>
	<?php echo $this->parentBlock() ?>
	<link rel="stylesheet" type="text/css" href="<?php echo $this->asset('css/login.css') ?>" />
<?php $this->endBlock() ?>

<?php $this->block('maincontent') ?>
<div class="login-container">
	<h1>Iniciar sesión en Segdmin</h1>
	<?php if($error): ?>
		<div class="alert alert-error">
			<?= $error ?>
		</div>
	<?php endif; ?>
	<form method="post" action="<?php echo $this->currentUri(true) ?>">
		<input class="fullwidth" value="<?= $lastEmail ?>" name="email" type="text" placeholder="Correo electrónico" />
		<input class="fullwidth" name="password" type="password" placeholder="Contraseña" />
		<div class="login-buttons">
			<div>
				<label class="checkbox">
					<input type="checkbox" name="rememberMe" />
					Mantener sesión abierta por 7 días
				</label>
			</div>
			<div>
				<button class="btn btn-primary" type="submit">Iniciar Sesión</button>
			</div>
		</div>
		
		<div class="clearfix"></div>
	</form>
</div>
<?php $this->endBlock() ?>
