$(document).ready( function () {
    $('.modal').modal({
        backdrop: 'static',
        keyboard: false
    });

    $('#delete_email_dropdown').change(function() {
        $('#delete_user_email_id').val($(this).find('option:selected').data('user_email_id'));
    })
});