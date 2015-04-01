// Uses jquery syntax.
// These functions do some basic client-side validation and then submit the forms.
// Server-Side validation should still be done.

$(document).ready(function () {

    $('#buttonLogin').click(function () {
        $('#loginform').submit();
    });

    $('#buttonRegister').click(function () {
        $('#registerform').submit();
    });
});


(function ($, W, D)
{
    var JQUERY4U = {};

    JQUERY4U.UTIL =
            {
                setupFormValidation: function ()
                {
                    //form validation rules
                    $("#registerform").validate({
                        rules: {
                            firstname: {
                                required: true,
                                minlength: 2
                            },
                            lastname: {
                                required: true,
                                minlength: 2
                            },
                            emailreg: {
                                required: true,
                                email: true
                            },
                            passwordreg1: {
                                required: true,
                                minlength: 5
                            },
                        },
                        messages: {
                            firstname: {
                                required: "Please provide a first name",
                                minlength: "Your first name must be at least 5 characters long"
                            },
                            lastname: {
                                required: "Please provide a last name",
                                minlength: "Your last name must be at least 5 characters long"
                            },
                            passwordreg1: {
                                required: "Please provide a password",
                                minlength: "Your password must be at least 5 characters long"
                            },
                            emailreg: "Please enter a valid email address",
                        },
                        submitHandler: function (form) {
                            form.submit();
                        }
                    });
                }
            }

    //when the dom has loaded setup form validation rules
    $(D).ready(function ($) {
        JQUERY4U.UTIL.setupFormValidation();
    });

})(jQuery, window, document);