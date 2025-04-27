@extends('frontend.employer.index')
@section('prifole-content')
<div class="job-bx-title clearfix">
    <h5 class="font-weight-700 float-start text-uppercase">My Profile</h5>
    <a href="{{ route('myProfile') }}" class="site-button right-arrow button-sm float-end">Back</a>
</div>
<form>
    <div class="row m-b30">
        <div class="col-lg-3 col-md-3">
            <div class="form-group">
                <label>Title</label>
                <select class="form-control" name="title" data-error="#error_title">
                    <option value="">Select</option>
                    @foreach($title as $row)
                    <option value="{{ $row }}" >{{ getTitle($row) }}</option>
                    @endforeach
                  </select>
                  <span class="error" id="error_title"></span>
            </div>
        </div>
        <div class="col-lg-3 col-md-3">
            <div class="form-group">
                <label>First Name</label>
                <input type="text" class="form-control" name="first_name" id="first_name" value="" placeholder="Enter First Name">
            </div>
        </div>
        <div class="col-lg-3 col-md-3">
            <div class="form-group">
                <label>Middle Name</label>
                <input type="text" class="form-control" name="middle_name" id="middle_name" value="" placeholder="Enter Middle Name">
            </div>
        </div>
        <div class="col-lg-3 col-md-3">
            <div class="form-group">
                <label>Last Name</label>
                <input type="text" class="form-control" name="last_name" id="last_name" value="" placeholder="Enter Last Name">
            </div>
        </div>
        <div class="col-lg-6 col-md-6">
            <div class="form-group">
                <label>Date Of Birth</label>
                <input type="date" class="form-control" name="dob" placeholder="Enter Dob" value="" min="1940-01-01" max="{{ date('Y-m-d', strtotime('-18 year', time())) }}">
            </div>
        </div>
        <div class="col-lg-6 col-md-6">
            <div class="form-group">
                <label>Gender </label>
                <select class="form-control" name="gender" data-error="#error_gender">
                    <option value="">Select</option>
                    @foreach($genders as $gender)
                    <option value="{{ $row }}" >{{ getGender($gender) }}</option>
                    @endforeach
                  </select>
                  <span class="error" id="error_gender"></span>
            </div>
        </div>
    </div>
    <!-- Contact Information -->
    <div class="job-bx-title clearfix">
        <h5 class="font-weight-700 float-start text-uppercase">Contact Information</h5>
    </div>
    <div class="row m-b30">
        <div class="col-lg-6 col-md-6">
            <div class="form-group">
                <label>Email</label>
                <input type="email" class="form-control" name="email" id="email" value="" placeholder="Enter Email">
            </div>
        </div>
        <div class="col-lg-6 col-md-6">
            <div class="form-group">
                <label>Phone</label>
                <input type="text" class="form-control" name="phone" id="phone" value="" placeholder="Enter Phone">
            </div>
        </div>
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
                <label>Address</label>
                <textarea class="form-control" placeholder="New york city" name="address" id=""></textarea>
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