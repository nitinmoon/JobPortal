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

    $("#forgot-form").validate({
        rules: {
            email: {
                required: true,
                emailCheck: true,
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
                        Toast.create({
                            title: "Success!",
                            message: res.msg,
                            status: TOAST_STATUS.SUCCESS,
                            timeout: 5000,
                        });
                    } else if(res.status == '2') {
                        $('#submit').html('Email Password Reset Link');
                         Toast.create({
                            title: "Error!",
                            message: res.msg,
                            status: TOAST_STATUS.DANGER,
                            timeout: 5000,
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
                        Toast.create({
                            title: "Success!",
                            message: res.msg,
                            status: TOAST_STATUS.SUCCESS,
                            timeout: 5000,
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
});