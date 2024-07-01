<aside class="sidebar">
    <div class="app-brand demo">
        <a href="{{ route('home') }}" class="app-brand-link">
            <img src="{{ asset('img/logo.svg') }}" alt="Logo" class="w-60 small-logo">
            <img src="{{ asset('img/logo.svg') }}" alt="Logo" class="w-100 full-logo">
        </a>
    </div>

    <ul class="menu-inner py-1">
        <!-- Dashboards -->
        <li class="menu-item {{ (isset($slug) && $slug == 'dashboard') ? 'active' : '' }}">
            <a href="{{ route('home') }}" class="menu-link">
                <i class="menu-icon tf-icons ti ti-smart-home"></i>
                <div data-i18n="Dashboard">Dashboard</div>
            </a>
        </li>
        <!-- Users List -->
        <li class="menu-item {{ (isset($slug) && $slug == 'users-list') ? 'active' : '' }}">
            <a href="{{ route('users.index') }}" class="menu-link">
                <i class="menu-icon tf-icons ti ti-users"></i>
                <div data-i18n="Users">Users</div>
            </a>
        </li>
        <!-- Add other menu items here -->
    </ul>
</aside>
