<?php $isUpdating = isset($isUpdating)? $isUpdating:false; ?>

<div class="form-row">
	<?php if($isUpdating): ?>
		<label>Nueva Contraseña</label>
	<?php else: ?>
		<label>Contraseña</label>
	<?php endif; ?>
	<input value="" id="password1" name="user[password]" type="password" <?php echo $isUpdating? '':'required="required"' ?> />
</div>
<div class="form-row">
	<label>Repetir contraseña</label>
	<input value="" id="password2" name="user[passwordRepeat]" type="password" <?php echo $isUpdating? '':'required="required"' ?> />
</div>
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
