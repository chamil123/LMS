$(document).ready(function () {
    $("form").submit(function (event) {

        var agent = $('#agent').val();//to get the first name
        var cnumber = $('#cnumber').val();
        var cname = $('#cname').val();
        var type = $('#type').val();
        var pcash = $('#pcash').val();
        var expname = $('#expname').val();
        var amount = $('#amount').val();
        var pnumber = $('#pnumber').val();
        var onumber = $('#onumber').val();
        var address = $('#address').val();
        var comision = $('#comision').val();
        var nocomision = $('#nocomision').val();
        var lcomision = $('#lcomision').val();

        var patName = /^[a-zA-Z]+$/;//regular expression
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

            if (!pnumber.match(patnTel)) {//pattern is not there then
                event.preventDefault();
                ispaternok = false;
                $('#msgpnumber').text('Phone number incorrect');//to display error message
            } else {
                ispaternok = true;
                $('#msgpnumber').text('');//to display error message
            }
            if (!onumber.match(patnTel)) {//pattern is not there then
                event.preventDefault();
                ispaternok = false;
                $('#msgonumber').text('office number incorrect');//to display error message
            } else {
                ispaternok = true;
                $('#msgonumber').text('');//to display error message
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