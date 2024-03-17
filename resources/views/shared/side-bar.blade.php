<aside class="side-bar">
    <header class="head">
        <img src="{{ asset('img/logo.min.svg') }}" alt="Logo">
    </header>
    <div class="body">
        <h6>Dashboard</h6>
        <ul>
            <li class="{{ request()->routeIs('home') ? 'active' : '' }}">
                <a href="{{ route('home') }}">
                    <i class="fas fa-dashboard fa-fw"></i>
                    <span>Home</span>
                </a>
            </li>
            @can('viewAny', \App\Models\Department::class)
            <li class="{{ request()->routeIs('departments.*') ? 'active' : '' }}">
                <a href="{{ route('departments.index') }}">
                    <i class="fas fa-users fa-fw"></i>
                    <span>Departments</span>
                </a>
            </li>
            @endcan
            @can('viewAny', \App\Models\Employee::class)
            <li class="{{ request()->routeIs('employees.*') ? 'active' : '' }}">
                <a href="{{ route('employees.index') }}">
                    <i class="fas fa-users fa-fw"></i>
                    <span>Employees</span>
                </a>
            </li>
            @endcan
            <li class="{{ request()->routeIs('tasks.*') ? 'active' : '' }}">
                <a href="{{ route('tasks.index') }}">
                    <i class="fas fa-users fa-fw"></i>
                    <span>Tasks</span>
                </a>
            </li>
        </ul>
    </div>
</aside>
