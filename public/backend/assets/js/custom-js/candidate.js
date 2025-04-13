$(function() {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    /* Candidate delete modal */
    $(document).on('click', '.deleteCandidate', function(e) {
        e.preventDefault();
        var url = $(this).data("url");
        Swal.fire({
        title: 'Delete Candidate!',
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
                'Candidate deleted successfully.',
                'success'
                )
                $(".candidate-table").DataTable().ajax.reload();
            }
            });
        }
        })
    });

    /* Candidate restore modal */
    $(document).on('click', '.restoreCandidate', function(e) {
        e.preventDefault();
        var url = $(this).data("url");
        Swal.fire({
            title: 'Restore Candidate!',
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
                            'Candidate restored successfully.',
                            'success'
                        )
                        $(".candidate-table").DataTable().ajax.reload();
                    }
                });
            }
        })
    });

    //Change candidate Status
    $(document).on('click', '.change-candidate-status', function (e) {
        e.preventDefault();
        var status = $(this).is(":checked") ? '1' : '0';
        var candidateId = $(this).attr("id");
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
                        "candidateId": candidateId,
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
                            $(".candidate-table").DataTable().ajax.reload();
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

    var start = moment().subtract(29, 'days');
    var end = moment();
    $('#startDate').val(start.format('YYYY-MM-DD'));
    $('#endDate').val(end.format('YYYY-MM-DD'));
    $('#candidateDateRange span').html(start.format('MMM D, YYYY') + ' - ' + end.format('MMM D, YYYY'));

    function cb(start, end) {
        $('#candidateDateRange span').html(start.format('MMM D, YYYY') + ' - ' + end.format('MMM D, YYYY'));
    }
    cb(start, end);

    $('#candidateDateRange').daterangepicker({
        startDate: start,
        endDate: end,
        maxDate: new Date(),
        ranges: {
            'Today': [moment(), moment()],
            'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
            'This Week': [moment().startOf('week'), moment().endOf('week')],
            'Last 7 Days': [moment().subtract(6, 'days'), moment()],
            'Last 30 Days': [moment().subtract(29, 'days'), moment()],
            'This Month': [moment().startOf('month'), moment().endOf('month')],
            'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')],
            'Last 6 Month': [moment().subtract(6, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')],
            'Current Year': [moment().startOf('year'), moment().endOf('year')]
        },
        "startDate": start,
        "endDate": end
    }, cb).on('apply.daterangepicker', function(e, picker) {

        var startDate = picker.startDate.format('YYYY-MM-DD');
        var endDate = picker.endDate.format('YYYY-MM-DD');
        $('#startDate').val(startDate);
        $('#endDate').val(endDate);

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
                $('.modal-title').html('<i class="bi bi-eye"></i> <strong>View Resume</strong>&emsp;&emsp;' + downloadBtn);
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