$(document).ready(function() {
	$('#loginForm').ajaxForm({
		beforeSubmit: resetForm,
		success: onResponse
	});

	$('#username').focus();

	function resetForm(formData, jqForm, options) {
		$('#error').fadeOut(60);
	}
	function onResponse(responseText, statusText, xhr, $form) {
		if (responseText == "1") {
			window.location.replace("/");
		} else {
			$('#error').html(responseText);
			$('#error').fadeIn(300);
		}
	}
});