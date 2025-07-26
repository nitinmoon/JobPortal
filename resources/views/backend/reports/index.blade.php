@extends('backend.layouts.app')
@section('title', 'Report')
@section('content')
<div class="pagetitle">
    <h1>Reports</h1>
    <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
            <li class="breadcrumb-item active">Reports</li>
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
                                        <div class="col-md-3">
                                            <label for="candidate_id" class="form-label">Candidate Name</label>
                                            <select class="form-control" id="candidate_id" style="width:100%">
                                                <option value="">All</option>
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
                                        <div class="col-md-3">
                                            <label for="job_type_id" class="form-label">Job Type</label>
                                            <select class="form-select js-example-basic-single" id="job_type_id" data-error="#error_job_type_id" style="width:100%;">
                                                <option value="">Select</option>
                                                @foreach($jobType as $row)
                                                <option value="{{ $row->id }}">{{ $row->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-md-3">
                                            <label for="job_title" class="form-label">Job Title</label>
                                            <input type="text" id="job_title" class="form-control" placeholder="Job Title" />
                                        </div>
                                        <div class="col-md-3">
                                            <label for="status" class="form-label">Status</label>
                                            <select class="form-control input-solid" id="status" style="width:100%;">
                                                <option value="">All</option>
                                                <option value="1">Application Sent</option>
                                                <option value="2">Resume Viewed</option>
                                                <option value="3">Shortlisted</option>
                                            </select>
                                        </div>
                                        <div class="col-md-3">
                                            <label for="status" class="form-label">Applied Date</label>
                                            <input type="date" id="applied_on" class="form-control" max="{{ date('Y-m-d') }}" />
                                        </div>
                                        <div class="col-md-3">
                                            <label for="country_id" class="form-label">Country</label>
                                            <select class="form-select js-example-basic-single" name="country_id" id="country_id" data-error="#error_country_id">
                                                <option value="">Select</option>
                                                @foreach($countries as $row)
                                                <option value="{{ $row->id }}" {{ (isset($jobDetails->country_id) && $jobDetails->country_id == $row->id) ? 'selected' : '' }}>{{ $row->name }}</option>
                                                @endforeach
                                            </select>
                                            <span class="error" id="error_country_id"></span>
                                        </div>
                                        <div class="col-md-3">
                                            <label for="inputPassword5" class="form-label">State</label>
                                            <select class="form-select js-example-basic-single" name="state_id" id="state_id" data-error="#error_state_id">
                                                @if(isset($jobDetails->id))
                                                @if(count($states) > 0)
                                                @foreach ($states as $state)
                                                <option value="{{ $state->id }}" {{ isset($jobDetails->state_id) && ($state->id == $jobDetails->state_id) ? 'selected' : '' }}>{{$state->name}}</option>
                                                @endforeach
                                                @else
                                                <option value="">Select</option>
                                                @endif
                                                @else
                                                <option value="">Select</option>
                                                @endif
                                            </select>
                                            <span class="error" id="error_state_id"></span>
                                        </div>
                                        <div class="col-md-3">
                                            <label for="city_id" class="form-label">City</label>
                                            <select class="form-select js-example-basic-single" name="city_id" id="city_id" data-error="#error_city_id">
                                                @if(isset($jobDetails->id))
                                                @if(count($states) > 0)
                                                @foreach ($cities as $city)
                                                <option value="{{ $city->id }}" {{ isset($jobDetails->city_id) && ($city->id == $jobDetails->city_id) ? 'selected' : '' }}>{{$city->name}}</option>
                                                @endforeach
                                                @else
                                                <option value="">Select</option>
                                                @endif
                                                @else
                                                <option value="">Select</option>
                                                @endif
                                            </select>
                                            <span class="error" id="error_city_id"></span>
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
                            <table class="table table-striped table-bordered datatable report-table" style="width: 100%;">
                                <thead>
                                    <tr>
                                        <th style="min-width:50px;">Sr No</th>
                                        <th style="min-width:150px;">Company Name</th>
                                        <th style="min-width:200px;">Candidate Name</th>
                                        <th style="min-width:100px;">Category</th>
                                        <th style="min-width:100px;">Type</th>
                                        <th style="min-width:100px;">Job Title</th>
                                        <th style="min-width:100px;">Status</th>
                                        <th style="min-width:120px;">Applied On</th>
                                        <th style="min-width:120px;">Job Location</th>
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
<script>
    $(function() {
        var table = $('.report-table').DataTable({
            "aaSorting": [],
            processing: true,
            serverSide: true,
            pageLength: 100,
            "drawCallback": function(settings) {
                $('.js-example-basic-single').select2();
            },
            "bDestroy": true,
            ajax: {
                url: "{{ route('reports') }}",
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
                    data: 'category',
                    name: 'category'
                },
                {
                    data: 'job_type',
                    name: 'job_type'
                },
                {
                    data: 'job_title',
                    name: 'job_title'
                },
                {
                    data: 'status',
                    name: 'status'
                },
                {
                    data: 'applied_date',
                    name: 'applied_date'
                },
                {
                    data: 'job_location',
                    name: 'job_location',
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

        $('#country_id').change(function() {
            var countryId = $(this).val();
            $("#state_id").empty();
            $("#city_id").empty();
            $.ajax({
                url: "{{ route('getState') }}",
                dataType: 'json',
                data: {
                    countryId: countryId
                },
                delay: 250,
                success: function(data) {
                    $("#state_id").empty();
                    $.each(data, function(key, value) {
                        var id, text, $option;
                        $option += "<option value=''>Select State</option>";
                        for (var i = 0; i < value.length; i++) {
                            $option += "<option value ='" + value[i]['id'] + "'>" + value[i]['name'] + "</option>";
                        }
                        $("#state_id").append($option);
                    });
                    var $option;
                    $option += "<option value=''>Select City</option>";
                    $("#city_id").append($option);
                }
            });
        });

        $("#state_id").change(function() {
            var stateId = $(this).val();
            $("#city_id").empty();
            $.ajax({
                url: "{{ route('getCity') }}",
                dataType: 'json',
                data: {
                    stateId: stateId
                },
                delay: 250,
                success: function(data) {
                    $("#city_id").empty();
                    $.each(data, function(key, value) {
                        var id, text, $option;
                        $option += "<option value=''>Select City</option>";
                        for (var i = 0; i < value.length; i++) {
                            $option += "<option value ='" + value[i]['id'] + "'>" + value[i]['name'] + "</option>";
                        }
                        $("#city_id").append($option);
                    });
                }
            });
        });

        $('#candidate_id').select2({
            placeholder: 'All',
            ajax: {
                url: "{{ route('autocompleteSearchApplyCandidate') }}",
                dataType: 'json',
                delay: 250,
                processResults: function(data) {
                    data.push({
                        id: 0,
                        title: "",
                        first_name: "All",
                        last_name: "",
                        employeeId: ""
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