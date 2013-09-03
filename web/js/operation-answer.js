OperationAnswerDialog = {
	currentOperationId: null,
	
	init: function() {
		var self = this;

		$('#operation_answer_dialog').dialog({
			autoOpen: false,
			show: "fade",
			hide: "fade",
			modal: true,
			minWidth: 450,
			position: ["center", 50],
			resizable: false,
			open: function(event, ui) { $(".ui-dialog-titlebar-close", $(event.target).parent()).hide(); }
		});
		
		$('#operation_answer_dialog .button-cancel').click(function() {
			self.close();
			return false;
		});
		
		$('#operation_answer_dialog .button-accept').click(function() {
			self._acceptOrReject(true);
			return false;
		});
		
		$('#operation_answer_dialog .button-reject').click(function() {
			self._acceptOrReject(false);
			return false;
		});
	},
	
	openOperation: function(operationId) {
		var self = this;

		self.currentOperationId = operationId;
		self._showOrHideLoading(true);
		$('#operation_answer_dialog > footer button').attr('disabled', false);
		$('#operation_answer_dialog').dialog('open');
		
		var contentUrl = Globals.routes.operation_get_answer_dialog_content.replace('{id}', self.currentOperationId);
		$.ajax(contentUrl, {
			dataType: 'html',
			success: function(data) {
				$('#operation_answer_dialog article').html(data);
				self._showOrHideLoading(false);
			},
			error: function() {
				self.close();
			}
		});
	},
	
	close: function() {
		$('#operation_answer_dialog').dialog('close');
	},
	
	_showOrHideLoading: function(showOrHide) {
		$('#operation_answer_dialog > article').toggle(!showOrHide);
		$('#operation_answer_dialog > footer').toggle(!showOrHide);
		$('#operation_answer_dialog > .loading').toggle(showOrHide);
	},
	
	_acceptOrReject: function(acceptOrReject) {
		var self = this;
		
		$('#operation_answer_dialog > footer button').attr('disabled', true);
		
		var url = Globals.routes.operation_answer.replace('{id}', self.currentOperationId);
		$.ajax(url, {
			type: 'POST',
			data: {type: acceptOrReject? 'accept':'reject'},
			dataType: 'json',
			success: function () {
				var newContent;
				
				if (acceptOrReject) {
					newContent = '<span class="operation-accepted">Aceptado</span>';
				} else {
					newContent = '<span class="operation-rejected">Rechazado</span>';
				}
				
				$('#operation_table_row_' + self.currentOperationId + ' .operation-answer-btn').replaceWith(newContent);
				
				self.close();
			}
		});
	}
};

$(function(){
	$('.operation-answer-btn').click(function(){
		OperationAnswerDialog.openOperation($(this).attr('data-operation-id'));
		return false;
	});
	
	OperationAnswerDialog.init();
});
