<?php
use Segdmin\Helper\UserRoleAsString;
?>
<p>Correo electrónico: <a href="mailto:<?= $user->getEmail(); ?>"><?= $user->getEmail(); ?></a></p>
<p>Rol: <strong><?= UserRoleAsString::toText($user); ?></strong></p>

