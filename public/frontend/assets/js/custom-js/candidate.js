$(function() {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $.validator.addMethod("alphanum", function (value, element) {
        return this.optional(element) || value == value.match(/^[a-zA-Z0-9\s]+$/);
    });
    $.validator.addMethod("alphanumsymbol", function (value, element) {
        return this.optional(element) || value == value.match(/^[a-zA-Z0-9-.+:;!*@#$%&_=|'"?,/()\s]+$/);
    });
    $.validator.addMethod("emailCheck", function (value, element) {
        return this.optional(element) || value == value.match(/\b[A-Z0-9._%+-]+@[A-Z0-9.-]+\.[A-Z]{2,4}\b/i);
    });

    $.validator.addMethod("alpha", function (value, element) {
        return this.optional(element) || value == value.match(/^[a-zA-Z\s]+$/);
    });

    $.validator.addMethod("validUrl", function(value, element) {
        return this.optional(element) || /^(https?:\/\/)?([\w\-])+(\.[\w\-]+)+[/#?]?.*$/.test(value);
    }, "Please enter a valid URL.");

    $(
        "#phone, #zip, #company_contact_no, #no_of_employees"
    ).keypress(function (event) {
        if (event.which != 8 && isNaN(String.fromCharCode(event.which))) {
            event.preventDefault();
        }
    });

    $("#editResumeHeadlineForm").validate({
        rules: {
            resume_headline: {
                required: true,
                minlength: 2,
                alphanumsymbol: true,
                maxlength: 255,
            }
        },
        messages: {
            resume_headline: {
                required: "Please enter resume headline",
                alphanumsymbol: "Please enter only characters",
                maxlength: "Resume headline must be less than 255 characters",
            }
        },
        errorClass: "error is-invalid",
        errorElement: "label",
        errorPlacement: function (error, element) {
            var placement = $(element).data("error");
            if (placement) {
                $(placement).append(error);
            } else {
                error.insertAfter(element);
            }
        },
        submitHandler: function (form) {
            var href = $('#editResumeHeadlineForm').attr('action');
            var formData = new FormData(form);
            $(".error").html('');
            $.ajax({
                type: 'POST',
                url: href,
                data: formData,
                contentType: false,
                processData: false,
                beforeSend: function () {
                    $('#preloader').show();
                },
                success: function (res) {
                    if (res.status == true) {
                        setTimeout(() => {
                            location.href = res.redirectRoute;
                        }, 2000);
                        Toast.create({
                            title: "Success!",
                            message: res.msg,
                            status: TOAST_STATUS.SUCCESS,
                            timeout: 5000,
                        });
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
                    $('#preloader').hide();
                },
                error: function (err) {
                    $("#preloader").hide();
                    if (err.status == 422) {
                        $errResponse = JSON.parse(err.responseText);
                        $.each($errResponse.errors, function (key, value) {
                            console.log(key + "----" + value)
                            $("#error_" + key).html(value)
                        })

                    }
                }
            });
        }
    });

    $("#editSkillsForm").validate({
        rules: {
            'skills[]': {
                required: true
            }
        },
        messages: {
            'skills[]': {
                required: "Please select skills"
            }
        },
        errorClass: "error is-invalid",
        errorElement: "label",
        errorPlacement: function (error, element) {
            var placement = $(element).data("error");
            if (placement) {
                $(placement).append(error);
            } else {
                error.insertAfter(element);
            }
        },
        submitHandler: function (form) {
            var href = $('#editResumeHeadlineForm').attr('action');
            var formData = new FormData(form);
            $(".error").html('');
            $.ajax({
                type: 'POST',
                url: href,
                data: formData,
                contentType: false,
                processData: false,
                beforeSend: function () {
                    $('#preloader').show();
                },
                success: function (res) {
                    if (res.status == true) {
                        setTimeout(() => {
                            location.href = res.redirectRoute;
                        }, 2000);
                        Toast.create({
                            title: "Success!",
                            message: res.msg,
                            status: TOAST_STATUS.SUCCESS,
                            timeout: 5000,
                        });
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
                    $('#preloader').hide();
                },
                error: function (err) {
                    $("#preloader").hide();
                    if (err.status == 422) {
                        $errResponse = JSON.parse(err.responseText);
                        $.each($errResponse.errors, function (key, value) {
                            console.log(key + "----" + value)
                            $("#error_" + key).html(value)
                        })

                    }
                }
            });
        }
    });

    $("#editProfileSummaryForm").validate({
        rules: {
            profile_summary: {
                required: true
            }
        },
        messages: {
            profile_summary: {
                required: "Please enter summary"
            }
        },
        errorClass: "error is-invalid",
        errorElement: "label",
        errorPlacement: function (error, element) {
            var placement = $(element).data("error");
            if (placement) {
                $(placement).append(error);
            } else {
                error.insertAfter(element);
            }
        },
        submitHandler: function (form) {
            var href = $('#editProfileSummaryForm').attr('action');
            var formData = new FormData(form);
            $(".error").html('');
            $.ajax({
                type: 'POST',
                url: href,
                data: formData,
                contentType: false,
                processData: false,
                beforeSend: function () {
                    $('#preloader').show();
                },
                success: function (res) {
                    if (res.status == true) {
                        setTimeout(() => {
                            location.href = res.redirectRoute;
                        }, 2000);
                        Toast.create({
                            title: "Success!",
                            message: res.msg,
                            status: TOAST_STATUS.SUCCESS,
                            timeout: 5000,
                        });
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
                    $('#preloader').hide();
                },
                error: function (err) {
                    $("#preloader").hide();
                    if (err.status == 422) {
                        $errResponse = JSON.parse(err.responseText);
                        $.each($errResponse.errors, function (key, value) {
                            console.log(key + "----" + value)
                            $("#error_" + key).html(value)
                        })

                    }
                }
            });
        }
    });

    $("#editCareerProfileForm").validate({
        rules: {
            job_category_id: {
                required: true
            },
            designation_id: {
                required: true
            },
            job_type_id: {
                required: true
            },
            work_type_id: {
                required: true
            },
            current_salary: {
                required: true
            }
        },
        messages: {
            job_category_id: {
                required: "Please select job category"
            },
            designation_id: {
                required: "Please select designation"
            },
            job_type_id: {
                required: "Please select job type"
            },
            work_type_id: {
                required: "Please select work type"
            },
            current_salary: {
                required: "Please enter current salary"
            }
        },
        errorClass: "error is-invalid",
        errorElement: "label",
        errorPlacement: function (error, element) {
            var placement = $(element).data("error");
            if (placement) {
                $(placement).append(error);
            } else {
                error.insertAfter(element);
            }
        },
        submitHandler: function (form) {
            var href = $('#editCareerProfileForm').attr('action');
            var formData = new FormData(form);
            $(".error").html('');
            $.ajax({
                type: 'POST',
                url: href,
                data: formData,
                contentType: false,
                processData: false,
                beforeSend: function () {
                    $('#preloader').show();
                },
                success: function (res) {
                    if (res.status == true) {
                        setTimeout(() => {
                            location.href = res.redirectRoute;
                        }, 2000);
                        Toast.create({
                            title: "Success!",
                            message: res.msg,
                            status: TOAST_STATUS.SUCCESS,
                            timeout: 5000,
                        });
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
                    $('#preloader').hide();
                },
                error: function (err) {
                    $("#preloader").hide();
                    if (err.status == 422) {
                        $errResponse = JSON.parse(err.responseText);
                        $.each($errResponse.errors, function (key, value) {
                            console.log(key + "----" + value)
                            $("#error_" + key).html(value)
                        })

                    }
                }
            });
        }
    });

    $("#uploadResumeForm").validate({
        rules: {
            resume_file: {
                required: true
            }
        },
        messages: {
            resume_file: {
                required: "Please upload resume"
            }
        },
        errorClass: "error is-invalid",
        errorElement: "label",
        errorPlacement: function (error, element) {
            var placement = $(element).data("error");
            if (placement) {
                $(placement).append(error);
            } else {
                error.insertAfter(element);
            }
        },
        submitHandler: function (form) {
            var href = $('#uploadResumeForm').attr('action');
            var formData = new FormData(form);
            $(".error").html('');
            $.ajax({
                type: 'POST',
                url: href,
                data: formData,
                contentType: false,
                processData: false,
                beforeSend: function () {
                    $('#preloader').show();
                },
                success: function (res) {
                    if (res.status == true) {
                        setTimeout(() => {
                            location.href = res.redirectRoute;
                        }, 2000);
                        Toast.create({
                            title: "Success!",
                            message: res.msg,
                            status: TOAST_STATUS.SUCCESS,
                            timeout: 5000,
                        });
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
                    $('#preloader').hide();
                },
                error: function (err) {
                    $("#preloader").hide();
                    if (err.status == 422) {
                        $errResponse = JSON.parse(err.responseText);
                        $.each($errResponse.errors, function (key, value) {
                            console.log(key + "----" + value)
                            $("#error_" + key).html(value)
                        })

                    }
                }
            });
        }
    });
});