$(document).ready(function () {
    $("form").submit(function (event) {

        var fname = $('#fname').val();//to get the first name
        var lname = $('#lname').val();
        var dob = $('#dob').val();
        var nic = $('#nic').val();
        var gender = $('#gender').val();
        var uname = $('#uname').val();
        var pnumber = $('#pnumber').val();
        var email = $('#email').val();
        var address = $('#address').val();
        var role = $('#role').val();
        var img = $('#img').val();

//
        var patName = /^[a-zA-Z]+$/;//regular expression
        var patEmail = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,6})+$/;
        var patNic = /^[0-9]{9}[vVxX]$/;
        var patnTel = /^[0-9]{10}$/;

        //current date
        var today = new Date();
        var year = today.getFullYear();
        var month = today.getMonth();
        var date = today.getDate();

        //dob validation
        var dob = $('#dob').val();
        var bday = new Date(dob);
        var byear = bday.getFullYear();
        var bmonth = bday.getMonth();
        var bdate = bday.getDate();

        age = year - byear;
        m = month - bmonth;
        d = date - bdate;
        if (m < 0 || (m == 0 && d < 0)) {
            age--;
        }



//
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
            } else {
                ispaternok = true;
                $('#msgfname').text('');//to display error message
            }
            if (!lname.match(patName)) {
                event.preventDefault();
                ispaternok = false;
                $('#msglname').text('last name is incorrect');//to display error message
            } else {
                ispaternok = true;
                $('#msglname').text('');//to display error message
            }
            if (true) {



                if (age < 18) {
                    $("#msgdob").text('Underage'); // to display an error
                    document.getElementById('dob').focus();
                    // if so defoult value must be prevented.......
                    // defoult value is true
                    event.preventDefault();
                    return false;
                }
                if (age > 60) {
                    $("#msgdob").text('OverAge'); // to display an error
                    document.getElementById('dob').focus();
                    // if so defoult value must be prevented.......
                    // defoult value is true
                    event.preventDefault();
                    return false;
                }
                $('#msgdob').text('');//to display error message

            } else {
                ispaternok = true;
                $('#msgdob').text('');//to display error message
            }
            if (!nic.match(patNic)) {
                event.preventDefault();
                ispaternok = false;
                $('#msgnic').text('NIC number is incorrect');//to display error message
            } else {
                ispaternok = true;
                $('#msgnic').text('');//to display error message
            }
            if (!($('#male').is(':checked')) && !($('#female').is(':checked'))) {
                $("#msggender").text('Gender not checked'); // to display an error

                // if so defoult value must be prevented.......
                // defoult value is true
                event.preventDefault();
                return false;
            }
            if (!pnumber.match(patnTel)) {
                event.preventDefault();
                ispaternok = false;
                $('#msgpnumber').text('Mobile number is incorrect');//to display error message
            } else {
                ispaternok = true;
                $('#msgpnumber').text('');//to display error message
            }
//            if (!hnumber.match(patnTel)) {
//                event.preventDefault();
//                ispaternok = false;
//                $('#msghnumber').text('Home number is incorrect');//to display error message
//            }else{
//                 ispaternok = true;
//                 $('#msghnumber').text('');//to display error message
//            }
            if (!email.match(patEmail)) {
                event.preventDefault();
                ispaternok = false;
                $('#msgemail').text('email address is incorrect');//to display error message
            } else {
                ispaternok = true;
                $('#msgemail').text('');//to display error message
            }
            // to check an image file(.jpg.png,gif)
            if ($('#img').val() != "") {
                var im = $('#img').val();   // create variable
                var getExt = im.split(".");   // split image name using "."  (name get two pats)
                getExt = getExt.reverse();     //get name in reverse order
                var ext1 = getExt[0].toLowerCase();

                var ext = ['jpg', 'png', 'gif'];
                if ($.inArray(ext1, ext) == -1) {
                    $("#msgimg").text('Extention Is not valide');

                    event.preventDefault();
                    return false;
                }
               // $('#msgimg').text('image is not select');
               // event.preventDefault();
               // return false;

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