$(function(){
	/*
	 * Inicialización de valores personalizados en las validaciones de formularios
	 */
	$('input[data-custom-validity], select[data-custom-validity]').bind('invalid', function(e){
		if(!e.target.validity.valid){
			e.target.setCustomValidity($(e.target).attr('data-custom-validity'));
		} else {
			e.target.setCustomValidity('');
		}
	});
	
	/*
	 * Inicialización de campos de fechas
	 */
	$('input.date').datepicker({
		dateFormat: 'dd/mm/yy',
		changeMonth: true,
		changeYear: true,
		yearRange: '-110:-15'
	}).attr({
		'placeholder': 'dd/mm/aaaa',
		'pattern': '[0-9]{1,2}/[0-9]{1,2}/[0-9]{4}'
	});
	
	/*
	 * Inicialización de formulario de detalles
	 */
	$('.entity-detail .entity-formdelete').submit(function(){
		return confirm('¿Estás seguro que deseas eliminar esto? Esta operación no puede deshacerse');
	});
	
	$('.entity-detail .entity-editbutton').click(function(){
		var edit = $(this).parents('.entity-detail').find('.entity-edit');
		var show = $(this).parents('.entity-detail').find('.entity-show');
		
		show.fadeOut('fast', function(){
			edit.fadeIn('fast');
		});
	});
	
	$('.entity-detail .entity-canceledit').click(function(){
		var edit = $(this).parents('.entity-detail').find('.entity-edit');
		var show = $(this).parents('.entity-detail').find('.entity-show');
		
		edit.fadeOut('fast', function(){
			show.fadeIn('fast');
		});
	})
});
