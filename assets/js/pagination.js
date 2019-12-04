// $(document).ready(function() {
//     $(".pagination").bootpag({
//         total: total_pages,
//         page: 1,
//         maxVisible: 5,
//         leaps: true
//     }).on('page', function(e, num) {
//         e.preventDefault();
//         // $("#results").prepend('<div class="loading-indication"><img src="../ajax-loader.gif" /> Loading...</div>');
//      // $("#results").load('/api/config/pagination.php');
//         $("#results").load("/api/config/pagination.php", {'page':num});
//         // $("#results").prepend("<?php require_once dirname(__DIR__,2) .'/config/pagination.php'; require_once 'showTable.php';}?>");

//         // $("#results").hide();
//     });
//     // return false;
// });

$(document).ready(function() {
    load_data();
    var current_page = 1;
    // alert(page);
    function load_data(page) {
        $.ajax({
            url: "/api/config/pagination.php",
            type: "POST",
            data: { page: page },
            success: function(data) {
                // alert(data);
                $('#pagination_data').html(data);

                $('#results').empty();

            }
        });
    }

    $(document).on('click', '.pagination_link', function() {
        // e.preventDefault();
        var page = $(this).attr("id");
        alert('abc' + page);
        if (page !== '>' && page !== '<') {//so 1 2 3 4 5
            current_page = page;
            
            alert(current_page);
            load_data(current_page);
            return false;
        } else { //dau > <
            if (page === '>') {

                current_page = Number(current_page) + 1;
                alert(current_page + 'no reload now'); return false;
            }

            // load_data(page);
        }
        alert('khong duoc vo day');
        // load_data(current_page);
    });

    // $('#pagination_data').pagination(maxentries, {
    //     items_per_page : 3,
    //     next_text : '>',
    //     prev_text : '<',
    //     num_display_entries : 5,
    //     load_first_page : false,
    //     callback : callback
    // });
});