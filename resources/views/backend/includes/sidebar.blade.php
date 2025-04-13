@if(auth()->user()->role_id == App\Models\Constants\UserRoleConstants::USER_ROLE_ADMIN)
@include('backend.includes.admin-sidebar')
@endif
@if(auth()->user()->role_id == App\Models\Constants\UserRoleConstants::USER_ROLE_EMPLOYER)
@include('backend.includes.employer-sidebar')
@endif