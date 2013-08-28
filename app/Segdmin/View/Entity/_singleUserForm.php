<div class="form-row">
	<label>Correo electrónico</label>
	<input value="<?= isset($user)? $user->getEmail():'' ?>" name="user[email]" type="email" required="required" />
</div>
<?= $this->partial('User:_password'); ?>