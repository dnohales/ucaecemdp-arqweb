$(function(){
	var form = $('#operation_add_form');
	
	form.find('[name="companyId"]').change(function(){
		var id = $(this).val();
		form.find('button[type="submit"], [name="coverageId"], [name="comission"]').attr('disabled', true);
		
		if(id){
			var url = Globals.routes.operation_company_info.replace('{id}', id);
			form.find('[name="coverageId"]').html('<option value="">Cargando...</option>');
			form.find('[name="comission"]').val('Cargando...');

			$.getJSON(url, function(data){
				form.find('[name="coverageId"]').html(data.coverages).attr('disabled', false);
				form.find('[name="comission"]').val(data.comission).attr('disabled', false);
				form.find('button[type="submit"]').attr('disabled', false);
			});
		} else {
			form.find('[name="coverageId"]').html('');
			form.find('[name="comission"]').val('');
		}
	});
	
	var inputTimeout = null;
	
	form.find('[name="coverageId"], [name="comission"]').on('input change', function(){
		
	});
});
