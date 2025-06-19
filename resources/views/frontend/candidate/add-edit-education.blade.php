<div class="modal-header">
    <h5 class="modal-title" id="EmploymentModalLongTitle">{{ isset($educationDetails->id) ? 'Edit' : 'Add' }} Education</h5>
    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>
<form id="educationForm" action="{{ route('addUpdateEducation') }}" method="POST">
    @csrf
    <input type="hidden" id="education_id" name="education_id" value="{{ isset($educationDetails->id) ? $educationDetails->id : '0' }}">
    <div class="modal-body">
        <div class="row">
            <div class="col-lg-12 col-md-12">
                <div class="form-group">
                    <label>Your Education<span class="error">*</span></label>
                    <select class="form-select" data-error="#error_education" name="education" data-placeholder="Select Education">
                        <option value="">Select Education</option>
                        @foreach(educationArray() as $education)
                        <option value="{{ $education }}" {{ isset($educationDetails->education) && $educationDetails->education == $education ? 'selected' : '' }}>{{ $education }}</option>
                        @endforeach
                    </select>
                    <span class="error" id="error_education"></span>
                </div>
            </div>
            <div class="col-lg-12 col-md-12">
                <div class="form-group">
                    <label>College / Institute<span class="error">*</span></label>
                    <input type="text" class="form-control" placeholder="Enter Your College / Institute" name="college" id="college" value="{{ isset($educationDetails->college) ? $educationDetails->college : '' }}">
                    <span class="error" id="error_college"></span>
                </div>
            </div>
            <div class="col-lg-12 col-md-12">
                <div class="form-group">
                    <label>Board / University<span class="error">*</span></label>
                    <input type="text" class="form-control" placeholder="Enter Your Board / University" name="university" id="university" value="{{ isset($educationDetails->university) ? $educationDetails->university : '' }}">
                    <span class="error" id="error_college"></span>
                </div>
            </div>
            <div class="col-lg-12 col-md-12">
                <div class="form-group">
                    <label>Year of Passing<span class="error">*</span></label>
                    <div class="row">
                        <div class="col-lg-6 col-md-6 col-sm-6 col-6">
                            <select class="form-select" name="year_of_passing" id="year_of_passing">
                                <option value="">Select Year</option>
                                @for($i = date('Y'); $i >= 2015; $i--)
                                <option value="{{ $i }}" {{ isset($educationDetails->year_of_passing) && explode('-', $educationDetails->year_of_passing)[0] == $i ? 'selected' : '' }}>{{ $i }}</option>
                                @endfor
                            </select>
                            <span class="error" id="error_year_of_passing"></span>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-6 col-6">
                            <select class="form-select" name="month_of_passing" id="month_of_passing">
                                <option value="">Select Month</option>
                                <option value="1" {{ isset($educationDetails->year_of_passing) && explode('-', $educationDetails->year_of_passing)[1] == '1' ? 'selected' : '' }}>January</option>
                                <option value="2" {{ isset($educationDetails->year_of_passing) && explode('-', $educationDetails->year_of_passing)[1] == '2' ? 'selected' : '' }}>February</option>
                                <option value="3" {{ isset($educationDetails->year_of_passing) && explode('-', $educationDetails->year_of_passing)[1] == '3' ? 'selected' : '' }}>March</option>
                                <option value="4" {{ isset($educationDetails->year_of_passing) && explode('-', $educationDetails->year_of_passing)[1] == '4' ? 'selected' : '' }}>April</option>
                                <option value="5" {{ isset($educationDetails->year_of_passing) && explode('-', $educationDetails->year_of_passing)[1] == '5' ? 'selected' : '' }}>May</option>
                                <option value="6" {{ isset($educationDetails->year_of_passing) && explode('-', $educationDetails->year_of_passing)[1] == '6' ? 'selected' : '' }}>Jun</option>
                                <option value="7" {{ isset($educationDetails->year_of_passing) && explode('-', $educationDetails->year_of_passing)[1] == '7' ? 'selected' : '' }}>July</option>
                                <option value="8" {{ isset($educationDetails->year_of_passing) && explode('-', $educationDetails->year_of_passing)[1] == '8' ? 'selected' : '' }}>August</option>
                                <option value="9" {{ isset($educationDetails->year_of_passing) && explode('-', $educationDetails->year_of_passing)[1] == '9' ? 'selected' : '' }}>September</option>
                                <option value="10" {{ isset($educationDetails->year_of_passing) && explode('-', $educationDetails->year_of_passing)[1] == '10' ? 'selected' : '' }}>October</option>
                                <option value="11" {{ isset($educationDetails->year_of_passing) && explode('-', $educationDetails->year_of_passing)[1] == '11' ? 'selected' : '' }}>November</option>
                                <option value="12" {{ isset($educationDetails->year_of_passing) && explode('-', $educationDetails->year_of_passing)[1] == '12' ? 'selected' : '' }}>December</option>
                            </select>
                            <span class="error" id="error_month_of_passing"></span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-12 col-md-12">
                <div class="form-group">
                    <label>Percentage / CGPA<span class="error">*</span></label>
                    <input type="text" class="form-control" placeholder="Enter Your Percentage / CGPA" name="percentage" id="percentage" value="{{ isset($educationDetails->percentage) ? $educationDetails->percentage : '' }}">
                    <span class="error" id="error_college"></span>
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