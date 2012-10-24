<?php $this->extend('Base:full') ?>

<?php $this->block('title'); ?>
Agregar nueva cobertura - 
<?php echo $this->parentBlock();
$this->endBlock()
?>

<?php $this->block('content') ?>
<form action="<?php echo $this->url('addcoverage') ?>" method="post">
    <p>
        <label for="description">Descripción:</label>
    </p>
    <textarea name="description" rows="5" cols="50"></textarea>
    <p>
        <label for="rate">Tasa:</label>
        <input type="text" name="rate"/> %
    </p>
    <div class="submit">
        <input type="reset" value="Reiniciar campos">
        <input type="submit" value="Agregar cobertura">
    </div>
</form>
<?php $this->endBlock() ?>