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

    $.validator.addMethod("alphanumsymbol", function (value, element) {
        return this.optional(element) || value == value.match(/^[a-zA-Z0-9-.+:;!*@#$%&_=|'"?,/()\s]+$/);
    });

    $("#contact-form").validate({
        rules: {
            name: {
                required: true,
                maxlength: 255,
                alpha: true,
            },
            email: {
                required: true,
                emailCheck: true,
            },
            message: {
                required: true,
                alphanumsymbol: true
            },
        },
        messages: {
            name: {
                required: "Please enter name",
                alpha: "Please enter valid name",
            },
            email: {
                required: "Please enter email.",
                emailCheck: "Please enter a valid email address.",
            },
            message: {
                required: "Please enter message.",
                alphanumsymbol: "Please enter a valid message.",
            },
        },
        errorClass: "text-danger is-invalid",
        errorElement: "label",
        errorPlacement: function (error, element) {
            var placement = $(element).data("error");
            if (placement) {
                $(placement).append(error);
            } else {
                error.insertAfter(element);
            }
        },
        submitHandler: function () {
            var href = $("#contact-form").attr("action");
            var serializeData = $("#contact-form").serialize();
            if (grecaptcha.getResponse() == "") {
                $("#captchaError").html("Please check on the reCAPTCHA box.");
                return false;
            }
            $.ajax({
                type: "POST",
                url: href,
                data: serializeData,
                beforeSend: function () {
                    $("#preloader").show();
                },
                success: function (res) {
                    if (res.status == true) {
                        Toast.create({
                            title: "Success!",
                            message: res.msg,
                            status: TOAST_STATUS.SUCCESS,
                            timeout: 8000,
                        });
                        location.reload();
                    } else if (res.status == "2") {
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
});