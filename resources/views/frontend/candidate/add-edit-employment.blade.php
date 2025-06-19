<div class="modal-header">
    <h5 class="modal-title" id="EmploymentModalLongTitle">{{ isset($employmentDetails->id) ? 'Edit' : 'Add' }} Employment</h5>
    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>
<form id="employmentForm" action="{{ route('addUpdateEmployment') }}" method="POST">
    @csrf
    <input type="hidden" id="employment_id" name="employment_id" value="{{ isset($employmentDetails->id) ? $employmentDetails->id : '0' }}">
    <div class="modal-body">
        <div class="row">
            <div class="col-lg-12 col-md-12">
                <div class="form-group">
                    <label>Your Designation</label>
                    <select class="form-select" data-error="#error_designation_id" name="designation_id" data-placeholder="Select Designation">
                        <option value="">Select Designation</option>
                        @foreach($designations as $designation)
                        <option value="{{ $designation->id }}" {{ isset($employmentDetails->designation_id) && $employmentDetails->designation_id == $designation->id ? 'selected' : '' }}>{{ $designation->name }}</option>
                        @endforeach
                    </select>
                    <span class="error" id="error_designation_id"></span>
                </div>
            </div>
            <div class="col-lg-12 col-md-12">
                <div class="form-group">
                    <label>Your Organization</label>
                    <input type="text" class="form-control" placeholder="Enter Your Organization" name="organization" id="organization" value="{{ isset($employmentDetails->organization) ? $employmentDetails->organization : '' }}">
                    <span class="error" id="error_organization"></span>
                </div>
            </div>
            <div class="col-lg-12 col-md-12">
                <div class="form-group">
                    <label>Is this your current company?</label>
                    <div class="row">
                        <div class="col-lg-6 col-md-6 col-sm-6 col-6">
                            <div class="form-check">
                                <input type="radio" class="form-check-input" id="employ_yes" name="current_company" value="1" {{ isset($employmentDetails->current_company) && $employmentDetails->current_company == '1' ? 'checked' : '' }}>
                                <label class="form-check-label" for="employ_yes">Yes</label>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-6 col-6">
                            <div class="form-check">
                                <input type="radio" class="form-check-input" id="employ_no" name="current_company" value="2" {{ isset($employmentDetails->current_company) && $employmentDetails->current_company == '2' ? 'checked' : '' }}>
                                <label class="form-check-label" for="employ_no">No</label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-12 col-md-12">
                <div class="form-group">
                    <label>Started Working From</label>
                    <div class="row">
                        <div class="col-lg-6 col-md-6 col-sm-6 col-6">
                            <select class="form-select" name="work_from_year" id="work_from_year">
                                <option value="">Select Working Year</option>
                                @for($i = date('Y'); $i >= 2015; $i--)
                                <option value="{{ $i }}" {{ isset($employmentDetails->work_from) && explode('-', $employmentDetails->work_from)[0] == $i ? 'selected' : '' }}>{{ $i }}</option>
                                @endfor
                            </select>
                            <span class="error" id="error_work_from_year"></span>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-6 col-6">
                            <select class="form-select" name="work_from_month" id="work_from_month">
                                <option value="">Select Working Month</option>
                                <option value="1" {{ isset($employmentDetails->work_from) && explode('-', $employmentDetails->work_from)[1] == '1' ? 'selected' : '' }}>January</option>
                                <option value="2" {{ isset($employmentDetails->work_from) && explode('-', $employmentDetails->work_from)[1] == '2' ? 'selected' : '' }}>February</option>
                                <option value="3" {{ isset($employmentDetails->work_from) && explode('-', $employmentDetails->work_from)[1] == '3' ? 'selected' : '' }}>March</option>
                                <option value="4" {{ isset($employmentDetails->work_from) && explode('-', $employmentDetails->work_from)[1] == '4' ? 'selected' : '' }}>April</option>
                                <option value="5" {{ isset($employmentDetails->work_from) && explode('-', $employmentDetails->work_from)[1] == '5' ? 'selected' : '' }}>May</option>
                                <option value="6" {{ isset($employmentDetails->work_from) && explode('-', $employmentDetails->work_from)[1] == '6' ? 'selected' : '' }}>Jun</option>
                                <option value="7" {{ isset($employmentDetails->work_from) && explode('-', $employmentDetails->work_from)[1] == '7' ? 'selected' : '' }}>July</option>
                                <option value="8" {{ isset($employmentDetails->work_from) && explode('-', $employmentDetails->work_from)[1] == '8' ? 'selected' : '' }}>August</option>
                                <option value="9" {{ isset($employmentDetails->work_from) && explode('-', $employmentDetails->work_from)[1] == '9' ? 'selected' : '' }}>September</option>
                                <option value="10" {{ isset($employmentDetails->work_from) && explode('-', $employmentDetails->work_from)[1] == '10' ? 'selected' : '' }}>October</option>
                                <option value="11" {{ isset($employmentDetails->work_from) && explode('-', $employmentDetails->work_from)[1] == '11' ? 'selected' : '' }}>November</option>
                                <option value="12" {{ isset($employmentDetails->work_from) && explode('-', $employmentDetails->work_from)[1] == '12' ? 'selected' : '' }}>December</option>
                            </select>
                            <span class="error" id="error_work_from_month"></span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-12 col-md-12">
                <div class="form-group">
                    <label>Worked Till</label>
                    <div class="row">
                        <div class="col-lg-6 col-md-6 col-sm-6 col-6">
                            <select class="form-select" name="work_till_year" id="work_till_year">
                                <option value="">Select Worked Year</option>
                                @for($i = date('Y'); $i >= 2015; $i--)
                                <option value="{{ $i }}" {{ isset($employmentDetails->work_till) && explode('-', $employmentDetails->work_till)[0] == $i ? 'selected' : '' }}>{{ $i }}</option>
                                @endfor
                            </select>
                            <span class="error" id="error_work_till_year"></span>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-6 col-6">
                            <select class="form-select" name="work_till_month" id="work_till_month">
                                <option value="">Select Worked Month</option>
                                <option value="1" {{ isset($employmentDetails->work_till) && explode('-', $employmentDetails->work_till)[1] == '1' ? 'selected' : '' }}>January</option>
                                <option value="2" {{ isset($employmentDetails->work_till) && explode('-', $employmentDetails->work_till)[1] == '2' ? 'selected' : '' }}>February</option>
                                <option value="3" {{ isset($employmentDetails->work_till) && explode('-', $employmentDetails->work_till)[1] == '3' ? 'selected' : '' }}>March</option>
                                <option value="4" {{ isset($employmentDetails->work_till) && explode('-', $employmentDetails->work_till)[1] == '4' ? 'selected' : '' }}>April</option>
                                <option value="5" {{ isset($employmentDetails->work_till) && explode('-', $employmentDetails->work_till)[1] == '5' ? 'selected' : '' }}>May</option>
                                <option value="6" {{ isset($employmentDetails->work_till) && explode('-', $employmentDetails->work_till)[1] == '6' ? 'selected' : '' }}>Jun</option>
                                <option value="7" {{ isset($employmentDetails->work_till) && explode('-', $employmentDetails->work_till)[1] == '7' ? 'selected' : '' }}>July</option>
                                <option value="8" {{ isset($employmentDetails->work_till) && explode('-', $employmentDetails->work_till)[1] == '8' ? 'selected' : '' }}>August</option>
                                <option value="9" {{ isset($employmentDetails->work_till) && explode('-', $employmentDetails->work_till)[1] == '9' ? 'selected' : '' }}>September</option>
                                <option value="10" {{ isset($employmentDetails->work_till) && explode('-', $employmentDetails->work_till)[1] == '10' ? 'selected' : '' }}>October</option>
                                <option value="11" {{ isset($employmentDetails->work_till) && explode('-', $employmentDetails->work_till)[1] == '11' ? 'selected' : '' }}>November</option>
                                <option value="12" {{ isset($employmentDetails->work_till) && explode('-', $employmentDetails->work_till)[1] == '12' ? 'selected' : '' }}>December</option>
                            </select>
                            <span class="error" id="error_work_till_month"></span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-12 col-md-12">
                <div class="form-group">
                    <label>Describe your Job Profile</label>
                    <textarea class="form-control" placeholder="Type Job Profile" id="job_profile" name="job_profile">{{ isset($employmentDetails->job_profile) ? $employmentDetails->job_profile : '' }}</textarea>
                </div>
            </div>
        </div>
    </div>
    <div class="modal-footer">
        <button type="button" class="site-button" data-bs-dismiss="modal">Cancel</button>
        <button type="submit" class="site-button">Save</button>
    </div>
</form>
<!-- Validation JS  -->
<script src="{{ asset('frontend/assets/js/jquery-validation/jquery.validate.min.js') }}"></script>
<script src="{{ asset('frontend/assets/js/jquery-validation/additional-methods.min.js') }}"></script>
<script src="{{ asset('frontend/assets/js/custom-js/candidate.js') }}"></script>