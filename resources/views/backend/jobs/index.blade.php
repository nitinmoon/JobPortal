@extends('backend.layouts.app')
@section('title', 'Jobs')
@section('style')
<link rel="stylesheet" href="{{ asset('backend/assets/css/custom-css/switch.css') }}">
@endsection
@section('content')
<div class="pagetitle">
    <h1>Jobs</h1>
    <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
            <li class="breadcrumb-item active">Jobs</li>
        </ol>
    </nav>
</div><!-- End Page Title -->

<section class="section dashboard">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="card pt-2">
                                <div class="card-body">
                                    <form class="row g-3" id="form-filter">
                                        <div class="col-md-2">
                                            <label for="job_type_id" class="form-label">Job Type</label>
                                            <select class="form-select js-example-basic-single" id="job_type_id" data-error="#error_job_type_id" style="width:100%;">
                                                <option value="">Select</option>
                                                @foreach($jobType as $row)
                                                <option value="{{ $row->id }}">{{ $row->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-md-3">
                                            <label for="job_category_id" class="form-label">Job Category</label>
                                            <select class="form-select js-example-basic-single" id="job_category_id" data-error="#error_job_category_id" style="width:100%;">
                                                <option value="">Select</option>
                                                @foreach($jobCategory as $row)
                                                <option value="{{ $row->id }}">{{ $row->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-md-2">
                                            <label for="status" class="form-label">Status</label>
                                            <select class="form-control input-solid" id="status" style="width:100%;">
                                                <option value="">All</option>
                                                <option value="0">Inactive</option>
                                                <option value="1">Active</option>
                                            </select>
                                        </div>
                                        <div class="col-md-2">
                                            <label for="deleted" class="form-label">Is Deleted</label>
                                            <select class="form-control input-solid" id="deleted" style="width:100%;">
                                                <option value="1">No</option>
                                                <option value="2">Yes</option>
                                            </select>
                                        </div>
                                        <div class="col-md-2 table-filter-btn">
                                            <button type="button" id="btn-filter" class="btn btn-warning btn-sm rounded-pill">
                                                <i class="bi bi-search" title="Search"></i>
                                            </button>
                                            <button type="button" id="btn-reset" class="btn btn-sm btn-dark rounded-pill">
                                                <i class="bi bi-arrow-clockwise" title="Reset"></i>
                                            </button>
                                        </div>
                                        <div class="col-md-1 table-filter-btn">
                                            <!-- <a href=" {{ route('addJob') }}" class="btn btn-sm btn-primary float-right"><i class="bi bi-plus-square"></i> Add</a> -->
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-body mt-2">
                    <div class="datatable-wrapper datatable-loading no-footer sortable searchable fixed-columns">
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered datatable job-list-table" style="width: 100%;">
                                <thead>
                                    <tr>
                                        <th style="min-width:50px;">Sr No</th>
                                        <th>Job Title</th>
                                        <th>Type</th>
                                        <th>Category</th>
                                        <th>Vacancy</th>
                                        <th>Job Status</th>
                                        <th>Status</th>
                                        <th>Action</th>
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

@endsection
@section('script')
<script src="{{ asset('backend/assets/js/custom-js/jobs.js') }}"></script>
<script>
    $('.js-example-basic-single').select2();
    $(function() {
        var table = $('.job-list-table').DataTable({
            "aaSorting": [],
            processing: true,
            serverSide: true,
            pageLength: 100,
            "bDestroy": true,
            ajax: {
                url: "{{ route('jobsList') }}",
                beforeSend: function() {
                    $('#preloader').show();
                },
                data: function(param) {
                    param.job_category_id = $("#job_category_id").val();
                    param.job_type_id = $("#job_type_id").val();
                    param.deleted = $("#deleted").val();
                    param.status = $("#status").val();
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
                    data: 'job_title',
                    name: 'job_title'
                },
                {
                    data: 'job_type',
                    name: 'job_type'
                },
                {
                    data: 'job_category',
                    name: 'job_category'
                },
                {
                    data: 'vacancy',
                    name: 'vacancy'
                },
                {
                    data: 'job_status',
                    name: 'job_status',
                    orderable: false,
                    searchable: false
                },
                {
                    data: 'status',
                    name: 'status',
                    orderable: false,
                    searchable: false
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
            $("#job_category_id").val('').trigger('change');
            $("#job_type_id").val('').trigger('change');
            $("#status").val('');
            $("#delete").val('1');
            table.ajax.reload();
        });
    });
</script>
@endsection