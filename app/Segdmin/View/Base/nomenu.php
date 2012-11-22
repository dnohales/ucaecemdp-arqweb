<?php $this->extend('Base:metaonly') ?>

<?php $this->block('body') ?>
<div id="container">
	<div id="wrapper">
		<div id="header">
			<div class="container">
				<span id="header_text">Segdmin</span> - Diseñamos los encabezados mas feos
			</div>
		</div>
		<div class="container">
			<div id="maincontent">
				<?php $this->block('maincontent') ?>
				<?php $this->endBlock() ?>
			</div>
		</div>
	</div>
	<div id="footer">
		<div class="container">
			<div class="footer-note">
				<p>Copyright &copy; 2012 por Damián Nohales, Emiliano Lippolis y Mariano Penovi</p>
				<p>Este programa es Software Libre, puede redistribuirlo y/o modificarlo bajo los términos de la <a href="http://www.gnu.org/licenses/agpl-3.0-standalone.html">Licencia Pública General de Affero (AGPL)</a></p>
			</div>
		</div>
	</div>
</div>
<?php $this->endBlock() ?>