<?php $this->extend('Company:_form') ?>

<?php $this->block('content') ?>
<legend>Información de acceso</legend>
<label class="checkbox">
	<input type="checkbox" name="createUser" checked="checked" />
	Crear un usuario para la compañía
</label>
<fieldset class="margined" id="access_info">
	<label>Correo electrónico</label>
	<input value="" name="user[email]" type="email" required="required" />
	<label>Contraseña</label>
	<input value="" id="password1" name="user[password]" type="password" required="required" />
	<label>Repetir contraseña</label>
	<input value="" id="password2" name="user[passwordRepeat]" type="password" required="required" />
</fieldset>
<?= $this->parentBlock() ?>
<script type="text/javascript">
	$('#form input[name="createUser"]').click(function(){
		$('#access_info').attr('disabled', !$(this).is(':checked'));
	});
	
	$('#password2').on('focus input', function(){
		var p1 = $('#password1').val();
		var p2 = $(this).val();
		if(p1 == p2){
			this.setCustomValidity('');
		} else {
			this.setCustomValidity('La contraseña no es correcta');
		}
	})
</script>
<?php $this->endBlock() ?>
