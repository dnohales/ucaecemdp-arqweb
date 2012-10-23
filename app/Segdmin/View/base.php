<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title><?php $this->block('title') ?>Sistema de gestión de seguros<?php $this->endBlock() ?></title>
        <link rel="stylesheet" type="text/css" href="<?php echo $this->asset('css/main.css') ?>" />
        <?php $this->block('styles') ?>
        <?php $this->endBlock() ?>
    </head>
    <body>
        <div class="banner">
            <a href="<?php echo $this->url('login'); ?>"><img src="<?php echo $this->asset('img/banner.gif') ?>"/></a>
        </div>
        <div class="container1">
            <div class="container2">
                <div class="menu">
                    <?php $this->block('menu') ?>
                        <li>Nuestros Servicios</li>
                        <li>¿Quiénes somos?</li>
                        <li>Contáctenos</li>
                    <?php $this->endBlock() ?>
                </div>
                <div class="content">
                    <?php $this->block('content') ?>
                        content
                    <?php $this->endBlock() ?>
                </div>
            </div>
        </div>
        <div class="footer">
            <h1>Universidad CAECE, Arquitectura Web, Trabajo Final</h1>
            <p>Nohales Damián</p>
            <p>Penovi Mariano</p>
            <p>Lippolis Emiliano</p>
        </div>
        <script type="text/javascript" src="<?php echo $this->asset('js/main.js') ?>"></script>
        <?php $this->block('scripts') ?>
        <?php $this->endBlock() ?>
    </body>
</html>
