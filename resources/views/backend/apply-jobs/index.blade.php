@extends('backend.layouts.app')
@section('title', 'Applied Jobs Candidates')
@section('style')
<link rel="stylesheet" href="{{ asset('backend/assets/css/custom-css/switch.css') }}">
@endsection
@section('content')
<div class="pagetitle">
    <h1>Applied Jobs Candidates</h1>
    <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
            <li class="breadcrumb-item active">Applied Jobs Candidates</li>
        </ol>
    </nav>
</div><!-- End Page Title -->

<section class="section dashboard">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body mt-2">
                    <div class="datatable-wrapper datatable-loading no-footer sortable searchable fixed-columns">
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered datatable job-apply-table" style="width: 100%;">
                                <thead>
                                    <tr>
                                        <th style="min-width:50px;">Sr No</th>
                                        <th style="min-width:150px;">Company Name</th>
                                        <th style="min-width:200px;">Candidate Name</th>
                                        <th style="min-width:100px;">Job Title</th>
                                        <th style="min-width:120px;">Applied On</th>
                                        <th style="min-width:120px;">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Profile Area End -->
<div id="viewResumeModal" class="modal custom-modal fade" role="dialog">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"></h5>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <i class="bi bi-x"></i>
                </button>
            </div>
            <div class="modal-body" id="viewResumeBody">
            </div>
        </div>
    </div>
</div>
@endsection
@section('script')
<script src="{{ asset('backend/assets/js/custom-js/jobs.js') }}"></script>
<script>
    $('.js-example-basic-single').select2();
    $(function() {
        var table = $('.job-apply-table').DataTable({
            "aaSorting": [],
            processing: true,
            serverSide: true,
            pageLength: 100,
            "drawCallback": function(settings) {
                $('.js-example-basic-single').select2();
            },
            "bDestroy": true,
            ajax: {
                url: "{{ route('candidateApplyJobsList') }}",
                beforeSend: function() {
                    $('#preloader').show();
                },
                data: function(param) {
                    param.candidate_id = $("#candidate_id").val();
                    param.job_category_id = $("#job_category_id").val();
                    param.job_type_id = $("#job_type_id").val();
                    param.status = $("#status").val();
                    param.applied_on = $("#applied_on").val();
                    param.job_title = $("#job_title").val();
                    param.country_id = $("#country_id").val();
                    param.state_id = $("#state_id").val();
                    param.city_id = $("#city_id").val();
                },
                complete: function() {
                    $('#preloader').hide();
                }
            },
            columns: [{
                    data: 'DT_RowIndex',
                    name: 'DT_RowIndex',
                    orderable: false,
                    searchable: false
                },
                {
                    data: 'company_name',
                    name: 'company_name'
                },
                {
                    data: 'candidate_name',
                    name: 'candidate_name'
                },
                {
                    data: 'job_title',
                    name: 'job_title'
                },
                {
                    data: 'applied_date',
                    name: 'applied_date'
                },
                {
                    data: 'action',
                    name: 'action',
                    orderable: false,
                    searchable: false
                },
            ]
        });

        /* After click on filter button */
        $('#btn-filter').click(function() {
            table.ajax.reload();
        });

        /* After click reset button */
        $('#btn-reset').click(function() {
            $('#form-filter')[0].reset();
            $("#candidate_id").val('').trigger('change');
            $("#job_category_id").val('').trigger('change');
            $("#job_type_id").val('').trigger('change');
            $("#status").val('');
            $("#delete").val('1');
            table.ajax.reload();
        });
    });
</script>
@endsection