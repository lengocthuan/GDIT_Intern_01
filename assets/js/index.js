$(function() {
    $('#reset').on('click', function(e) {
        $('input').prop('checked', false);
        //will work
        e.preventDefault();
    });
});