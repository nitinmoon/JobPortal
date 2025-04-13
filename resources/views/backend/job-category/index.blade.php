@extends('backend.layouts.app')
@section('title', 'Job Category')
@section('style')
<link rel="stylesheet" href="{{ asset('backend/assets/css/custom-css/switch.css') }}">
@endsection
@section('content')
<div class="pagetitle">
    <h1>Job Category</h1>
    <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
            <li class="breadcrumb-item active">Job Category</li>
        </ol>
    </nav>
</div><!-- End Page Title -->

<section class="section dashboard">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-6 col-sm-6 col-md-6 col-lg-6">
                            <h5 class="card-title"><i class="bi bi-briefcase-fill"></i> Job Category</h5>
                        </div>
                        <div class="col-6 col-sm-6 col-md-6 col-lg-6 text-end mt-3">
                            <a data-url="{{ route('addJobCategoryModal') }}" href="javascript:void(0)" class="btn btn-sm btn-primary add-job-category"><i class="bi bi-plus-square"></i>&nbsp;&nbsp; Add</a>
                        </div>
                    </div>
                </div>
                <div class="card-body mt-2">
                    <div class="datatable-wrapper datatable-loading no-footer sortable searchable fixed-columns">
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered datatable job-category-table">
                                <thead>
                                    <tr>
                                        <th style="min-width:80px;">Sr No</th>
                                        <th>Name</th>
                                        <th>Icon</th>
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
<!-- Add Job Category Modal -->
@include('backend.job-category.job-category-modal')
<!-- /Add Job Category Modal -->
@endsection
@section('script')
<script src="{{ asset('backend/assets/js/custom-js/job-category.js') }}"></script>
<script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $(function() {
        var table = $('.job-category-table').DataTable({
            "aaSorting": [],
            processing: true,
            serverSide: true,
            pageLength: 100,
            "bDestroy": true,
            ajax: {
                url: "{{ route('jobCategories') }}",
                beforeSend: function() {
                    $('#preloader').show();
                },
                data: function(param) {
                    param.deleted = $("#deleted").val();
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
                    data: 'icon',
                    name: 'icon'
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
    });
</script>
@endsection