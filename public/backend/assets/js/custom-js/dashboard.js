$(function() {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    getJobApplyCount('month');

    $('.jobApplyCountFilter').click(function() {
        var duration = $(this).data("id");
        getJobApplyCount(duration);
    });

    function getJobApplyCount(duration) {
        var url = $('#candidateaAppliedRoute').val();
        $.ajax({
            url: url,
            type: 'GET',
            data: {
                'duration': duration,
            },
            delay: 250,
            beforeSend: function() {
                $("#processingLoader").removeClass('d-none');
                $("#teamHoursList").addClass('d-none');
            },
            success: function(data) {
                $('#candidateApplyCount').html(data.totalApplyJobCount);
                if (duration == 'month') {
                    $('#durationType').html('This Month');
                } else if(duration == 'week'){
                    $('#durationType').html('This Week');
                } else {
                    $('#durationType').html('Today');
                }
            },
            complete: function() {
                $("#processingLoader").addClass('d-none');
            }
        });
    }
});