$(document).ready(function () {
    $("form").submit(function (event) {

        if ($('#pword').val() == "") {
            $('.response-content').fadeIn();
            $('.response-content').addClass('alert-danger');
            $('.response-content').html(" <strong>Sorry!</strong>  The field 'password' cannot be left blank.");
            $('.response-content').fadeIn(1500).delay(1500).fadeOut(400);
            $("#loginshake").effect("shake");
            event.preventDefault();
            return false;
        }
        if ($('#cpword').val() == "") {
            $('.response-content').fadeIn();
            $('.response-content').addClass('alert-danger');
            $('.response-content').html(" <strong>Sorry!</strong>  The field 'confirm password' cannot be left blank.");
            $('.response-content').fadeIn(1500).delay(1500).fadeOut(400);
            $("#loginshake").effect("shake");
            event.preventDefault();
            return false;
        }if ($('#cpword').val() !== $('#pword').val()) {
            $('.response-content').fadeIn();
            $('.response-content').addClass('alert-danger');
            $('.response-content').html(" <strong>Sorry!</strong>  confirm password does not match");
            $('.response-content').fadeIn(1500).delay(1500).fadeOut(400);
            $("#loginshake").effect("shake");
            event.preventDefault();
            return false;
        }

    });


});
