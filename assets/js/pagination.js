$(document).ready(function() {
	// alert(total_pages);
    // $("#results").load("/api/view/Post/managementposts.php"); //initial page number to load
    $(".pagination").bootpag({
        total: total_pages,
        page: 1,
        maxVisible: 5,
        leaps: true
    }).on('page', function(e, num) {
        e.preventDefault();
        // $("#results").prepend('<div class="loading-indication"><img src="../ajax-loader.gif" /> Loading...</div>');
		$("#results").load('/api/config/pagination.php');
        // $("#results").load("/api/config/pagination.php", {'page':num});
        // $("#results").hide();
	});
    // return false;
});
