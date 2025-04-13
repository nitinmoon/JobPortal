<aside id="sidebar" class="sidebar">
    <ul class="sidebar-nav" id="sidebar-nav">
        <li class="nav-item">
            <a class="nav-link {{ Request::routeIs('employerDashboard') ? '' : 'collapsed' }}" href="{{ route('employerDashboard') }}">
                <i class="bi bi-grid"></i>
                <span>Dashboard</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link {{ (Request::routeIs('jobs') || Request::routeIs('addJob') || Request::routeIs('editJob') || Request::routeIs('viewdetailJob')) ? '' : 'collapsed' }}" href="{{ route('jobs') }}">
                <i class="bi bi-person"></i>
                <span>Jobs</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link {{ Request::routeIs('applyJobsCandidates') ? '' : 'collapsed' }}" href="{{ route('applyJobsCandidates') }}">
                <i class="bi bi-people"></i>
                <span>Apply Jobs Candidates</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link {{ Request::routeIs('database') ? '' : 'collapsed' }}" href="{{ route('database') }}">
                <i class="bi bi-people"></i>
                <span>Database</span>
            </a>
        </li>
    </ul>
</aside>