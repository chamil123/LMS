$(document).ready(function () {
    $("form").submit(function (event) {



//        var lamount = $('#aplication_lamount').val();//to get the first name
//        var lamountwithInt = $('#aplication_lamountWithInt').val();
//        var monthlyDue = $('#aplication_ldue').val();

        var patName = /^[a-zA-Z]+$/;//regular expression
        var patEmail = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,6})+$/;
        var patNic = /^[0-9]{9}[vVxX]$/;
        var patnTel = /^[0-9]$/;

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


        var atLeastOneIsChecked = $("input").is(":checked");
        if (atLeastOneIsChecked == false) {
             event.preventDefault();
            alert("Please select atLeast one member ");
           // isFormValid = false;
        }

        if (isFormValid === false) {
            $('.response-content').fadeIn();
            $('.response-content').removeClass('alert-success');
            $('.response-content').addClass('alert-error');
            $('.response-content').html("fields are cannot be blank");
            $('.response-content').delay(1500).fadeOut(400);
            event.preventDefault();
            return false;

        } else {
//
//            if (!lamount.match(patnTel)) {//pattern is not there then
//                event.preventDefault();
//                ispaternok = false;
//                $('#msglamount').text('Loan amount incorrect');//to display error message
//            } else {
//                ispaternok = true;
//                $('#msglamount').text('');//to display error message
//            }
//            if (!lamountwithInt.match(patnTel)) {//pattern is not there then
//                event.preventDefault();
//                ispaternok = false;
//                $('#msglamountWithInt').text('Amount with interest incorrect');//to display error message
//            } else {
//                ispaternok = true;
//                $('#msglamountWithInt').text('');//to display error message
//            }
//            if (!monthlyDue.match(patnTel)) {//pattern is not there then
//                event.preventDefault();
//                ispaternok = false;
//                $('#msgaplication_ldue').text('due incorrect');//to display error message
//            } else {
//                ispaternok = true;
//                $('#msgaplication_ldue').text('');//to display error message
//            }


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