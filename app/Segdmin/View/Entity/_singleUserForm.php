<label>Correo electrónico</label>
<input value="<?= isset($user)? $user->getEmail():'' ?>" name="user[email]" type="email" required="required" />
<label>Contraseña</label>
<input value="" id="password1" name="user[password]" type="password" required="required" />
<label>Repetir contraseña</label>
<input value="" id="password2" name="user[passwordRepeat]" type="password" required="required" />
<script type="text/javascript">
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