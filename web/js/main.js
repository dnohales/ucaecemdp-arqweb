$(function(){
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
