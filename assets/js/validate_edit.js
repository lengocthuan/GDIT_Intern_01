$(document).ready(function(){
	var title_status = false;
	var content_status = false;
	var redirect_status = false;

	var title_edit = '';
	var content_edit = '';

	function getValues() {
		title_edit = document.getElementById("edit-title").value.trim();
		content_edit = CKEDITOR.instances.editor1.getData();
	}

	$.urlParam = function(name){
		var results = new RegExp('[\?&]' + name + '=([^&#]*)').exec(window.location.href);
		if (results==null){
			return null;
		}
		else{
			return results[1] || 0;
		}
	}

	$('#apply-change').click(function() {
		getValues();
		if (title_edit == '' || content_edit == ''){
			if (title_edit == ''){
				$(".modal-body").addClass("alert alert-warning").html("Please input anything in title if you want create a post.");
				$('#myModal').modal();
			} else {
				$(".modal-body").addClass("alert alert-warning").html("Please input anything in content if you want create a post.");
				$('#myModal').modal();
			}
		} else {
			if (title_edit.length > 50){
				$(".modal-body").addClass("alert alert-warning").html("Please enter a title with a character limit of 50");
				$('#myModal').modal();
			} else {
				title_status = true;
				content_status = true;
			}
		}

		if (title_status != false && content_status != false){
			$.ajax({
				type: 'post',
				url: '/api/controller/PostsController.php',
				data: {
					'edit' : 1,
					'title' : title_edit,
					'content' : content_edit,
					'id_post' : $.urlParam('idpost'),
				},
				success: function(update) {
					if (update != 'Error-edit') {
						$(".modal-body").removeClass().addClass("modal-body alert alert-success").html("You has edited a post successful.");
						$('#myModal').modal();
						redirect_status = true;
						window.setTimeout(function() { 
							window.location.href = update;
						}, 1000);

					} else {
						$(".modal-body").addClass("alert alert-danger").html("An error occurred while editing. Please try again.");
						$('#myModal').modal();
						return false;
					}
				}
			});
		}
		return false;
	});

	window.onbeforeunload = function(){
		// getValues();
		if (redirect_status != true){
			return 'Are you sure you want to leave?';
		}
	};
});

