$(function(){
	$('.operation-answer-btn').click(function(){
		$('#operation_answer_dialog').dialog('open');
		
		return false;
	});
	
	$('#operation_answer_dialog').dialog({
		autoOpen: false,
		show: "fade",
		hide: "fade",
		modal: true
	});
});
