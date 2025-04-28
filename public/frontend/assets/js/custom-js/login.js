$(function () {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $.validator.addMethod("emailCheck", function (value, element) {
        return this.optional(element) || value == value.match(/\b[A-Z0-9._%+-]+@[A-Z0-9.-]+\.[A-Z]{2,4}\b/i);
    });

    $.validator.addMethod("alpha", function(value, element) {
        return this.optional(element) || value == value.match(/^[a-zA-Z\s]+$/);
    });

    $("#loginForm").validate({
        rules: {
            email: {
                required: true,
                emailCheck: true,
            },
            password: {
                required: true,
                minlength: 6,
                maxlength: 12,
            },
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
        submitHandler: function () {
            var href = $("#loginForm").attr("action");
            var serializeData = $("#loginForm").serialize();
            // if (grecaptcha.getResponse() == "") {
            //     $("#captchaError").html("Please check on the reCAPTCHA box.");
            //     return false;
            // }
            $.ajax({
                type: "POST",
                url: href,
                data: serializeData,
                beforeSend: function () {
                    $("#preloader").show();
                },
                success: function (res) {
                    if (res.status == true) {
                        setTimeout(() => {
                            window.location = res.redirectRoute;
                        }, 3000);
                        Toast.create({
                            title: "Success!",
                            message: res.msg,
                            status: TOAST_STATUS.SUCCESS,
                            timeout: 5000,
                        });
                    } else if (res.status == "2") {
                        Toast.create({
                            title: "Error!",
                            message: res.msg,
                            status: TOAST_STATUS.DANGER,
                            timeout: 5000,
                        });
                    } else if (res.status == "3") {
                        $("#error_password").html(res.msg);
                        $("#loginSubmitBtn").prop("disabled", true);
                    } else if (res.status == "4") {
                        $("#captchaError").html(res.msg);
                    } else {
                        Toast.create({
                            title: "Error!",
                            message: res.msg,
                            status: TOAST_STATUS.DANGER,
                            timeout: 5000,
                        });
                    }
                },
                complete: function () {
                    $("#preloader").hide();
                },
                error: function (err) {
                    $("#preloader").hide();
                    if (err.status == 422) {
                        $errResponse = JSON.parse(err.responseText);
                        $.each($errResponse.errors, function (key, value) {
                            console.log(key + "----" + value);
                            $("#error_" + key).html(value);
                        });
                    }
                },
            });
        },
    });

    $(".login-input").keypress(function () {
        $("#error_email").html("");
        $("#error_password").html("");
    });

    $(".login-pass").change(function () {
        grecaptcha.reset();
        $("#error_password").html("");
        $("#loginSubmitBtn").prop("disabled", false);
    });

    $("#email").change(function () {
        grecaptcha.reset();
    });
});

function recaptchaCallback() {
    $("#captchaError").html("");
}
