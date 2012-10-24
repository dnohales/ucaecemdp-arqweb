<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<title><?php $this->block('title') ?>Sistema de gestión de seguros<?php $this->endBlock() ?></title>
		<?php $this->block('css') ?>
			<link rel="stylesheet" type="text/css" href="<?php echo $this->asset('css/bootstrap.min.css') ?>" />
			<link rel="stylesheet" type="text/css" href="<?php echo $this->asset('css/jquery-ui-theme/jquery-ui.custom.min.css') ?>" />
			<link rel="stylesheet" type="text/css" href="<?php echo $this->asset('css/main.css') ?>" />
		<?php $this->endBlock() ?>
		<?php $this->block('js') ?>
			<script type="text/javascript" src="<?php echo $this->asset('js/bootstrap.min.js') ?>"></script>
			<script type="text/javascript" src="<?php echo $this->asset('js/jquery.min.js') ?>"></script>
			<script type="text/javascript" src="<?php echo $this->asset('js/jquery-ui.min.js') ?>"></script>
			<script type="text/javascript" src="<?php echo $this->asset('js/jqModal.js') ?>"></script>
			<script type="text/javascript" src="<?php echo $this->asset('js/main.js') ?>"></script>
		<?php $this->endBlock() ?>
	</head>
	<body>
		<?php $this->block('body') ?>
		<?php $this->endBlock() ?>
		
		<?php $this->block('endjs') ?>
		<?php $this->endBlock() ?>
	</body>
</html>