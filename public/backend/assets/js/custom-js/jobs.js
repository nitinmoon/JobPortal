$(function () {

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $('.js-example-basic-single').select2();

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

    if($('#jobId').val() != 0) {
        var experience = $(".experience:checked").val();
        selectExperience(experience);
        $('#salary_range').change(function() {
            var salary = $(this).val();
            var yearlySalary = Number(salary) * Number(12);
            $('#yearlySalary').html('( ₹ '+ yearlySalary + ' / Year )');
        }).change();
    }

    $('#salary_range').change(function() {
        var salary = $(this).val();
        var yearlySalary = Number(salary) * Number(12);
        $('#yearlySalary').html('( ₹ '+ yearlySalary + ' / Year )');
    });

    $('.experience').click(function() {
        var experience = $(this).val();
        selectExperience(experience);
    });

    $("#yearExperience, #monthExperience, #salary_range").keypress(function (event) {
        if (event.which != 8 && isNaN(String.fromCharCode(event.which))) {
            event.preventDefault();
        }
    });

    $("#job-form").validate({
        rules: {
            job_title: {
                required: true,
                alphanumsymbol: true,
            },
            job_category_id: {
                required: true
            },
            job_type_id: {
                required: true
            },
            country_id: {
                required: function () {
                    return $("#work_type_id").val() == 1 ? false : true;
                }
            },
            state_id: {
                required: function () {
                    return $("#work_type_id").val() == 1 ? false : true;
                }
            },
            city_id: {
                required: function () {
                    return $("#work_type_id").val() == 1 ? false : true;
                }
            },
            experience: {
                required: true
            },
            year_experience: {
                required: function () {
                    return ($("#yearExperience").val() == '' && $("#monthExperience").val() == '') ? true : false;
                },
            },
            vacancy: {
                required: true,
                min: 1,
                max: 500
            },
        },
        messages: {
            job_title: {
                required: "Please enter job title.",
                alphanumsymbol: "Please enter a valid job title.",
            },
            job_category_id: {
                required: "Please select job category.",
            },
            job_type_id: {
                required: "Please select job type.",
            },
            country_id: {
                required: "Please select country.",
            },
            state_id: {
                required: "Please select state.",
            },
            city_id: {
                required: "Please select city.",
            },
            experience: {
                required: "Please select experience.",
            },
            year_experience: {
                required: "Please enter experience",
            },
            vacancy: {
                required: "Please enter vacancy.",
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
            var href = $('#job-form').attr('action');
            var serializeData = $('#job-form').serialize();
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

    //Change Job Status
    $(document).on('click', '.change-job-status', function (e) {
        e.preventDefault();
        var status = $(this).is(":checked") ? '1' : '0';
        var jobId = $(this).attr("id");
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
                        "jobId": jobId,
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
                            $(".job-list-table").DataTable().ajax.reload();
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

      /* Job delete modal */
      $(document).on('click', '.deleteJob', function(e) {
        e.preventDefault();
        var url = $(this).data("url");
        Swal.fire({
        title: 'Delete Job!',
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
            success: function(res) {
                if (res.status == true) {
                    Toast.create({
                        title: "Success!",
                        message: res.msg,
                        status: TOAST_STATUS.SUCCESS,
                        timeout: 5000
                    });
                } else {
                    Toast.create({
                        title: "Error!",
                        message: res.msg,
                        status: TOAST_STATUS.DANGER,
                        timeout: 5000
                    });
                }
                $(".job-list-table").DataTable().ajax.reload();
            }
            });
        }
        })
    });

    /* Job restore modal */
    $(document).on('click', '.restoreJob', function(e) {
        e.preventDefault();
        var url = $(this).data("url");
        Swal.fire({
            title: 'Restore Job!',
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
                    success: function(res) {
                        if (res.status == true) {
                            Toast.create({
                                title: "Success!",
                                message: res.msg,
                                status: TOAST_STATUS.SUCCESS,
                                timeout: 5000
                            });
                        } else {
                            Toast.create({
                                title: "Error!",
                                message: res.msg,
                                status: TOAST_STATUS.DANGER,
                                timeout: 5000
                            });
                        }
                        $(".job-list-table").DataTable().ajax.reload();
                    }
                });
            }
        })
    });

    //View Resume
    $(document).on('click', '.view-resume', function() {
        var url = $(this).data("url");
        $.ajax({
            url: url,
            dataType: 'json',
            beforeSend: function() {
                $("#preloader").show();
            },
            success: function(res) {
                var data = res.body;
                var downloadBtn = res.downloadBtn;
                $('#viewResumeModal').modal('show');
                $('.modal-title').html('<i class="fa fa-eye"></i> <strong>View Resume</strong>&emsp;&emsp;' + downloadBtn);
                $('#viewResumeBody').html(data);
            },
            complete: function() {
                $("#preloader").hide();
            },
            error: function(request, status, error) {
                console.log("ajax call went wrong:" + request.responseText);
            }
        });
    });
});

function selectExperience(experience) {
    $('#error_experience').html('');
    if (experience == 'Experienced') {
        $('#experienceDiv').removeClass('d-none');
    } else {
        $('#experienceDiv').addClass('d-none');
    }
    if (experience == 'Fresher & Experienced') {
        $('#FresherExpSpan').removeClass('d-none');
    } else {
        $('#FresherExpSpan').addClass('d-none');
    }
    if (experience == 'Fresher') {
        $('#FresherSpan').removeClass('d-none');
    } else {
        $('#FresherSpan').addClass('d-none');
    }
}