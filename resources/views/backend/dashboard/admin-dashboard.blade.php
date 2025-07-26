  @extends('backend.layouts.app')
  @section('title', 'Dashboard')

  @section('content')
  <!-- <main id="main" class="main"> -->
  <div class="pagetitle">
      <h1>Dashboard</h1>
  </div>
  <section class="section dashboard">
      <div class="row">
          <div class="col-lg-12">
              <div class="row">
                  <div class="col-xxl-3 col-md-6">
                      <div class="card info-card revenue-card">
                          <div class="card-body">
                              <h5 class="card-title">Jobs</h5>
                              <div class="d-flex align-items-center">
                                  <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                      <i class="bi bi-person-workspace"></i>
                                  </div>
                                  <div class="ps-3">
                                      <h6>{{ getJobsCount() }}</h6>
                                      <span class="text-success small pt-1 fw-bold text-end"><a href="{{ route('jobsList') }}">View All</a></span>
                                  </div>
                              </div>
                          </div>
                      </div>
                  </div>
                  @if(auth()->user()->role_id == App\Models\Constants\UserRoleConstants::SUPER_ADMIN)
                  <div class="col-xxl-3 col-md-6">
                      <div class="card info-card sales-card">
                          <div class="card-body">
                              <h5 class="card-title">Employers</h5>
                              <div class="d-flex align-items-center">
                                  <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                      <i class="bi bi-person"></i>
                                  </div>
                                  <div class="ps-3">
                                      <h6>{{ getDashboardUsersCount(App\Models\Constants\UserRoleConstants::EMPLOYER) }}</h6>
                                      <span class="text-success small pt-1 fw-bold text-end"><a href="{{ route('employers') }}">View All</a></span>
                                  </div>
                              </div>
                          </div>
                      </div>
                  </div>
                  <div class="col-xxl-3 col-md-6">
                      <div class="card info-card revenue-card">
                          <div class="card-body">
                              <h5 class="card-title">Candidates</h5>
                              <div class="d-flex align-items-center">
                                  <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                      <i class="bi bi-person"></i>
                                  </div>
                                  <div class="ps-3">
                                      <h6>{{ getDashboardUsersCount(App\Models\Constants\UserRoleConstants::CANDIDATE) }}</h6>
                                      <span class="text-success small pt-1 fw-bold text-end"><a href="{{ route('candidates') }}">View All</a></span>
                                  </div>
                              </div>
                          </div>
                      </div>
                  </div>
                  <!-- Revenue Card -->
                  <div class="col-xxl-3 col-md-6">
                      <div class="card info-card revenue-card">
                          <!-- <div class="filter">
                              <a class="icon" href="#" data-bs-toggle="dropdown"><i class="bi bi-three-dots"></i></a>
                              <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                                  <li class="dropdown-header text-start">
                                      <h6>Filter</h6>
                                  </li>

                                  <li><a class="dropdown-item jobApplyCountFilter" href="javascript:void(0);" data-id="today">Today</a></li>
                                  <li><a class="dropdown-item jobApplyCountFilter" href="javascript:void(0);" data-id="week">Week</a></li>
                                  <li><a class="dropdown-item jobApplyCountFilter" href="javascript:void(0);" data-id="month">Month</a></li>
                              </ul>
                          </div> -->
                          <div class="card-body">
                              <h5 class="card-title">Applied Candidates Jobs</h5>
                              <div class="d-flex align-items-center">
                                  <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                      <i class="bi bi-file-earmark-person-fill"></i>
                                  </div>
                                  <div class="ps-3">
                                      <h6>{{ getAppliedJobsCount() }}</h6>
                                      <span class="text-success small pt-1 fw-bold text-end"><a href="{{ route('candidateApplyJobs') }}">View All</a></span>
                                  </div>
                              </div>
                          </div>
                      </div>
                  </div>
                  @endif
                  <!-- End Revenue Card -->
              </div>
          </div>
      </div>
  </section>
  <!-- </main> -->
  @endsection
  @section('script')
  <script src="{{ asset('backend/assets/js/custom-js/dashboard.js') }}"></script>
  @endsection