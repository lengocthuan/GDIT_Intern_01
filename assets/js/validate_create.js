$(document).ready(function(){
	var title_status = false;
	var content_status = false;
	var redirect_status = false;

	var title_post = '';
	var content_post = '';

	function getValues() {
		title_post = document.getElementById("create-title").value.trim();
		content_post = CKEDITOR.instances.editor1.getData();
	}

	$('#save-post').click(function() {
		getValues();
		if (title_post == '' || content_post == ''){
			if (title_post == ''){
				$(".modal-body").addClass("alert alert-warning").html("Please input anything in title if you want create a post.");
				$('#myModal').modal();
			} else {
				$(".modal-body").addClass("alert alert-warning").html("Please input anything in content if you want create a post.");
				$('#myModal').modal();
			}
		} else {
			if (title_post.length > 50){
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
					'create' : 1,
					'title' : title_post,
					'content' : content_post,
				},
				success: function(create) {
					if (create != 'unsuccessful') {
						$(".modal-body").removeClass().addClass("modal-body alert alert-success").html("You has created a post successful.");
						$('#myModal').modal();
						redirect_status = true;
						window.setTimeout(function() { 
							window.location.href = create;
						}, 550);
					} else {
						$(".modal-body").addClass("alert alert-warning").html("There was an error creating the post. Please try again.");
						$('#myModal').modal();
						return false;
					}
				}
			});
		}
		return false;
	});

	window.onbeforeunload = function(){
		getValues();
		if (redirect_status != true){
			return 'Are you sure you want to leave?';
		}
	};

});