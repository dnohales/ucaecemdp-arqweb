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
	
	form.on('input change', function(){
		if(inputTimeout){
			window.clearTimeout(inputTimeout);
			inputTimeout = null;
		}
		
		inputTimeout = window.setTimeout(function(){
			$.post(Globals.routes.operation_total_cost, form.serialize(), function(data){
				if(parseInt(data.result) < 0) {
					form.find('.operation-total').html('El costo total no puede ser calculado, ¿está seguro que ingreso datos correctos?').addClass('error');
					form.find('button[type="submit"]').attr('disabled', true);
				} else if(data.result !== null){
					form.find('.operation-total').html('$'+data.result).removeClass('error');
					form.find('button[type="submit"]').attr('disabled', false);
				} else {
					form.find('.operation-total').html('Algunos campos no están completos o son incorrectos').addClass('error');
					form.find('button[type="submit"]').attr('disabled', true);
				}
			}, 'json');
		}, 500);
	});
});
