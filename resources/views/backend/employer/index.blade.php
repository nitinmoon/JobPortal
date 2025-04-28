@extends('backend.layouts.app')
@section('title', 'Employers')
@section('style')
<link rel="stylesheet" href="{{ asset('backend/assets/css/custom-css/switch.css') }}">
@endsection
@section('content')
<div class="pagetitle">
    <h1>{{ trans('employer.employers') }}</h1>
    <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
            <li class="breadcrumb-item active">{{ trans('employer.employers') }}</li>
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
                                        <div class="col-md-3 form-group">
                                            <label for="job_type_id" class="form-label">Employers</label>
                                            <select class="form-select js-example-basic-single" id="employer_search" style="width:100%;">
                                                <option value="">All</option>
                                            </select>
                                        </div>
                                        <div class="col-md-2">
                                            <label for="deleted" class="form-label">{{ trans('candidate.is_deleted') }}</label>
                                            <select class="form-control input-solid" id="deleted" style="width:100%;">
                                                <option value="1">No</option>
                                                <option value="2">Yes</option>
                                            </select>
                                        </div>
                                        <div class="col-md-2">
                                            <label for="status" class="form-label">Status</label>
                                            <select class="form-control input-solid" id="status" style="width:100%;">
                                                <option value="1">Active</option>
                                                <option value="2">Inactive</option>
                                                <option value="">All</option>
                                            </select>
                                        </div>
                                        <div class="col-md-3 table-filter-btn">
                                            <button type="button" id="btn-filter" class="btn btn-warning btn-sm rounded-pill">
                                                <i class="bi bi-search" title="Search"></i>
                                            </button>
                                            <button type="button" id="btn-reset" class="btn btn-sm btn-dark rounded-pill">
                                                <i class="bi bi-arrow-clockwise" title="Reset"></i>
                                            </button>
                                        </div>
                                        <div class="col-md-2 mt-5 text-end">
                                            <a href=" {{ route('addEmployer') }}" class="btn btn-sm btn-primary float-right"><i class="bi bi-plus-square"></i> Add</a>
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
                            <table class="table table-striped table-bordered datatable employer-table">
                                <thead>
                                    <tr>
                                        <th style="min-width:80px;">Sr No</th>
                                        <th>Name</th>
                                        <th>Company Name</th>
                                        <th>Contacts</th>
                                        <th>Status</th>
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
@endsection
@section('script')
<script src="{{ asset('backend/assets/js/custom-js/employer.js') }}"></script>
<script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $(function() {
        var table = $('.employer-table').DataTable({
            "aaSorting": [],
            processing: true,
            serverSide: true,
            pageLength: 100,
            "bDestroy": true,
            ajax: {
                url: "{{ route('employers') }}",
                beforeSend: function() {
                    $('#preloader').show();
                },
                data: function(param) {
                    param.employer = $("#employer_search").val();
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
                    data: 'name',
                    name: 'name'
                },
                {
                    data: 'company_name',
                    name: 'company_name'
                },
                {
                    data: 'contacts',
                    name: 'contacts'
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
            $(".employer-table").DataTable().ajax.reload();
        });

        /* After click reset button */
        $('#btn-reset').click(function() {
            $("#employer_search").val('').trigger('change');
            $('#form-filter')[0].reset();
            $("#status").val('');
            $("#delete").val('1');
            $(".employer-table").DataTable().ajax.reload();
        });

        $('#employer_search').select2({
            placeholder: 'Select Employer',
            ajax: {
                url: "{{ route('autoCompleteSearchEmployer') }}",
                dataType: 'json',
                delay: 250,
                processResults: function(data) {
                    data.push({
                        id: 0,
                        title: "",
                        first_name: "All",
                        last_name: "",
                        candidateId: ""
                    });
                    return {
                        results: $.map(data, function(item) {
                            return {
                                text: item.first_name + " " + item.last_name,
                                id: item.id
                            }
                        })
                    };
                },
                cache: true
            }
        });
    });
</script>
@endsection