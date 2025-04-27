@if(auth()->user()->role_id == App\Models\Constants\UserRoleConstants::SUPER_ADMIN)
@include('backend.includes.admin-sidebar')
@endif
@if(auth()->user()->role_id == App\Models\Constants\UserRoleConstants::EMPLOYER)
@include('backend.includes.employer-sidebar')
@endif