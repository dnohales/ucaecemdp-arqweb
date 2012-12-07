$(function(){
	var changeRolCallback = function(){
		$('#user_admin_container, #user_producer_container, #user_company_container').hide();
		var selectedRol = $('#form select[name="rol"]').val();
		if(selectedRol){
			$('#user_'+selectedRol+'_container').show();
		}
	};
	
	changeRolCallback();
	$('#form select[name="rol"]').change(changeRolCallback);
});
