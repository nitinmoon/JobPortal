@extends('backend.layouts.app')
@section('title', 'Candidate Form')
@section('content')
<div class="pagetitle">
  <h1>View {{ trans('candidate.candidate') }}</h1>
  <nav>
    <ol class="breadcrumb">
      @if(auth()->user()->role_id == App\Models\Constants\UserRoleConstants::USER_ROLE_ADMIN)
        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
        <li class="breadcrumb-item"><a href="{{ route('candidates') }}">{{ trans('candidate.candidates') }}</a></li>
        <li class="breadcrumb-item active"> {{ trans('candidate.view_candidate') }}</li>
      @endif
      @if(auth()->user()->role_id == App\Models\Constants\UserRoleConstants::USER_ROLE_EMPLOYER)
        <li class="breadcrumb-item"><a href="{{ route('employerDashboard') }}">Dashboard</a></li>
        <li class="breadcrumb-item"><a href="{{ route('database') }}">Database</a></li>
        <li class="breadcrumb-item active"> {{ trans('candidate.view_candidate') }}</li>
      @endif
    </ol>
  </nav>
</div>
<section class="section profile">
    <div class="row">
        <div class="col-xl-4">

          <div class="card">
            <div class="card-body profile-card pt-4 d-flex flex-column align-items-center">

              <img src="{{ !empty($candidateDetails->profile_photo) ? 'data: image/jpeg;base64,'. \base64_encode(\file_get_contents(config('constants.PROFILE_PATH').Auth::user()->profile_photo))  : asset(config('constants.DEFAULT_PROFILE')) }}" alt="Profile" class="rounded-circle">
              <h2>{{ isset($userDetails->first_name) && $userDetails->first_name != null ? getTitle($userDetails->title) . ' ' . strip_tags(ucfirst($userDetails->first_name)) . ' ' .strip_tags(ucfirst($userDetails->last_name)) : explode('@', $userDetails->email)[0] }}</h2>
              <h3>{{ isset($candidateDetails->job_title) ? $candidateDetails->job_title : '' }}</h3>
            </div>
          </div>

        </div>

        <div class="col-xl-8">

          <div class="card">
            <div class="card-body pt-3">
              <!-- Bordered Tabs -->
              <ul class="nav nav-tabs nav-tabs-bordered">

                <li class="nav-item">
                  <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#basic-overview">Basic Details</button>
                </li>
                <li class="nav-item">
                  <button class="nav-link" data-bs-toggle="tab" data-bs-target="#work-overview">Work Details</button>
                </li>
                <li class="nav-item">
                  <button class="nav-link" data-bs-toggle="tab" data-bs-target="#apply-job-overview">Apply Jobs</button>
                </li>
              </ul>
              <div class="tab-content pt-2">
                <div class="tab-pane fade show active profile-overview" id="basic-overview">
                  <h5 class="card-title">Basic Details</h5>

                  <div class="row">
                    <div class="col-lg-3 col-md-4 label ">Full Name</div>
                    <div class="col-lg-9 col-md-8">{{ isset($userDetails->first_name) && $userDetails->first_name != null ? getTitle($userDetails->title) . ' ' . strip_tags(ucfirst($userDetails->first_name)) . ' ' .strip_tags(ucfirst($userDetails->last_name)) : explode('@', $userDetails->email)[0] }}</div>
                  </div>

                  <div class="row">
                    <div class="col-lg-3 col-md-4 label">Email</div>
                    <div class="col-lg-9 col-md-8">{{ isset($userDetails->email) ? $userDetails->email : '--' }}</div>
                  </div>

                  <div class="row">
                    <div class="col-lg-3 col-md-4 label">Phone</div>
                    <div class="col-lg-9 col-md-8">{{ isset($userDetails->phone) ? $userDetails->phone : '--' }}</div>
                  </div>

                  <div class="row">
                    <div class="col-lg-3 col-md-4 label">DOB</div>
                    <div class="col-lg-9 col-md-8">{{ isset($userDetails->dob) ? date('d M y', strtotime($userDetails->dob)) : '--' }}</div>
                  </div>

                  <div class="row">
                    <div class="col-lg-3 col-md-4 label">Gender</div>
                    <div class="col-lg-9 col-md-8">{{ isset($userDetails->gender) ? getUserGender($userDetails->gender) : '--' }}</div>
                  </div>

                  <div class="row">
                    <div class="col-lg-3 col-md-4 label">Address</div>
                    <div class="col-lg-9 col-md-8">{{ isset($candidateDetails->address) ? $candidateDetails->address : '--' }}</div>
                  </div>

                  <div class="row">
                    <div class="col-lg-3 col-md-4 label">Zip Code</div>
                    <div class="col-lg-9 col-md-8">{{ isset($candidateDetails->zip) ? $candidateDetails->zip : '--' }}</div>
                  </div>

                  <div class="row">
                    <div class="col-lg-3 col-md-4 label">Country</div>
                    <div class="col-lg-9 col-md-8">{{ isset($candidateDetails->country_id) ? $candidateDetails->country->name : '--' }}</div>
                  </div>

                  <div class="row">
                    <div class="col-lg-3 col-md-4 label">State</div>
                    <div class="col-lg-9 col-md-8">{{ isset($candidateDetails->state_id) ? $candidateDetails->state->name : '--' }}</div>
                  </div>

                  <div class="row">
                    <div class="col-lg-3 col-md-4 label">City</div>
                    <div class="col-lg-9 col-md-8">{{ isset($candidateDetails->city_id) ? $candidateDetails->city->name : '--' }}</div>
                  </div>
                </div>

                <div class="tab-pane fade profile-overview" id="work-overview">
                  <h5 class="card-title">Work Details</h5>

                  <div class="row">
                    <div class="col-lg-3 col-md-4 label">Work Type</div>
                    <div class="col-lg-9 col-md-8">{{ isset($candidateDetails->workTypeName) ? $candidateDetails->workTypeName : '--' }}</div>
                  </div>

                  <div class="row">
                      <div class="col-lg-3 col-md-4 label">Total Experience</div>
                      <div class="col-lg-9 col-md-8">
                        {{ isset($candidateDetails->experience) ? explode("-",$candidateDetails->experience)[0] : '--' }}
                        Years
                        {{ isset($candidateDetails->experience) ? explode("-",$candidateDetails->experience)[1] : '--' }}</>
                        Months
                      </div>
                  </div>

                  <div class="row">
                    <div class="col-lg-3 col-md-4 label">Education</div>
                    <div class="col-lg-9 col-md-8">{{ isset($candidateDetails->education) ? $candidateDetails->education : '--' }}</div>
                  </div>

                  <div class="row">
                    <div class="col-lg-3 col-md-4 label">Skills</div>
                    <div class="col-lg-9 col-md-8">
                        @if(isset($candidateDetails->skills) && count(explode(',', $candidateDetails->skills)) > 0)
                            @foreach($skills as $skill)
                                {!! (isset($candidateDetails->skills) && $candidateDetails->skills != '' && in_array($skill->id, explode(',', $candidateDetails->skills))) ? '<span class="badge rounded-pill bg-primary p-2">'.$skill->name.'</span>' : '' !!}
                            @endforeach
                        @endif
                    </div>
                  </div>
                </div>
                <div class="tab-pane fade apply-job-overview" id="apply-job-overview">
                  <div class="card">
                    <div class="card-body mt-2">
                        <div class="datatable-wrapper datatable-loading no-footer sortable searchable fixed-columns">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered datatable apply-job-table" style="width: 100%;">
                                    <thead>
                                        <tr>
                                            <th style="min-width:50px;">Sr No</th>
                                            <th style="min-width:120px;">Job Title</th>
                                            <th style="min-width:120px;">Job Category</th>
                                            <th style="min-width:120px;">Job Type</th>
                                            <th>Status</th>
                                            <th style="min-width:200px;">Job Location</th>
                                            <th style="min-width:150px;">Applied On</th>
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
              </div><!-- End Bordered Tabs -->

            </div>
          </div>

        </div>
      </div>
</section>
@endsection
@section('script')
<script>
  $(function() {
      $("#close").click(function(){
          $('#output').attr('src', "{{ !empty(Auth::user()->profile_photo) ? 'data: image/jpeg;base64,'. \base64_encode(\file_get_contents(config('constants.PROFILE_PATH').'/'.Auth::user()->profile_photo))  : asset(config('constants.DEFAULT_PROFILE')) }}");
          $("#select_img").removeClass('d-none');
          $("#upload_img").addClass('d-none');
          $("#close").addClass('d-none');
      });

      var table = $('.apply-job-table').DataTable({
          "aaSorting": [],
          processing: true,
          serverSide: true,
          pageLength: 100,
          "drawCallback": function(settings) {
              $('.js-example-basic-single').select2();
          },
          "bDestroy": true,
          ajax: {
              url: "{{ route('getApplyJobListing') }}",
              beforeSend: function() {
                  $('#preloader').show();
              },
              data: function(param) {
                  param.user_id = "{{ isset($candidateDetails->candidate_id) }}";
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
                  data: 'job_category',
                  name: 'job_category'
              },
              {
                  data: 'job_type',
                  name: 'job_type'
              },
              {
                  data: 'status',
                  name: 'status'
              },
              {
                  data: 'job_location',
                  name: 'job_location'
              },
              {
                  data: 'created_at',
                  name: 'created_at',
                  orderable: false,
                  searchable: false
              },
          ]
      });
  });
</script>
@endsection