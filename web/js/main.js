$(function(){
	/*
	 * Inicialización de valores personalizados en las validaciones de formularios
	 */
	$('input[data-custom-validity], select[data-custom-validity]').on('input', function(e){
		e.target.setCustomValidity('');
		if(!e.target.checkValidity()){
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
	 * Inicialización de tablesorter
	 */
	$.extend($.tablesorter.themes.bootstrap, { 
		table: 'table'
	});
	$('.tablesorter').each(function(){
		$(this).tablesorter({
			widgets: ['uitheme', 'filter'],
			widgetOptions: {
				uitheme : "bootstrap" 
			}
		});
		
		if($(this).find('tbody > tr').length > 10){
			$(this).tablesorterPager({
				container: $(this).next('.pager'),
				positionFixed: false,
				cssGoto  : ".pagenum",
				output: '{startRow} - {endRow} (total {totalRows})' 
			});
		} else {
			$(this).next('.pager').hide();
		}
		
		//Super Hardcodeada!!
		//Se quitan los filtros del campo de ID y el de acción
		var $table = $(this);
		$table.find('thead tr.tablesorter-headerRow th:contains(#), thead tr.tablesorter-headerRow th:contains(Acción)').each(function(){
			$table.find('thead tr.tablesorter-filter-row td:nth-child('+($(this).index() + 1)+') input').hide();
		});
		
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
		$('.entity-detail .entity-edit form').get(0).reset();
	});
	
	$('.entity-detail .entity-canceledit').click(function(){
		var edit = $(this).parents('.entity-detail').find('.entity-edit');
		var show = $(this).parents('.entity-detail').find('.entity-show');
		
		edit.fadeOut('fast', function(){
			show.fadeIn('fast');
		});
	});
	
	/*
	 * Callback para notificar un error de Ajax
	 */
	$(document.body).ajaxError(function(){
		alert('Ha ocurrido un error, si nota que esto continúa, por favor, recargue la página.');
	});
});
