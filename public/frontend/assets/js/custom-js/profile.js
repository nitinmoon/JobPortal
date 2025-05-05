$(function () {
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

    $("#myProfileForm").validate({
        rules: {
            title: {
                required: true,
            },
            first_name: {
                required: true,
                minlength: 2,
                alpha: true,
                maxlength: 100,
            },
            middle_name: {
                minlength: 1,
                alpha: true,
                maxlength: 100,
            },
            last_name: {
                required: true,
                minlength: 1,
                alpha: true,
                maxlength: 100,
            },
            dob: {
                required: true,
            },
            gender: {
                required: true,
            },
            email: {
                required: true,
                emailCheck: true,
            },
            phone: {
                required: true,
                number: true,
                minlength: 10,
            },
            country_id: {
                required: true,
            },
            state_id: {
                required: true,
            },
            city_id: {
                required: true,
            },
            address: {
                required: true,
                alphanumsymbol: true,
            },
            zip: {
                required: true,
                number: true,
                minlength: 6,
            },
        },
        messages: {
            title: {
                required: "Please select title",
            },
            first_name: {
                required: "Please enter first name",
                alpha: "Please enter only characters",
                maxlength: "First name must be less than 100 characters",
            },
            middle_name: {
                alpha: "Please enter only characters",
                maxlength: "Middle name must be less than 100 characters",
            },
            last_name: {
                required: "Please enter last name",
                alpha: "Please enter only characters",
                maxlength: "Last name must be less than 100 characters",
            },
            dob: {
                required: "Please select date of birth",
            },
            gender: {
                required: "Please select gender",
            },
            email: {
                required: "Please enter email address",
                emailCheck: "Please enter a valid email address",
            },
            phone: {
                required: "Please enter phone number",
                number: "Please enter only digits",
                minlength: "Please enter at least 10 digit",
            },
            country_id: {
                required: "Please select country",
            },
            state_id: {
                required: "Please select state",
            },
            city_id: {
                required: "Please select city",
            },
            address: {
                required: "Please enter address",
                alphanumsymbol: "Please enter a valid address",
            },
            zip: {
                required: "Please enter zip code",
                number: "Please enter only digits",
                minlength: "Please enter at least 6 digit",
            },
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
            var href = $('#myProfileForm').attr('action');
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
                            window.location = res.redirectRoute;
                        }, 3000);
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

    $("#companyProfileForm").validate({
        rules: {
            company_name: {
                required: true,
                minlength: 2,
                alphanumsymbol: true,
                maxlength: 100,
            },
            company_website: {
                required: true,
                validUrl: true,
            },
            company_contact_person: {
                minlength: 2,
                alpha: true,
                maxlength: 100,
            },
            company_contact_email: {
                emailCheck: true,
            },
            company_contact_no: {
                number: true,
                minlength: 10,
            },
            job_category_id: {
                required: true,
            },
            foundation_date: {
                required: true,
            },
            no_of_employees: {
                required: true,
                number: true,
                max: 50,
            },
            gst_no: {
                required: true,
                alphanum:true
            },
            company_description: {
                required: true,
                alphanumsymbol: true,
            },
            country_id: {
                required: true,
            },
            state_id: {
                required: true,
            },
            city_id: {
                required: true,
            },
            zip: {
                required: true,
                number: true,
                minlength: 6,
            },
            company_address: {
                required: true,
                alphanumsymbol: true,
            },
        },
        messages: {
            company_name: {
                required: "Please enter company name",
                minlength: "Please enter at least 2 characters",
                alphanumsymbol: "Please enter valid company name",
                maxlength: "Company name must be less than 100 characters",
            },
            company_website: {
                required: "Please enter company website",
                validUrl: "Please enter valid company website",
            },
            company_contact_person: {
                minlength: "Please enter at least 2 characters",
                alpha: "Please enter valid name",
                maxlength: "Name must be less than 100 characters",
            },
            company_contact_email: {
                emailCheck: "Please enter valid email",
            },
            company_contact_no: {
                number: "Please enter only digits",
                minlength: "Please enter at least 10 digits",
            },
            job_category_id: {
                required: "Please select job category",
            },
            foundation_date: {
                required: "Please select foundation date",
            },
            no_of_employees: {
                required: "Please enter no of employees",
                number: "Please enter only digits",
                max: "Employees must be less than 50",
            },
            gst_no: {
                required: "Please enter GST number",
                alphanum:"Please enter valid GST number"
            },
            company_description: {
                required: "Please enter company description",
                alphanumsymbol: "Please valid company description",
            },
            country_id: {
                required: "Please select country",
            },
            state_id: {
                required: "Please select state",
            },
            city_id: {
                required: "Please select city",
            },
            zip: {
                required: "Please enter zip",
                number: "Please enter only digits",
                minlength: "Please enter at least 6 digits",
            },
            company_address: {
                required:  "Please enter company address",
                alphanumsymbol: "Please enter valid company address",
            },
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
            var href = $('#companyProfileForm').attr('action');
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
                            window.location = res.redirectRoute;
                        }, 3000);
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

    $('#profileImageInput').change(function() {
        const [file] = this.files;
        if (file) {
            document.getElementById("profilePreview").src = URL.createObjectURL(file);
            $('#updateProfileBtn').removeClass('d-none');
        }
    });

    $("#updateCandidateProfile").validate({
        rules: {
            profile_photo: {
                accept: "jpg,png,jpeg,gif"
            }
        },
        messages: {
            profile_photo: {
                accept: "Only image types jpg, png, jpeg, gif are allowed",
            }
        },
        errorClass: "text-danger is-invalid",
        errorElement: "label",
        errorPlacement: function (error, element) {
            var placement = $(element).data('error');
            if (placement) {
                $(placement).append(error);
            } else {
                error.insertAfter(element);
            }
        },
        submitHandler: function (form, event) {
            event.preventDefault();

            var formData = new FormData(form);
            var actionUrl = $(form).attr('action');
            var userId = "{{ auth()->user()->id }}";

            $.ajax({
                url: actionUrl,
                type: 'POST',
                data: formData,
                contentType: false,
                processData: false,
                beforeSend: function () {
                    $('#updateProfileBtn').prop('disabled', true).text('Updating...');
                },
                success: function (res) {
                    console.log(res);
                    if (res.status === true) {
                        Toast.create({
                            title: "Success!",
                            message: res.msg,
                            status: TOAST_STATUS.SUCCESS,
                            timeout: 5000,
                        });
                        location.reload();
                        $('#updateProfileBtn').addClass('d-none')
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
                    $('#updateProfileBtn').prop('disabled', false).text('Update Profile');
                },
                error: function (err) {
                    if (err.status == 422) {
                        let errors = err.responseJSON.errors;
                        $.each(errors, function (key, value) {
                            let errorField = $(`[name="${key}"]`);
                            errorField.addClass('is-invalid');
                            errorField.after(`<label class="text-danger">${value}</label>`);
                        });
                    }
                }
            });
        }
    });

    $('#logoImageInput').change(function() {
        const [file] = this.files;
        if (file) {
            document.getElementById("logoPreview").src = URL.createObjectURL(file);
            $('#updateLogoBtn').removeClass('d-none');
        }
    });

    $("#updateCompanyLogo").validate({
        rules: {
            company_logo: {
                accept: "jpg,png,jpeg,gif"
            }
        },
        messages: {
            company_logo: {
                accept: "Only image types jpg, png, jpeg, gif are allowed",
            }
        },
        errorClass: "text-danger is-invalid",
        errorElement: "label",
        errorPlacement: function (error, element) {
            var placement = $(element).data('error');
            if (placement) {
                $(placement).append(error);
            } else {
                error.insertAfter(element);
            }
        },
        submitHandler: function (form, event) {
            event.preventDefault();

            var formData = new FormData(form);
            var actionUrl = $(form).attr('action');

            $.ajax({
                url: actionUrl,
                type: 'POST',
                data: formData,
                contentType: false,
                processData: false,
                beforeSend: function () {
                    $('#updateLogoBtn').prop('disabled', true).text('Updating...');
                },
                success: function (res) {
                    console.log(res);
                    if (res.status === true) {
                        Toast.create({
                            title: "Success!",
                            message: res.msg,
                            status: TOAST_STATUS.SUCCESS,
                            timeout: 5000,
                        });
                        location.reload();
                        $('#updateLogoBtn').addClass('d-none')
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
                    $('#updateLogoBtn').prop('disabled', false).text('Update');
                },
                error: function (err) {
                    if (err.status == 422) {
                        let errors = err.responseJSON.errors;
                        $.each(errors, function (key, value) {
                            let errorField = $(`[name="${key}"]`);
                            errorField.addClass('is-invalid');
                            errorField.after(`<label class="text-danger">${value}</label>`);
                        });
                    }
                }
            });
        }
    });
});