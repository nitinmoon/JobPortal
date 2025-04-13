$(function () {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    tinymce.init({
        selector: 'textarea.basic-example',
        height: 200,
        menubar: false,
        plugins: "advlist autolink lists link image charmap print preview anchor','searchreplace visualblocks code fullscreen','insertdatetime media table paste code help wordcount",
        toolbar: 'formatselect | undo redo | numlist bullist | bold italic | alignleft aligncenter | alignright alignjustify'
    });

    $.validator.addMethod("alpha", function (value, element) {
        return this.optional(element) || value == value.match(/^[a-zA-Z\s]+$/);
    });

    $.validator.addMethod("emailCheck", function (value, element) {
        return this.optional(element) || value == value.match(/\b[A-Z0-9._%+-]+@[A-Z0-9.-]+\.[A-Z]{2,4}\b/i);
    });

    $.validator.addMethod("alphanumsymbol", function (value, element) {
        return this.optional(element) || value == value.match(/^[a-zA-Z0-9-.+:;!*@#$%&_=|'"?,/()\s]+$/);
    });

    $(
        "#company_contact_no, #no_of_employees, #zip, #phone"
    ).keypress(function (event) {
        if (event.which != 8 && isNaN(String.fromCharCode(event.which))) {
            event.preventDefault();
        }
    });

    //Admin Form
    $("#adminProfileForm").validate({
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
        submitHandler: function () {
            var href = $('#adminProfileForm').attr('action');
            var serializeData = $('#adminProfileForm').serialize();
            $(".error").html('');
            $.ajax({
                type: 'POST',
                url: href,
                data: serializeData,
                beforeSend: function () {
                    $('#preloader').show();
                },
                success: function (res) {
                    if (res.status == true) {
                        setTimeout(() => {
                            location.reload();
                        }, 2000);
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

    //Employer Form
    $("#employerProfileForm").validate({
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
            company_contact_person: {
                required: true,
                minlength: 2,
                alpha: true,
                maxlength: 100,
            },
            company_contact_email: {
                required: true,
                emailCheck: true,
            },
            company_contact_no: {
                required: true,
                number: true,
                minlength: 10,
            },
            foundation_date: {
                required: true,
            },
            no_of_employees: {
                required: true,
                number: true
            },
            gst_no: {
                required: true,
                alphanumsymbol: true
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
            company_contact_person: {
                required: "Please enter contact person name",
                alpha: "Please enter only characters",
                maxlength: "Contact person name must be less than 100 characters",
            },
            company_contact_email: {
                required: "Please enter contact email address",
                emailCheck: "Please enter a valid contact email address",
            },
            company_contact_no: {
                required: "Please enter contact number",
                number: "Please enter only digits",
                minlength: "Please enter at least 10 digit",
            },
            foundation_date: {
                required: "Please select foundation date",
            },
            no_of_employees: {
                required: "Please enter no of employees",
                number: "Please enter only digits"
            },
            gst_no: {
                required: "Please enter GST number",
                alphanumsymbol: "Please enter a valid GST number"
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
        submitHandler: function () {
            if ($('#company_description').val() == '') {
                $('#error_company_description').html('Please enter company description');
                return false;
            }
            var company_description = $('#company_description').val();
            let script = company_description.search("&lt;script&gt;");
            let lessThan = company_description.search("&lt;");
            let greaterThan = company_description.search("&gt;");
            if (script != '-1' || lessThan != '-1' || greaterThan != '-1') {
                $('#error_company_description').html('Please enter valid company description');
                $('#company_description').focus();
                return false;
            }
            var href = $('#employerProfileForm').attr('action');
            var serializeData = $('#employerProfileForm').serialize();
            $(".error").html('');
            $.ajax({
                type: 'POST',
                url: href,
                data: serializeData,
                beforeSend: function () {
                    $('#preloader').show();
                },
                success: function (res) {
                    if (res.status == true) {
                        setTimeout(() => {
                            location.reload();
                        }, 2000);
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
    $("#change-password-action").validate({
        rules: {
            current_password: {
                required: true,
                maxlength: 12,
            },
            password: {
                required: true,
                minlength: 6,
                maxlength: 12,
            },
            confirm_password: {
                required: true,
                minlength: 6,
                maxlength: 12,
                equalTo: "#password",
            }
        },
        messages: {
            current_password: {
                required: "Enter current password",
                alphanumsymbol: "Enter a valid current password",
                maxlength: "Current password must be less than or equal 12 characters",
            },
            password: {
                required: "Enter new password",
                alphanumsymbol: "Enter a valid new password",
                minlength: "Password length must be greater than 6 characters",
                maxlength: "Password must be less than or equal 12 characters",
            },
            confirm_password: {
                required: "Enter confirm password",
                alphanumsymbol: "Enter a valid confirm password",
                minlength: "Password length must be greater than 6 characters",
                equalTo: "Confirm password should match with new password",
                maxlength: "Confirm password must be less than or equal 12 characters",
            },
        },
        errorClass: "text-danger is-invalid",
        errorElement: "label",
        submitHandler: function () {
            var href = $('#change-password-action').attr('action');
            var serializeData = $('#change-password-action').serialize();
            $("#preloader").show();
            $.ajax({
                type: 'POST',
                url: href,
                data: serializeData,
                beforeSend: function () {
                    $("#changePasswordBtn").prop("disabled", true);
                    $('#changePasswordBtn').val('Updating...');
                    $("#preloader").show();
                },
                success: function (res) {
                    $(".error").html('')
                    if (res.status == 1) {
                        $('#changePasswordModal').modal('hide');
                        $.notify({
                            message: res.msg
                        }, {
                            type: 'success'
                        });
                        setTimeout(function () {
                            window.location = res.redirect_url;
                        }, 2000);
                    } else if (res.status == 2) {
                        $("#error_current_password").html(res.msg);
                    } else {
                        $.notify({
                            message: res.msg
                        }, {
                            type: 'error'
                        });
                    }
                },
                complete: function () {
                    $("#changePasswordBtn").prop("disabled", false);
                    $('#changePasswordBtn').val('Update');
                    $("#preloader").hide();
                },
                error: function (err) {
                    if (err.status == 422) {
                        $(".error").html('')
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
function addLoadFile(event) {
    $("#error_company_logo").html("");
    $('.submitBtn').prop('disabled', false);
    var fileInput = document.getElementById('company_logo');
    var fileName = fileInput.files[0].name;
    var fileExtension = fileName.split('.').pop();
    if ( /\.(jpeg|png|jpg)$/i.test(fileName) === false ) {
        $("#error_company_logo").html("Allow only jpg | jpeg | png format");
        $('.submitBtn').prop('disabled', true);
        return false;
    }
        $('#logoPreview').removeClass('d-none');
        var image = document.getElementById("logoPreview");
        image.src = URL.createObjectURL(event.target.files[0]);
    if (event.target.files[0].size >= 2097152) {
        $("#error_company_logo").html("File size must be less than 2 MB");
        $('.submitBtn').prop('disabled', true);
        return false;
    }
}