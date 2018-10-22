$(document).ready(function () {
    $("form").submit(function (event) {

        var cname = $('#cname').val();//to get the first name
        var cnumber = $('#cnumber').val();
        var aname = $('#aname').val();
        var account = $('#account').val();
        var fc = $('#fc').val();
        var cash = $('#cash').val();
        var pdue = $('#pdue').val();
     
        var patName = /^[a-zA-Z0-9_ ]+$/;//regular expression
        var patEmail = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,6})+$/;
        var patNic = /^[0-9]{9}[vVxX]$/;
        var patnTel = /^[0-9]{10}$/;

        var isFormValid = true;
        var ispaternok = true;
        $(".required").each(function () {
            if ($.trim(this.value) === "") {
                $(this).addClass('inputError');
                isFormValid = false;
            } else {
                $(this).removeClass('inputError');
            }
        });
        if (isFormValid === false) {
            $('.response-content').fadeIn();
            $('.response-content').removeClass('alert-success');
            $('.response-content').addClass('alert-error');
            $('.response-content').html("fields are cannot be blank");
            $('.response-content').delay(1500).fadeOut(400);
            event.preventDefault();
            return false;

        } else {

            if (!cname.match(patName)) {//pattern is not there then
                event.preventDefault();
                ispaternok = false;
                $('#msgcname').text('Center name incorrect');//to display error message
            } else {
                ispaternok = true;
                $('#msgcname').text('');//to display error message
            }
            
            

        }
        // Remove Error-border when input is NOT EMPTY  
        $(".required").focusout(function () {
            $(".required").each(function () {
                if ($.trim(this.value) != "") {
                    $(this).removeClass('inputError');
                }
            });
        });

    });
});