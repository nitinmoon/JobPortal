$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});
$("document").ready(function() {
    $.validator.addMethod("alphanum", function(value, element) {
        return this.optional(element) || value == value.match(/^[a-zA-Z0-9\s]+$/);
    });
    $.validator.addMethod("alphanumsymbol", function(value, element) {
        return this.optional(element) || value == value.match(/^[a-zA-Z0-9-.+:;!*@#$%&_=|'"?,/()\s]+$/);
    });
    $.validator.addMethod("emailCheck", function( value, element ) {
        return this.optional( element ) || value == value.match(/\b[A-Z0-9._%+-]+@[A-Z0-9.-]+\.[A-Z]{2,4}\b/i);
    });

    $.validator.addMethod("alpha", function(value, element) {
        return this.optional(element) || value == value.match(/^[a-zA-Z\s]+$/);
   });

    $("#login-form").validate({
        rules: {
            email: {
                required: false,
                emailCheck: false,
            },
            password: {
                required: false,
                minlength: 6,
                maxlength: 12
            }
        },
        messages: {
            email: {
                required: "Please enter email.",
                emailCheck: "Please enter a valid email address.",
            },
            password: {
                required: "Please enter password.",
            },
        },
        errorClass: "text-danger is-invalid",
        errorElement: "label",
        submitHandler: function() {
            var href = $('#login-form').attr('action');
            var serializeData = $('#login-form').serialize();
            $.ajax({
                type: 'POST',
                url: href,
                data: serializeData,
                beforeSend: function() {
                    $('#preloader').show();
                },
                success: function(res) {
                    if (res.status == true) {
                        setTimeout(() => {
                            window.location = res.redirectRoute;
                        }, 3000);
                        $.notify({
                            message: res.msg
                        },{
                            type: 'success'
                        });
                    } else if(res.status == '2') {
                        $.notify({
                            message: res.msg
                        },{
                            type: 'danger'
                        });
                    } else if(res.status == '3') {
                        $('#error_password').html(res.msg)
                    } else if (res.status == '4'){
                        $("#captchaError").html(res.msg);
                    } else {
                        $.notify({
                            message: res.msg
                        },{
                            type: 'danger'
                        });
                    }
                },
                complete: function() {
                    $('#preloader').hide();
                },
                error: function(err) {
                    $("#preloader").hide();
                    if (err.status == 422) {
                        $errResponse = JSON.parse(err.responseText);
                        $.each($errResponse.errors, function(key, value) {
                            console.log(key + "----" + value)
                            $("#error_" + key).html(value)
                        })

                    }
                }
            });
        }
    });

    $(".login-input").keypress(function() {
        $('#error_email').html('');
        $('#error_password').html('');
    });

    $(".f_input").keypress(function() {
        $('#error_email').html('');
    });

    $("#forgot-form").validate({
        rules: {
            email: {
                required: false,
                emailCheck: false,
            },
        },
        messages: {
            email: {
                required: "Please enter email.",
                emailCheck: "Please enter a valid email address.",
            },
        },
        errorClass: "text-danger is-invalid",
        errorElement: "label",
        submitHandler: function() {
            var href = $('#forgot-form').attr('action');
            var serializeData = $('#forgot-form').serialize();
            $('#submit').html('Sending Reset Link...');
            $.ajax({
                type: 'POST',
                url: href,
                data: serializeData,
                beforeSend: function() {
                    $('#preloader').show();
                },
                success: function(res) {
                    if (res.status == true) {
                        $('#submit').html('Email Password Reset Link');
                        $.notify({
                            message: res.msg
                        },{
                            type: 'success'
                        });
                    } else if(res.status == '2') {
                        $('#submit').html('Email Password Reset Link');
                        $.notify({
                            message: res.msg
                        },{
                            type: 'danger'
                        });
                    } else if(res.status == '3') {
                        $('#submit').html('Email Password Reset Link');
                        $.notify({
                            message: res.msg
                        },{
                            type: 'success'
                        });
                    } else {
                        $('#submit').html('Email Password Reset Link');
                        $.notify({
                            message: res.msg
                        },{
                            type: 'danger'
                        });
                    }
                },
                complete: function() {
                    $('#preloader').hide();
                },
                error: function(err) {
                    $('#submit').html('Email Password Reset Link');
                    if (err.status == 422) {
                        $errResponse = JSON.parse(err.responseText);
                        $.each($errResponse.errors, function(key, value) {
                            console.log(key + "----" + value)
                            $("#error_" + key).html(value)
                        })

                    }
                }
            });
        }
    });

    $(".r_input").keypress(function() {
        $('#error_email').html('');
        $('#error_password').html('');
        $('#error_confirm_password').html('');
    });

    $("#reset-form").validate({
        rules: {
            email: {
                required: true,
                emailCheck: true,
            },
            password: {
                required: true,
                minlength: 6,
            },
            confirm_password: {
                required: true,
                minlength: 6,
                equalTo: "#r_user_password",
            }
        },
        messages: {
            email: {
                required: "Please enter email.",
                emailCheck: "Please enter a valid email address.",
            },
            password: {
                required: "Please enter password.",
                minlength: "Password length must be greater than 6 characters.",
            },
            confirm_password: {
                required: "Please enter confirm password.",
                minlength: "Password length must be greater than 6 characters.",
                equalTo: "Confirm password should match with password.",
            },
        },
        errorClass: "text-danger is-invalid",
        errorElement: "label",
        submitHandler: function() {

            var href = $('#reset-form').attr('action');
            var serializeData = $('#reset-form').serialize();
            $("#preloader").show();
            $.ajax({
                type: 'POST',
                url: href,
                data: serializeData,
                beforeSend: function() {
                    $('#preloader').show();
                },
                success: function(res) {
                    if (res.status == true) {
                        setTimeout(() => {
                            window.location = res.redirectRoute;
                        }, 1000);
                        $.notify({
                            // options
                            message: res.msg
                        },{
                            // settings
                            type: 'success'
                        });
                    } else {
                        $.notify({
                            // options
                            message: res.msg
                        },{
                            // settings
                            type: 'danger'
                        });
                    }
                },
                complete: function() {
                    $('#preloader').hide();
                },
                error: function(err) {
                    $("#preloader").hide();
                    if (err.status == 422) {
                        $errResponse = JSON.parse(err.responseText);
                        $.each($errResponse.errors, function(key, value) {
                            console.log(key + "----" + value)
                            $("#error_" + key).html(value)
                        })

                    }
                }
            });
        }
    });
});
function recaptchaCallback() {
    $("#captchaError").html("");
};
