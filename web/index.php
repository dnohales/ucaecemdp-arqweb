<?php
use Segdmin\Framework\Application;
use Segdmin\Framework\Http\Request;

include __DIR__.'/../app/boot.php';

$application = new Application(__DIR__, __DIR__.'/../app');
$application->handle(Request::createFromPhpGlobals())->send();
