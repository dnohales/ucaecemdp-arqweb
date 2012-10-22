<script>
    $(function() {
        $( "#datepicker" ).datepicker({
            dateFormat: "dd/mm/yy",
            showOn: "button",
            buttonImage: "img/calendar.png",
            buttonImageOnly: true
        });
        $( "#datepicker" ).focus(function() {
            $( "#datepicker" ).datepicker("show");
        });
    });
</script>

<h1>Agregar nuevo tomador</h1>
<form name="addTaker" action="addtaker" method="post">
    <p>
        <label for="name">Nombre:</label>
        <input type="text" name="name"/>
    </p>
    <p>
        <label for="lastname">Apellido:</label>
        <input type="text" name="lastname"/>
    </p>
    <p>
        <label for="dni">DNI:</label>
        <input type="text" name="dni"/>
    </p>
    <p>
        <label for="cuit">CUIT:</label>
        <input type="text" name="cuit"/>
    </p>
    <p>
        <label for="birth">Fecha de nacimiento:</label>
        <input type="text" name="birth" id="datepicker" readonly="readonly"/>
    </p>
    <p>
        <label for="address">Dirección:</label>
        <input type="text" name="address"/>
    </p>
    <p>
        <label for="email">Correo electrónico:</label>
        <input type="text" name="email"/>
    </p>
    <p>
        <label for="phones">Teléfonos:</label>
        <input type="text" name="phones"/>
    </p>
    <p>
        <label for="situation">Situación impositiva:</label>
        <select name="situation">
            <option value="0" selected>Consumidor final</option>
            <option value="1">Monotributista</option>
            <option value="2">Responsable inscripto</option>
        </select>
    </p>
    <div class="submit">
        <input type="reset" value="Reiniciar campos"/>
        <input type="submit" value="Agregar tomador"/>
    </div>
</form>