$(document).ready( function () {
    $('.modal').modal({
        backdrop: 'static',
        keyboard: false
    });

    $('#liam2_add_another_email').click(function(){
        $('#liam2_add_another_email_form').submit();
    });

    $('.liam2-delete-email').click(function(){
        if(!confirm("Please confirm that you want to remove this e-mail address.")){
            return false;
        }
    })
});