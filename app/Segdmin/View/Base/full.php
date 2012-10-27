<?php $this->extend('Base:nomenu') ?>

<?php $this->block('maincontent') ?>
<div id="menu" class="span3">
	<ul class="nav nav-tabs nav-stacked">
		<li>
			<form id="search_form" action="" method="get">
				<input type="text" name="q" placeholder="Buscar..." />
			</form>
		</li>
		<li><hr /></li>
		<li><a href="<?php echo $this->url('index') ?>">Inicio</a></li>
		<li><a href="<?php echo $this->url('company_index') ?>">Compañías aseguradoras</a></li>
		<li><a href="<?php echo $this->url('index') ?>">Coverturas</a></li>
		<li><a href="<?php echo $this->url('index') ?>">Productores</a></li>
		<li><a href="<?php echo $this->url('index') ?>">Clientes</a></li>
		<li><a href="<?php echo $this->url('index') ?>">Usuarios</a></li>
		<li><hr /></li>
		<li><a href="<?php echo $this->url('index') ?>">Mi cuenta</a></li>
		<li><a href="<?php echo $this->url('logout') ?>">Cerrar sesión</a></li>
	</ul>
</div>
<div id="content" class="well span7">
	<?php $this->block('content') ?>
	<?php $this->endBlock() ?>
</div>
<?php $this->endBlock() ?>