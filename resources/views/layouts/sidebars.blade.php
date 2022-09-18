<div id="sidebar" class="active">
    <div class="sidebar-wrapper active  bg-light">
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
                    <a href="{{ route('dashboard.index') }}" class='sidebar-link'>
                        <i class="bi bi-grid-fill"></i>
                        <span>Dashboard</span>
                    </a>
                </li>

                <li @class(['sidebar-item', 'has-sub', 'active' => request()->is(['category', 'category/*'])])>
                    <a href="#" class='sidebar-link'>
                        <i class="bi bi-person-badge-fill"></i>
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
                        <i class="bi bi-stack"></i>
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
                        <i class="bi bi-person-badge-fill"></i>
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
                        <i class="bi bi-person-badge-fill"></i>
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

                <li class="sidebar-item has-sub">
                    <a href="#" class='sidebar-link'>
                        <i class="bi bi-x-octagon-fill"></i>
                        <span>Booking</span>
                    </a>
                    <ul class="submenu">
                        <li class="submenu-item">
                            <a href="error-403.html">List</a>
                        </li>
                        <li class="submenu-item ">
                            <a href="error-404.html">Add</a>
                        </li>
                    </ul>
                </li>

                <li class="sidebar-item has-sub">
                    <a href="#" class='sidebar-link'>
                        <i class="bi bi-x-octagon-fill"></i>
                        <span>Account</span>
                    </a>
                    <ul class="submenu">
                        <li class="submenu-item">
                            <a href="error-403.html">Account Information</a>
                        </li>
                        <li class="submenu-item">
                            <a href="error-403.html">Change Password</a>
                        </li>
                        <li class="submenu-item ">
                            <a href="error-404.html">Sign Out</a>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
        <button class="sidebar-toggler btn x"><i data-feather="x"></i></button>
    </div>
</div>