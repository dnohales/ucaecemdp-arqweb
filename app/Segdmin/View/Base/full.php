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
		<?= $this->partial('Base:_menuItem', array('label' => 'Compañías', 'routeName' => 'company_index')) ?>
		<?= $this->partial('Base:_menuItem', array('label' => 'Coberturas', 'routeName' => 'coverage_index')) ?>
		<?= $this->partial('Base:_menuItem', array('label' => 'Solicitudes', 'routeName' => 'request_index')) ?>
		<?= $this->partial('Base:_menuItem', array('label' => 'Productores', 'routeName' => 'producer_index')) ?>
		<?= $this->partial('Base:_menuItem', array('label' => 'Clientes', 'routeName' => 'taker_index')) ?>
		<?= $this->partial('Base:_menuItem', array('label' => 'Usuarios', 'routeName' => 'user_index')) ?>
		<li><hr /></li>
		<li><a href="<?php echo $this->url('profile') ?>">Mi cuenta</a></li>
		<li><a href="<?php echo $this->url('logout') ?>">Cerrar sesión</a></li>
	</ul>
</div>
<div id="content" class="well">
	<?= $this->partial('Base:_flashes') ?>
	<?php $this->block('content') ?>
	<?php $this->endBlock() ?>
</div>
<?php $this->endBlock() ?>