$(function() {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    /* Employer delete modal */
    $(document).on('click', '.deleteEmployer', function(e) {
        e.preventDefault();
        var url = $(this).data("url");
        Swal.fire({
        title: 'Delete Employer!',
        text: "Are you sure you want to delete it?",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
            url: url,
            method: 'get',
            success: function(response) {
                console.log(response);
                Swal.fire(
                'Deleted!',
                'Employer deleted successfully.',
                'success'
                )
                $(".employer-table").DataTable().ajax.reload();
            }
            });
        }
        })
    });

    /* Employer restore modal */
    $(document).on('click', '.restoreEmployer', function(e) {
        e.preventDefault();
        var url = $(this).data("url");
        Swal.fire({
            title: 'Restore Employer!',
            text: "Are you sure you want to restore it?",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, restore it!'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: url,
                    method: 'get',
                    success: function(response) {
                        console.log(response);
                        Swal.fire(
                            'Restored!',
                            'Employer restored successfully.',
                            'success'
                        )
                        $(".employer-table").DataTable().ajax.reload();
                    }
                });
            }
        })
    });

    //Change employer Status
    $(document).on('click', '.change-employer-status', function (e) {
        e.preventDefault();
        var status = $(this).is(":checked") ? '1' : '2';
        var employerId = $(this).attr("id");
        var url = $(this).data("url");
        Swal.fire({
            title: 'Change Status!',
            text: "Are you sure you want to change it?",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, change it!'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: url,
                    method: 'POST',
                    data: {
                        "status": status,
                        "employerId": employerId,
                    },
                    beforeSend: function () {
                        $("#preloader").show();
                    },
                    success: function (res) {
                        if (res.status == true) {
                            Toast.create({
                                title: "Success!",
                                message: res.msg,
                                status: TOAST_STATUS.SUCCESS,
                                timeout: 5000
                            });
                            $(".employer-table").DataTable().ajax.reload();
                        } else {
                            Toast.create({
                                title: "Error!",
                                message: res.msg,
                                status: TOAST_STATUS.DANGER,
                                timeout: 5000
                            });
                        }
                    },
                    complete: function () {
                        $("#preloader").hide();
                    }
                });
            }
        })
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

    $(
        "#phone, #zip, #company_contact_no, #no_of_employees"
    ).keypress(function (event) {
        if (event.which != 8 && isNaN(String.fromCharCode(event.which))) {
            event.preventDefault();
        }
    });

    //Employer Form
    $("#employer-form").validate({
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
            email: {
                required: true,
                emailCheck: true,
            },
            phone: {
                required: true,
                number: true,
                minlength: 10,
            },
            gender: {
                required: true,
            },
            dob: {
                required: true,
            },
            company_address: {
                required: true,
                alphanumsymbol: true,
            },
            zip: {
                required: true,
                number: true,
                minlength: 6,
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
            company_name: {
                required: true,
                minlength: 2,
                alphanumsymbol: true,
                maxlength: 100,
            },
            company_description: {
                required: true,
            }
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
            email: {
                required: "Please enter email address",
                emailCheck: "Please enter a valid email address",
            },
            phone: {
                required: "Please enter phone number",
                number: "Please enter only digits",
                minlength: "Please enter at least 10 digit",
            },
            gender: {
                required: "Please select gender",
            },
            dob: {
                required: "Please select date of birth",
            },
            company_address: {
                required: "Please enter company address",
                alphanumsymbol: "Please enter a valid company address",
            },
            zip: {
                required: "Please enter zip code",
                number: "Please enter only digits",
                minlength: "Please enter at least 6 digit",
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
            company_name: {
                required: "Please enter company name",
                alphanumsymbol: "Please enter valid company name",
                maxlength: "First name must be less than 100 characters",
            },
            company_description: {
                required: "Please enter company description",
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
            if($('#company_description').val() == '') {
                $('#error_company_description').html('Please enter company description');
            }
            var href = $('#employer-form').attr('action');
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
                            timeout: 5000
                        })
                    } else {
                        Toast.create({
                            title: "Error!",
                            message: res.msg,
                            status: TOAST_STATUS.DANGER,
                            timeout: 5000
                        })
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