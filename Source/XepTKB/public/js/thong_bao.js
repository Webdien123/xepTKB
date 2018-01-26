$( document ).ready(function() {

    $("#success-alert").fadeTo(5000, 500).slideUp(500, function(){
        $("#success-alert").slideUp(2000);
    });

    $("#error-alert").fadeTo(5000, 500).slideUp(500, function(){
        $("#success-alert").slideUp(2000);
    });
});