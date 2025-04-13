
$(function() {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    //Add Job Category
    $(document).on('click', '.add-job-category', function() {
        var url = $(this).data("url");
        $.ajax({
            url: url,
            dataType: 'json',
            success: function(res) {
                var data = res.body;
                $('#add_job_category').modal('show');
                $('.modal-title').html('Add Job Category');
                $('#job_category_body').html(data);
            },
            error: function(request, status, error) {
                console.log("ajax call went wrong:" + request.responseText);
            }
        });
    });

    //Edit Job Category
    $(document).on('click', '.edit-job-category', function() {
        var url = $(this).data("url");
        $.ajax({
            url: url,
            dataType: 'json',
            success: function(res) {
                var data = res.body;
                $('#add_job_category').modal('show');
                $('.modal-title').html('Edit Job Category');
                $('#job_category_body').html(data);
            },
            error: function(request, status, error) {
                console.log("ajax call went wrong:" + request.responseText);
            }
        });
    });

    //Change Job Category Status
    $(document).on('click', '.change-job-category-status', function (e) {
        e.preventDefault();
        var status = $(this).is(":checked") ? '1' : '0';
        var jobCategoryId = $(this).attr("id");
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
                        "jobCategoryId": jobCategoryId,
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
                            $(".job-category-table").DataTable().ajax.reload();
                        }
                    },
                    complete: function () {
                        $("#preloader").hide();
                    }
                });
            }
        })
    });

     /* Job Category delete modal */
     $(document).on('click', '.deleteJobCategory', function(e) {
        e.preventDefault();
        var url = $(this).data("url");
        Swal.fire({
        title: 'Delete Job Category!',
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
                'Job category deleted successfully.',
                'success'
                )
                $(".job-category-table").DataTable().ajax.reload();
            }
            });
        }
        })
    });

    /* Job type restore modal */
    $(document).on('click', '.restoreJobCategory', function(e) {
        e.preventDefault();
        var url = $(this).data("url");
        Swal.fire({
            title: 'Restore Job Category!',
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
                            'Job category restored successfully.',
                            'success'
                        )
                        $(".job-category-table").DataTable().ajax.reload();
                    }
                });
            }
        })
    });
});