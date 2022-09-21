@php
    use \App\Enumerations\EmployeeRole;
@endphp

<div id="sidebar" class="active">
    <div class="sidebar-wrapper active bg-light">
        <div class="sidebar-header">
            <div class="d-flex justify-content-between">
                <div class="logo">
                    <a href="index.html">
                        Device Management
                    </a>
                </div>
                <div class="toggler">
                    <a href="#" class="sidebar-hide d-xl-none d-block"><i class="bi bi-x bi-middle"></i></a>
                </div>
            </div>
        </div>
        <div class="sidebar-menu">
            <ul class="menu">
                <li @class(['sidebar-item', 'active' => Route::current()->getName() == 'dashboard.index'])>
                    <a href="{{ route('dashboard.index') }}" class="sidebar-link">
                        <span>Dashboard</span>
                    </a>
                </li>

                <li @class(['sidebar-item', 'has-sub', 'active' => request()->is(['category', 'category/*'])])>
                    <a href="#" class='sidebar-link'>
                        <span>Category</span>
                    </a>
                    <ul @class(['submenu', 'active' => request()->is(['category', 'category/*'])])>
                        <li @class(['submenu-item', 'active' => request()->is('category')])>
                            <a href="{{ route('category.index') }}">List</a>
                        </li>
                        <li @class(['submenu-item', 'active' => request()->is('category/create')])>
                            <a href="{{ route('category.create') }}">Add</a>
                        </li>
                    </ul>
                </li>

                <li @class(['sidebar-item', 'has-sub', 'active' => request()->is(['equipment', 'equipment/*'])])>
                    <a href="#" class='sidebar-link'>
                        <span>Equipment</span>
                    </a>
                    <ul @class(['submenu', 'active' => request()->is(['equipment', 'equipment/*'])])>
                        <li @class(['submenu-item', 'active' => request()->is('equipment')])>
                            <a href="{{ route('equipment.index') }}">List</a>
                        </li>
                        <li @class(['submenu-item', 'active' => request()->is('equipment/create')])>
                            <a href="{{ route('equipment.create') }}">Add</a>
                        </li>
                    </ul>
                </li>

                <li @class(['sidebar-item', 'has-sub', 'active' => request()->is(['department', 'department/*'])])>
                    <a href="#" class='sidebar-link'>
                        <span>Department</span>
                    </a>
                    <ul @class(['submenu', 'active' => request()->is(['department', 'department/*'])])>
                        <li @class(['submenu-item', 'active' => request()->is('department')])>
                            <a href="{{ route('department.index') }}">List</a>
                        </li>
                        <li @class(['submenu-item', 'active' => request()->is('department/create')])>
                            <a href="{{ route('department.create') }}">Add</a>
                        </li>
                    </ul>
                </li>

                <li @class(['sidebar-item', 'has-sub', 'active' => request()->is(['employee', 'employee/*'])])>
                    <a href="#" class='sidebar-link'>
                        <span>Employee</span>
                    </a>
                    <ul @class(['submenu', 'active' => request()->is(['employee', 'employee/*'])])>
                        <li @class(['submenu-item', 'active' => request()->is('employee')])>
                            <a href="{{ route('employee.index') }}">List</a>
                        </li>
                        <li @class(['submenu-item', 'active' => request()->is('employee/create')])>
                            <a href="{{ route('employee.create') }}">Add</a>
                        </li>
                    </ul>
                </li>

                @can('book-device')
                    <li @class(['sidebar-item', 'active' => request()->is('booking/create')])>
                        <a href="{{ route('booking.create') }}" class="sidebar-link">
                            <span>Book Device</span>
                        </a>
                    </li>
                @endcan
                
                @canany(['approve-booking-manager', 'approve-booking-director'])
                    <li @class(['sidebar-item', 'active' => request()->is('booking')])>
                        <a href="{{ route('booking.index') }}" class="sidebar-link">
                            <span>List Bookings</span>
                            <span class="badge bg-danger rounded-pill ms-1 text-bg-danger">4</span>
                        </a>
                    </li>
                @endcanany

                @can('authorize')
                    <li @class(['sidebar-item', 'active' => request()->is('authorize')])>
                        <a href="{{ route('authorize.index') }}" class='sidebar-link'>
                            <span>Authorization</span>
                        </a>
                    </li>
                @endcan

                <li class="sidebar-item has-sub">
                    <a href="#" class='sidebar-link'>
                        <span>Account</span>
                    </a>
                    <ul class="submenu">
                        <li class="submenu-item">
                            <a href="error-403.html">Information</a>
                        </li>
                        <li class="submenu-item">
                            <a href="error-403.html">Change Password</a>
                        </li>
                        <li class="submenu-item ">
                            <a href="javascript:void(0)" onclick="document.getElementById('form-logout').submit();">Sign Out</a>
                            <form id="form-logout" action="{{ route('logout') }}" method="POST">
                                @csrf
                            </form>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
        <button class="sidebar-toggler btn x"><i data-feather="x"></i></button>
    </div>
</div>