@extends('frontend.employer.index')
@section('prifole-content')
<div class="job-bx-title clearfix">
    <h5 class="font-weight-700 float-start text-uppercase">Change Password</h5>
    <a href="{{ route('companyResume') }}" class="site-button right-arrow button-sm float-end">Back</a>
</div>
<form>
    <div class="row">
        <div class="col-lg-12">
            <div class="form-group">
                <label>Old Password</label>
                <input type="password" class="form-control">
            </div>
        </div>
        <div class="col-lg-6">
            <div class="form-group">
                <label>New Password </label>
                <input type="password" class="form-control">
            </div>
        </div>
        <div class="col-lg-6">
            <div class="form-group">
                <label>Confirm New Password</label>
                <input type="password" class="form-control">
            </div>
        </div>
        <div class="col-lg-12 m-b10">
            <button class="site-button">Update Password</button>
        </div>
    </div>
</form>

@endsection
@section('script')
<script>
    $(function() {

    });
</script>
@endsection