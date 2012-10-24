<?php $this->extend('Base:metaonly') ?>

<?php $this->block('body') ?>
<div id="container">
	<div id="header">
	</div>
	<div id="maincontent">
		<?php $this->block('maincontent') ?>
		<?php $this->endblock() ?>
	</div>
	<div id="footer">
		<h1>Universidad CAECE, Arquitectura Web, Trabajo Final</h1>
		<p>Nohales Damián</p>
		<p>Penovi Mariano</p>
		<p>Lippolis Emiliano</p>
	</div>
</div>
<?php $this->endblock() ?>