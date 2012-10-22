tiene que mostrar: productor, tomador, cobertura, costo total
y para cada fila un botón que diga [responder]
al usarlo, aparece una ventana modal con un formulario q pregunta si se acepta o no y porqué

TODO: un procedimiento para que a partir de un arreglo de dos dimensiones se llene una tabla
(las columnas de las tablas deben permitir ser ordenadas ascendientemente o descendientemente)

TODO: ventana modal para el formulario rápido de respuesta a las solicitudes de coberturas

<script>
    $(document).ready(function() {
        $(".jqmWindow").jqm();
        $(".answer").click(function() {
            $(".jqmWindow").jqmShow();
        });
    });
</script>

<input type="button" value="Responder" class="answer" id="id_request">

<div class="jqmWindow">
    <div id='contact-form'>
            <h3>Contact Form</h3>
            <p>A contact form built on SimpleModal. Demonstrates the use of the <code>onOpen</code>, <code>onShow</code> and <code>onClose</code> callbacks, as well as the use of Ajax with SimpleModal.</p>
            <p>To use: open <code>data/contact.php</code> and modify the <code>$to</code> and <code>$subject</code> values. To enable/disable information about the user, configure the <code>$extra</code> array.</p>
            <p><strong>Note:</strong> This demo must be run from a web server with PHP enabled.</p>
    </div>
</div>