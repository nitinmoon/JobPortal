@extends('backend.layouts.app')
@section('title', 'Candidate Form')
@section('content')
<div class="pagetitle">
  <h1>View {{ trans('candidate.candidate') }}</h1>
  <nav>
    <ol class="breadcrumb">
      @if(auth()->user()->role_id == App\Models\Constants\UserRoleConstants::SUPER_ADMIN)
      <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
      <li class="breadcrumb-item"><a href="{{ route('candidates') }}">{{ trans('candidate.candidates') }}</a></li>
      <li class="breadcrumb-item active"> {{ trans('candidate.view_candidate') }}</li>
      @endif
      @if(auth()->user()->role_id == App\Models\Constants\UserRoleConstants::EMPLOYER)
      <li class="breadcrumb-item"><a href="{{ route('employerDashboard') }}">Dashboard</a></li>
      <li class="breadcrumb-item"><a href="{{ route('database') }}">Database</a></li>
      <li class="breadcrumb-item active"> {{ trans('candidate.view_candidate') }}</li>
      @endif
    </ol>
  </nav>
</div>
<section class="section profile">
  <div class="row">
    <div class="col-md-3 mb-4">
      <div class="card shadow-sm">
        <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
          <div class="card text-center mb-3">
            <div class="card-body">
              <img src="{{ !empty($userDetails->profile_photo) ? 'data: image/jpeg;base64,'. \base64_encode(\file_get_contents(config('constants.PROFILE_PATH').Auth::user()->profile_photo))  : asset(config('constants.DEFAULT_PROFILE')) }}" alt="Profile" class="rounded-circle mt-2" style="height: 100px; width:100px;">
              <h5 class="mt-2">{{ isset($userDetails->first_name) && $userDetails->first_name != null ? getTitle($userDetails->title) . ' ' . strip_tags(ucfirst($userDetails->first_name)) . ' ' .strip_tags(ucfirst($userDetails->last_name)) : explode('@', $userDetails->email)[0] }}</h5>
              <small class="mt-1">{{ isset($candidateDetails->designation_id) ? $candidateDetails->designation->name : '' }}</small>
            </div>
          </div>
          <a class="nav-link active" id="profile-tab" data-bs-toggle="pill" href="#basic" role="tab">Basic Details</a>
          <a class="nav-link" id="resume-tab" data-bs-toggle="pill" href="#work" role="tab">Work Details</a>
          <a class="nav-link" id="jobs-tab" data-bs-toggle="pill" href="#applyJob" role="tab">Applied Jobs</a>
        </div>
      </div>
    </div>

    <!-- Tab Content -->
    <div class="col-md-9">
      <div class="tab-content" id="v-pills-tabContent">
        <!-- Basic Details Tab -->
        <div class="tab-pane fade show active" id="basic" role="tabpanel">
          <div class="card shadow-sm">
            <div class="card-body">
              <h4 class="text-success mt-4">Basic Details</h4>
              <div class="row g-3 mt-2">
                <div class="table-responsive">
                  <table class="table table-bordered mb-0">
                    <tbody>
                      <tr>
                        <th class="w-25">Full Name</th>
                        <td>{{ isset($userDetails->first_name) && $userDetails->first_name != null ? getTitle($userDetails->title) . ' ' . strip_tags(ucfirst($userDetails->first_name)) . ' ' .strip_tags(ucfirst($userDetails->last_name)) : explode('@', $userDetails->email)[0] }}
                        </td>
                      </tr>
                      <tr>
                        <th class="w-25">Email ID</th>
                        <td>{{ isset($userDetails->email) ? $userDetails->email : '--' }}
                        </td>
                      </tr>
                      <tr>
                        <th class="w-25">Phone Number</th>
                        <td>{{ isset($userDetails->phone) ? $userDetails->phone : '--' }}
                        </td>
                      </tr>
                      <tr>
                        <th class="w-25">Date Of Birth</th>
                        <td>{{ isset($userDetails->email) ? $userDetails->email : '--' }}
                        </td>
                      </tr>
                      <tr>
                        <th class="w-25">Gender</th>
                        <td>{{ isset($userDetails->gender) ? getUserGender($userDetails->gender) : '--' }}
                        </td>
                      </tr>
                      <tr>
                        <th class="w-25">Address</th>
                        <td>{{ isset($candidateDetails->address) ? $candidateDetails->address .', '. $candidateDetails->country->name .', '. $candidateDetails->state->name .', '. $candidateDetails->city->name .' - '. $candidateDetails->zip: '--' }}
                        </td>
                      </tr>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- Work Details Tab -->
        <div class="tab-pane fade" id="work" role="tabpanel">
          <div class="card shadow-sm">
            <div class="card-body">
              <h4 class="text-success mt-4">Work Details</h4>
              <div class="row g-3 mt-2">
                <div class="table-responsive">
                  <table class="table table-bordered mb-0">
                    <tbody>
                      <tr>
                        <th class="w-25">Work Type</th>
                        <td>{{ isset($candidateDetails->work_type_id) ? $candidateDetails->workType->name : '--' }}
                        </td>
                      </tr>
                      <tr>
                        <th class="w-25">Total Experience</th>
                        <td>{{ isset($candidateDetails->experience) ? $candidateDetails->experience : '--' }}
                        </td>
                      </tr>
                      <tr>
                        <th class="w-25">Education</th>
                        <td>{{ isset($candidateDetails->education) ? $candidateDetails->education : '--' }}
                        </td>
                      </tr>
                      <tr>
                        <th class="w-25">Skills</th>
                        <td>
                          @if(isset($candidateDetails->skills) && count(explode(',', $candidateDetails->skills)) > 0)
                          @foreach($skills as $skill)
                          {!! (isset($candidateDetails->skills) && $candidateDetails->skills != '' && in_array($skill->id, explode(',', $candidateDetails->skills))) ? '<span class="badge rounded-pill bg-primary p-2">'.$skill->name.'</span>' : '' !!}
                          @endforeach
                          @endif
                        </td>
                      </tr>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- Applied Job Tab -->
        <div class="tab-pane fade" id="applyJob" role="tabpanel">
          <div class="card shadow-sm">
            <div class="card-body">
              <h4 class="text-success mt-4">Applied Jobs</h4>
              <div class="table-responsive mt-4">
                <table class="table table-striped table-bordered datatable apply-job-table" style="width: 100%;">
                  <thead>
                    <tr>
                      <th style="min-width:50px;">Sr No</th>
                      <th style="min-width:120px;">Company Name</th>
                      <th style="min-width:120px;">Job Title</th>
                      <th style="min-width:120px;">Apply Date</th>
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
  </div>
</section>
@endsection
@section('script')
<script>
  $(function() {
    $("#close").click(function() {
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
          data: 'company_name',
          name: 'company_name'
        },
        {
          data: 'job_title',
          name: 'job_title'
        },
        {
          data: 'apply_date',
          name: 'apply_date'
        },
      ]
    });
  });
</script>
@endsection