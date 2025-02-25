<aside class="main-sidebar bg-green elevation-4">
    <a href="/dashboard" class="brand-link">
        <span class="brand-text font-weight-bold">Livinet BM</span>
    </a>
    <div class="sidebar">
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu">
                <li class="nav-item">
                    <a href="{{ route('dashboard') }}" class="nav-link">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p class="text-white">Dashboard</p>
                    </a>
                </li>
                @if(Auth::user()->role == "admin")
                <li class="nav-item">
                    <a href="/register" class="nav-link">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p class="text-white">Register Building Manager</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="/locations" class="nav-link">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p class="text-white">Locations</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="/getbuildingManagers" class="nav-link">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p class="text-white">Building Manager List</p>
                    </a>
                </li>
                @endif
            </ul>
        </nav>
    </div>
</aside>