
$(function() {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    //Add Job Type
    $(document).on('click', '.add-job-type', function() {
        var url = $(this).data("url");
        $.ajax({
            url: url,
            dataType: 'json',
            success: function(res) {
                var data = res.body;
                $('#add_job_type').modal('show');
                $('.modal-title').html('Add Job Type');
                $('#job_type_body').html(data);
            },
            error: function(request, status, error) {
                console.log("ajax call went wrong:" + request.responseText);
            }
        });
    });

    //Edit Job Type
    $(document).on('click', '.edit-job-type', function() {
        var url = $(this).data("url");
        $.ajax({
            url: url,
            dataType: 'json',
            success: function(res) {
                var data = res.body;
                $('#add_job_type').modal('show');
                $('.modal-title').html('Edit Job Type');
                $('#job_type_body').html(data);
            },
            error: function(request, status, error) {
                console.log("ajax call went wrong:" + request.responseText);
            }
        });
    });

    //Change Job Type Status
    $(document).on('click', '.change-job-type-status', function (e) {
        e.preventDefault();
        var status = $(this).is(":checked") ? '1' : '2';
        var jobTypeId = $(this).attr("id");
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
                        "jobTypeId": jobTypeId,
                    },
                    beforeSend: function () {
                        $("#preloader").show();
                    },
                    success: function (res) {
                        if (res.status == true) {
                            $.notify({
                                message: res.msg
                            }, {
                                type: 'success'
                            });
                            $(".job-type-table").DataTable().ajax.reload();
                        }
                    },
                    complete: function () {
                        $("#preloader").hide();
                    }
                });
            }
        })
    });

     /* Job type delete modal */
     $(document).on('click', '.deleteJobType', function(e) {
        e.preventDefault();
        var url = $(this).data("url");
        Swal.fire({
        title: 'Delete Job Type!',
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
                'Job type deleted successfully.',
                'success'
                )
                $(".job-type-table").DataTable().ajax.reload();
            }
            });
        }
        })
    });

    /* Job type restore modal */
    $(document).on('click', '.restoreJobType', function(e) {
        e.preventDefault();
        var url = $(this).data("url");
        Swal.fire({
            title: 'Restore Job Type!',
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
                            'Job type restored successfully.',
                            'success'
                        )
                        $(".job-type-table").DataTable().ajax.reload();
                    }
                });
            }
        })
    });
});