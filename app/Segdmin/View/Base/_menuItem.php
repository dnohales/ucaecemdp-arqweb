<?php if($this->isGranted($routeName)): ?>
<li><a href="<?= $this->url($routeName) ?>"><?= $label ?></a></li>
<?php endif; ?>

