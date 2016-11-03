var modify_code = function () {
	var matrix_account_id = $("#appbundle_debit_withdrawalReason").val();
	$.get('/data?matrixAccount='+matrix_account_id, function (data) {
		var code = matrix_account_id + "." + data;
		$('#appbundle_childaccount_code').val(code);
	})
}
$(document).ready(function () {
	modify_code();
	$('#appbundle_debit_withdrawalReason').change(function () {
		modify_code();
	})
});