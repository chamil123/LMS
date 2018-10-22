$(document).ready(function () {
    $("form").submit(function (event) {
        var fname = $('#fname').val();//to get the first name
        var lname = $('#lname').val();
        var nic = $('#nic').val();
        var pnumber = $('#pnumber').val();
        var hnumber = $('#hnumber').val();
        var email = $('#email').val();
        var address = $('#address').val();

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

            if (!fname.match(patName)) {//pattern is not there then
                event.preventDefault();
                ispaternok = false;
                $('#msgfname').text('first name is incorrect');//to display error message
            }
            else{
                 ispaternok = true;
                 $('#msgfname').text('');//to display error message
            }
            if (!lname.match(patName)) {
                event.preventDefault();
                ispaternok = false;
                $('#msglname').text('last name is incorrect');//to display error message
            }else{
                 ispaternok = true;
                 $('#msglname').text('');//to display error message
            }
             if (!nic.match(patNic)) {
                event.preventDefault();
                ispaternok = false;
                $('#msgnic').text('NIC number is incorrect');//to display error message
            }else{
                 ispaternok = true;
                 $('#msgnic').text('');//to display error message
            }
            if (!pnumber.match(patnTel)) {
                event.preventDefault();
                ispaternok = false;
                $('#msgpnumber').text('Mobile number is incorrect');//to display error message
            }else{
                 ispaternok = true;
                 $('#msgpnumber').text('');//to display error message
            }
            if (!hnumber.match(patnTel)) {
                event.preventDefault();
                ispaternok = false;
                $('#msghnumber').text('Home number is incorrect');//to display error message
            }else{
                 ispaternok = true;
                 $('#msghnumber').text('');//to display error message
            }
            if (!email.match(patEmail)) {
                event.preventDefault();
                ispaternok = false;
                $('#msgemail').text('email address is incorrect');//to display error message
            }else{
                 ispaternok = true;
                 $('#msgemail').text('');//to display error message
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

