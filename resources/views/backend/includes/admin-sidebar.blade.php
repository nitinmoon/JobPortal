<aside id="sidebar" class="sidebar">

    <ul class="sidebar-nav" id="sidebar-nav">

        <li class="nav-item">
            <a class="nav-link {{ Request::routeIs('dashboard') ? '' : 'collapsed' }}" href="{{ route('dashboard') }}">
                <i class="bi bi-grid"></i>
                <span>Dashboard</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link {{ (Request::routeIs('jobTypes') || Request::routeIs('jobCategories') || Request::routeIs('designations')) ? '' : 'collapsed' }}" data-bs-target="#components-nav" data-bs-toggle="collapse" href="#">
                <i class="bi bi-unity"></i><span>Master</span><i class="bi bi-chevron-down ms-auto"></i>
            </a>
            <ul id="components-nav" class="nav-content collapse {{ (Request::routeIs('jobTypes') || Request::routeIs('jobCategories') || Request::routeIs('designations')) ? 'show' : '' }}" data-bs-parent="#sidebar-nav">
                <li>
                    <a href="{{ route('jobTypes') }}" class="{{ Request::routeIs('jobTypes') ? 'active' : '' }}">
                        <i class="bi bi-circle"></i><span>Job Type</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('jobCategories') }}" class="{{ Request::routeIs('jobCategories') ? 'active' : '' }}">
                        <i class="bi bi-circle"></i><span>Job Category</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('designations') }}" class="{{ Request::routeIs('designations') ? 'active' : '' }}">
                        <i class="bi bi-circle"></i><span>Designations</span>
                    </a>
                </li>
            </ul>
        </li>
        <li class="nav-item">
            <a class="nav-link {{ (Request::routeIs('candidates') || Request::routeIs('viewCandidate')) ? '' : 'collapsed' }}" href="{{ route('candidates') }}">
                <i class="bi bi-person"></i>
                <span>Candidates</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link {{ (Request::routeIs('employers') || Request::routeIs('addEmployer') || Request::routeIs('editEmployer') || Request::routeIs('viewEmployer')) ? '' : 'collapsed' }}" href="{{ route('employers') }}">
                <i class="bi bi-people"></i>
                <span>Employers</span>
            </a>
        </li>
    </ul>

</aside>