<?php $this->extend('Base:nomenu') ?>

<?php $this->block('maincontent') ?>
<div id="menu">
	<ul class="nav nav-tabs nav-stacked">
		<!--<li>
			<form id="search_form" action="" method="get">
				<input type="text" name="q" placeholder="Buscar..." />
			</form>
		</li>
		<li><hr /></li>-->
		<li><a href="<?php echo $this->url('index') ?>">Inicio</a></li>
		<li><a href="<?php echo $this->url('company_index') ?>">Compañías</a></li>
		<li><a href="<?php echo $this->url('index') ?>">Coberturas</a></li>
		<li><a href="<?php echo $this->url('producer_index') ?>">Productores</a></li>
		<li><a href="<?php echo $this->url('taker_index') ?>">Clientes</a></li>
		<li><a href="<?php echo $this->url('index') ?>">Usuarios</a></li>
		<li><hr /></li>
		<li><a href="<?php echo $this->url('index') ?>">Mi cuenta</a></li>
		<li><a href="<?php echo $this->url('logout') ?>">Cerrar sesión</a></li>
	</ul>
</div>
<div id="content" class="well">
	<?= $this->partial('Base:_flashes') ?>
	<?php $this->block('content') ?>
	<?php $this->endBlock() ?>
</div>
<?php $this->endBlock() ?>