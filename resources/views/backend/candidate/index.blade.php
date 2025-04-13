@extends('backend.layouts.app')
@section('title', 'Candidates')
@section('style')
<link rel="stylesheet" href="{{ asset('backend/assets/css/custom-css/switch.css') }}">
@endsection
@section('content')
<div class="pagetitle">
    <h1>Candidates</h1>
    <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
            <li class="breadcrumb-item active">Candidates</li>
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
                                            <label for="job_type_id" class="form-label">{{ trans('candidate.candidates') }}</label>
                                            <select class="form-select js-example-basic-single" id="candidate_search" style="width:100%;">
                                                <option value="">All</option>
                                            </select>
                                        </div>
                                        <div class="col-md-2">
                                            <label for="job_title_id" class="form-label">{{ trans('candidate.education') }}</label>
                                            <select class="select2 form-control" id="education" name="education" data-placeholder="Select Education" style="width:100%">
                                                <option value="">Select</option>
                                                @foreach (educationArray() as $education)
                                                <option value="{{ $education }}" {{ (isset($candidateDetails->education) && $candidateDetails->education == $education) ? 'selected' : '' }}>{{ $education }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-md-2">
                                            <label for="status" class="form-label">Status</label>
                                            <select class="form-control input-solid" id="status" style="width:100%;">
                                                <option value="1">Active</option>
                                                <option value="0">Inactive</option>
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
                                        <div class="col-md-3 table-filter-btn">
                                            <button type="button" id="btn-filter" class="btn btn-warning btn-sm rounded-pill">
                                                <i class="bi bi-search" title="Search"></i>
                                            </button>
                                            <button type="button" id="btn-reset" class="btn btn-sm btn-dark rounded-pill">
                                                <i class="bi bi-arrow-clockwise" title="Reset"></i>
                                            </button>
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
                            <table class="table table-striped table-bordered datatable candidate-table">
                                <thead>
                                    <tr>
                                        <th style="min-width:80px;">Sr No</th>
                                        <th style="min-width:150px;">Name</th>
                                        <th style="min-width:150px;">Education</th>
                                        <th>Experience</th>
                                        <th style="min-width:110px;">Contacts</th>
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
<!-- Profile Area End -->
<div id="viewResumeModal" class="modal custom-modal fade" role="dialog">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" id="viewResumeBody">
            </div>
        </div>
    </div>
</div>
@endsection
@section('script')
<script src="{{ asset('backend/assets/js/custom-js/candidate.js') }}"></script>
<script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $(function() {
        var start = moment().subtract(29, 'days');
        var end = moment();
        $('#startDate').val(start.format('YYYY-MM-DD'));
        $('#endDate').val(end.format('YYYY-MM-DD'));

        var table = $('.candidate-table').DataTable({
            "aaSorting": [],
            processing: true,
            serverSide: true,
            pageLength: 100,
            "bDestroy": true,
            ajax: {
                url: "{{ route('candidates') }}",
                beforeSend: function() {
                    $('#preloader').show();
                },
                data: function(param) {
                    param.candidate = $("#candidate_search").val();
                    param.education = $("#education").val();
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
                    data: 'education',
                    name: 'education'
                },
                {
                    data: 'experience',
                    name: 'experience'
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
            table.ajax.reload();
        });

        /* After click reset button */
        $('#btn-reset').click(function() {
            $('#form-filter')[0].reset();
            $("#education").val('').trigger('change');
            $("#candidate_search").val('');
            $("#status").val('');
            $("#delete").val('1');
            table.ajax.reload();
        });

        $('#candidate_search').select2({
            placeholder: 'Select Candidate',
            ajax: {
                url: "{{ route('autoCompleteSearchCandidate') }}",
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