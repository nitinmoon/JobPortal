@extends('frontend.employer.index')
@section('prifole-content')
<div class="job-bx-title clearfix">
    <h5 class="font-weight-700 float-start text-uppercase">Company Profile</h5>
    <a href="{{ route('myProfile') }}" class="site-button right-arrow button-sm float-end">Back</a>
</div>
<form>
    <div class="row m-b30">
        <div class="col-lg-6 col-md-6">
            <div class="form-group">
                <label>Company Name</label>
                <input type="text" class="form-control" name="company_name" placeholder="Enter Company Name">
                <span class="error" id="error_company_name"></span>
            </div>
        </div>
        <div class="col-lg-6 col-md-6">
            <div class="form-group">
                <label>Company Website</label>
                <input type="text" class="form-control" name="company_website" placeholder="Enter Company Website">
                <span class="error" id="error_company_website"></span>
            </div>
        </div>
        <div class="col-lg-6 col-md-6">
            <div class="form-group">
                <label>Company Contact Person</label>
                <input type="text" class="form-control" name="company_contact_person" placeholder="Enter Company contact person">
                <span class="error" id="error_company_contact_person"></span>
            </div>
        </div>
        <div class="col-lg-6 col-md-6">
            <div class="form-group">
                <label>Company Contact Email</label>
                <input type="text" class="form-control" name="company_contact_email" placeholder="Enter Company Contact Email">
                <span class="error" id="error_company_contact_email"></span>
            </div>
        </div>
        <div class="col-lg-6 col-md-6">
            <div class="form-group">
                <label>Company Contact Phone</label>
                <input type="text" class="form-control" name="company_contact_no" placeholder="Enter Company Contact Phone">
                <span class="error" id="error_company_contact_no"></span>
            </div>
        </div>
        <div class="col-lg-6 col-md-6">
            <div class="form-group">
                <label>Job Category</label>
                <select class="form-control select2" name="job_category_id" id="job_category_id" data-error="#error_job_category_id">
                    <option value="">Select</option>
                    @foreach($jobCategories as $category)
                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                    @endforeach
                </select>
                <span class="error" id="error_job_category_id"></span>
            </div>
        </div>
        <div class="col-lg-4 col-md-4">
            <div class="form-group">
                <label>Foundation Date</label>
                <input type="date" class="form-control" name="foundation_date" placeholder="Enter Foundation Date" value="" min="1940-01-01" max="">
                <span class="error" id="error_foundation_date"></span>
            </div>
        </div>
        <div class="col-lg-4 col-md-4">
            <div class="form-group">
                <label>No Of Employee</label>
                <input type="text" class="form-control" name="no_of_employees" placeholder="Enter No Of Employee" value="">
                <span class="error" id="error_no_of_employees"></span>
            </div>
        </div>
        <div class="col-lg-4 col-md-4">
            <div class="form-group">
                <label>GST Number</label>
                <input type="text" class="form-control" name="gst_number" placeholder="Enter GST Number" value="">
                <span class="error" id="error_gst_number"></span>
            </div>
        </div>
        <div class="col-lg-12 col-md-12">
            <div class="form-group">
                <label>Company Description</label>
                <textarea class="form-control" name="company_description" placeholder="Company Description"></textarea>
                <span class="error" id="error_company_description"></span>
            </div>
        </div>
    </div>
    <!-- Company Address -->
    <div class="job-bx-title clearfix">
        <h5 class="font-weight-700 float-start text-uppercase">Company Address</h5>
    </div>
    <div class="row m-b30">
        <div class="col-lg-6 col-md-6">
            <div class="form-group">
                <label>Contry</label>
                <select class="form-control select2" name="country_id" id="country_id" data-error="#error_country_id">
                    <option value="">Select</option>
                    @foreach($countries as $row)
                    <option value="{{ $row->id }}" {{ (isset($employerDetails->country_id) && $employerDetails->country_id == $row->id) ? 'selected' : '' }}>{{ $row->name }}</option>
                    @endforeach
                </select>
                <span class="error" id="error_country_id"></span>
            </div>
        </div>
        <div class="col-lg-6 col-md-6">
            <div class="form-group">
                <label>State</label>
                <select class="form-control select2" name="state_id" id="state_id" data-error="#error_state_id">
                    @if(isset($states))
                    @if(count($states) > 0)
                    @foreach ($states as $state)
                    <option value="{{ $state->id }}" {{ isset($employerDetails->state_id) && ($state->id == $employerDetails->state_id) ? 'selected' : '' }}>{{$state->name}}</option>
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
        </div>
        <div class="col-lg-6 col-md-6">
            <div class="form-group">
                <label>City</label>
                <select class="form-control select2" name="city_id" id="city_id" data-error="#error_city_id">
                    @if(isset($cities))
                    @if(count($states) > 0)
                    @foreach ($cities as $city)
                    <option value="{{ $city->id }}" {{ isset($employerDetails->city_id) && ($city->id == $employerDetails->city_id) ? 'selected' : '' }}>{{$city->name}}</option>
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
        </div>
        <div class="col-lg-6 col-md-6">
            <div class="form-group">
                <label>Zip</label>
                <input type="email" class="form-control" placeholder="Enter Zip">
            </div>
        </div>
        <div class="col-lg-12 col-md-12">
            <div class="form-group">
                <label>Company Address</label>
                <textarea class="form-control" placeholder="New york city" name="company_address" id=""></textarea>
            </div>
        </div>
        <div class="col-lg-12">
            <iframe src="https://www.google.com/maps/embed?pb=!1m14!1m12!1m3!1d57784.32772205062!2d75.85546240000001!3d25.151897599999998!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!5e0!3m2!1sen!2sin!4v1545138498580" style="border:0; width: 100%; height:300px;" allowfullscreen></iframe>
        </div>
    </div>
    <button type="submit" class="site-button m-b30">Update</button>
</form>
@endsection
@section('script')
<script>
    $(function() {
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
            })
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
    });
</script>
@endsection