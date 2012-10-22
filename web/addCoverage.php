<h1>Agregar nueva cobertura</h1>
<form name="addCoverage" action="addcoverage" method="post">
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