<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<title><?php $this->block('title') ?>Sistema de gestión de seguros<?php $this->endBlock() ?></title>
		<?php $this->block('css') ?>
			<link rel="stylesheet" type="text/css" href="<?= $this->asset('css/bootstrap.min.css') ?>" />
			<link rel="stylesheet" type="text/css" href="<?= $this->asset('css/jquery-ui-theme/jquery-ui.custom.min.css') ?>" />
			<link rel="stylesheet" type="text/css" href="<?= $this->asset('css/jquery.tablesorter.pager.theme.bootstrap.css') ?>" />
			<link rel="stylesheet" type="text/css" href="<?= $this->asset('css/main.css') ?>" />
		<?php $this->endBlock() ?>
		<?php $this->block('js') ?>
			<script type="text/javascript" src="<?= $this->asset('js/bootstrap.min.js') ?>"></script>
			<script type="text/javascript" src="<?= $this->asset('js/jquery.min.js') ?>"></script>
			<script type="text/javascript" src="<?= $this->asset('js/jquery-ui.min.js') ?>"></script>
			<script type="text/javascript" src="<?= $this->asset('js/jquery.tablesorter.min.js') ?>"></script>
			<script type="text/javascript" src="<?= $this->asset('js/jquery.tablesorter.widgets.min.js') ?>"></script>
			<script type="text/javascript" src="<?= $this->asset('js/jquery.tablesorter.pager.min.js') ?>"></script>
			<script type="text/javascript" src="<?= $this->asset('js/main.js') ?>"></script>
			<script type="text/javascript">
				Globals = {};
				Globals.routes = {
					operation_company_info: '<?= $this->url('operation_company_info', array('id' => '{id}')) ?>',
					operation_total_cost: '<?= $this->url('operation_total_cost') ?>',
					operation_get_answer_dialog_content: '<?= $this->url('operation_get_answer_dialog_content', array('id' => '{id}')) ?>',
					operation_answer: '<?= $this->url('operation_answer', array('id' => '{id}')) ?>',
				}
			</script>
		<?php $this->endBlock() ?>
	</head>
	<body>
		<?php $this->block('body') ?>
		<?php $this->endBlock() ?>
		
		<?php $this->block('endjs') ?>
		<?php $this->endBlock() ?>
	</body>
</html>