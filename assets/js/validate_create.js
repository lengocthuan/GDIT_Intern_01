$(document).ready(function(){
	var title_status = false;
	var content_status = false;
	// alert('123');

	$('#create-title').focus(function(){
		var title_post = $('#create-title').val();
		alert('abc');
		if (title_post == '') {
			alert('The title is not empty.');
			return false;
		}
	});
});