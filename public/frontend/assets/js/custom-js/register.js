$(function () {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    const inputs = document.querySelectorAll(".otp-field > input");

    window.addEventListener("load", () => inputs[0].focus());
    $("#submitBtn").prop('disabled', true);

    inputs[0].addEventListener("paste", function(event) {
        event.preventDefault();

        const pastedValue = (event.clipboardData || window.clipboardData).getData(
            "text"
        );
        const otpLength = inputs.length;

        for (let i = 0; i < otpLength; i++) {
            if (i < pastedValue.length) {
                inputs[i].value = pastedValue[i];
                inputs[i].removeAttribute("disabled");
                inputs[i].focus;
            } else {
                inputs[i].value = ""; // Clear any remaining inputs
                inputs[i].focus;
            }
        }
    });

    inputs.forEach((input, index1) => {
        input.addEventListener("keyup", (e) => {
            const currentInput = input;
            const nextInput = input.nextElementSibling;
            const prevInput = input.previousElementSibling;

            if (currentInput.value.length > 1) {
                currentInput.value = "";
                return;
            }

            if (
                nextInput &&
                nextInput.hasAttribute("disabled") &&
                currentInput.value !== ""
            ) {
                nextInput.removeAttribute("disabled");
                nextInput.focus();
            }

            if (e.key === "Backspace") {
                inputs.forEach((input, index2) => {
                    if (index1 <= index2 && prevInput) {
                        input.setAttribute("disabled", true);
                        $('#otpError').html('');
                        input.value = "";
                        prevInput.focus();
                    }
                });
            }

            $("#submitBtn").prop('disabled', true);

            const inputsNo = inputs.length;
            if (!inputs[inputsNo - 1].disabled && inputs[inputsNo - 1].value !== "") {
                $('#otpError').html('');
                $('#otp').val($('.otpField').map(function() {
                    return $(this).val();
                }).get().join(''));
                $("#submitBtn").prop('disabled', false);
                $('#candidateOtp').submit();
                return;
            }
        });
    });

    $.validator.addMethod("emailCheck", function (value, element) {
        return this.optional(element) || value == value.match(/\b[A-Z0-9._%+-]+@[A-Z0-9.-]+\.[A-Z]{2,4}\b/i);
    });

    $.validator.addMethod("alpha", function(value, element) {
        return this.optional(element) || value == value.match(/^[a-zA-Z\s]+$/);
    });

    $("#verifyEmailForm").validate({
        rules: {
            first_name: {
                required: true,
                minlength: 2,
                alpha: true,
                maxlength: 100,
            },
            last_name: {
                required: true,
                minlength: 1,
                alpha: true,
                maxlength: 100,
            },
            email: {
                required: true,
                emailCheck: true,
            }
        },
        messages: {
            first_name: {
                required: "Please enter first name",
                alpha: "Please enter only characters",
                maxlength: "First name must be less than 100 characters",
            },
            last_name: {
                required: "Please enter last name",
                alpha: "Please enter only characters",
                maxlength: "Last name must be less than 100 characters",
            },
            email: {
                required: "Please enter email address",
                emailCheck: "Please enter a valid email address",
            }
        },
        errorClass: "error is-invalid",
        errorElement: "span",
        submitHandler: function () {
            var href = $('#verifyEmailForm').attr('action');
            var serializeData = $('#verifyEmailForm').serialize();
            $.ajax({
                type: 'POST',
                url: href,
                data: serializeData,
                beforeSend: function () {
                    $('#preloader').show();
                },
                success: function (res) {
                    if (res.status == true) {
                        $('#sentOtpMsg').html(res.msg);
                        $('#showEmail').val(res.email);
                        $('#candidateOtp').removeClass('d-none');
                        $('#candidateLogin').addClass('d-none');
                    } else if (res.status == 'Invalid_User') {
                        $('#emailError').html(res.msg);
                    } else if (res.status == '2'){
                        $("#captchaError").html(res.msg);
                    }  else {
                        $.notify({
                            message: res.msg
                        }, {
                            type: 'danger'
                        });
                    }
                },
                complete: function () {
                    $('#preloader').hide();
                },
                error: function (err) {
                    $("#preloader").hide();
                    if (err.status == 422) {
                        $errResponse = JSON.parse(err.responseText);
                        $.each($errResponse.errors, function (key, value) {
                            console.log(key + "----" + value)
                            $("#l_error_" + key).html(value)
                        })

                    }
                }
            });
        }
    });
});
