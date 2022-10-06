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
                @canany(['view-category', 'create-category'])
                    <li @class(['sidebar-item', 'has-sub', 'active' => request()->is(['category', 'category/*'])])>
                        <a href="#" class='sidebar-link'>
                            <span>Category</span>
                        </a>
                        <ul @class(['submenu', 'active' => request()->is(['category', 'category/*'])])>
                            @can('view-category')
                                <li @class(['submenu-item', 'active' => request()->is('category')])>
                                    <a href="{{ route('category.index') }}">List</a>
                                </li>
                            @endcan
                            @can('create-category')
                                <li @class(['submenu-item', 'active' => request()->is('category/create')])>
                                    <a href="{{ route('category.create') }}">Add</a>
                                </li>
                            @endcan
                        </ul>
                    </li>
                @endcanany

                <li @class(['sidebar-item', 'has-sub', 'active' => request()->is(['my-equipment', 'department-equipment', 'all-equipment'])])>
                    <a href="#" class='sidebar-link'>
                        <span>Device</span>
                    </a>
                    <ul @class(['submenu', 'active' => request()->is(['my-equipment', 'department-equipment', 'all-equipment'])])>
                        <li @class(['submenu-item', 'active' => request()->is('my-equipment')])>
                            <a href="{{ route('my-equipment.index') }}">My Devices</a>
                        </li>

                        @can('view-department-device')
                            <li @class(['submenu-item', 'active' => request()->is('department-equipment')])>
                                <a href="{{ route('department-equipment.index') }}">Department Devices</a>
                            </li>
                        @endcan

                        @can('view-all-device')
                            <li @class(['submenu-item', 'active' => request()->is('all-equipment')])>
                                <a href="{{ route('all-equipment.index') }}">All Devices</a>
                            </li>
                        @endcan

                        @can('create-device')
                            <li @class(['submenu-item', 'active' => request()->is('equipment/create')])>
                                <a href="{{ route('equipment.create') }}">Add</a>
                            </li>
                        @endcan
                    </ul>
                </li>

                <li @class(['sidebar-item', 'has-sub', 'active' => request()->is('booking/*')])>
                    <a href="#" class='sidebar-link'>
                        <span>Booking</span>
                    </a>
                    <ul @class(['submenu', 'active' => request()->is(['booking/*'])])>
                        <li @class(['submenu-item', 'active' => request()->is('booking/book-device')])>
                            <a href="{{ route('book-device.create') }}">
                                <span>Book Device</span>
                            </a>
                        </li>

                        <li @class(['submenu-item', 'active' => request()->is(['booking/my-booking', 'booking/my-booking/*'])])>
                            <a href="{{ route('my-booking.index') }}">
                                <span>
                                    My Bookings
                                </span>
                            </a>
                        </li>

                        @can('view-department-booking')
                            <li @class(['submenu-item', 'active' => request()->is(['booking/department-booking', 'booking/department-booking/*'])])>
                                <a href="{{ route('department-booking.index') }}">
                                    <span>
                                        Department Bookings
                                    </span>
                                </a>
                            </li>
                        @endcan

                        @can('view-all-booking')
                            <li @class(['submenu-item', 'active' => request()->is(['booking/all-booking','booking/all-booking/*'])])>
                                <a href="{{ route('all-booking.index') }}">
                                    <span>
                                        All Bookings
                                    </span>
                                </a>
                            </li>
                        @endcan
                    </ul>
                </li>

                @canany(['view-department', 'create-department'])
                    <li @class(['sidebar-item', 'has-sub', 'active' => request()->is(['department', 'department/*'])])>
                        <a href="#" class='sidebar-link'>
                            <span>Department</span>
                        </a>
                        <ul @class(['submenu', 'active' => request()->is(['department', 'department/*'])])>
                            @can('view-department')
                                <li @class(['submenu-item', 'active' => request()->is('department')])>
                                    <a href="{{ route('department.index') }}">List</a>
                                </li>
                            @endcan
                            @can('create-department')
                                <li @class(['submenu-item', 'active' => request()->is('department/create')])>
                                    <a href="{{ route('department.create') }}">Add</a>
                                </li>
                            @endcan
                        </ul>
                    </li>
                @endcanany

                @canany(['view-role', 'create-role'])
                    <li @class(['sidebar-item', 'has-sub', 'active' => request()->is(['role', 'role/*'])])>
                        <a href="#" class='sidebar-link'>
                            <span>Role</span>
                        </a>
                        <ul @class(['submenu', 'active' => request()->is(['role', 'role/*'])])>
                            @can('view-role')
                                <li @class(['submenu-item', 'active' => request()->is('department')])>
                                    <a href="{{ route('role.index') }}">List</a>
                                </li>
                            @endcan
                            @can('create-role')
                                <li @class(['submenu-item', 'active' => request()->is('role/create')])>
                                    <a href="{{ route('role.create') }}">Add</a>
                                </li>
                            @endcan
                        </ul>
                    </li>
                @endcanany

                @canany(['view-all-employee', 'view-department-employee', 'create-employee'])
                <li @class(['sidebar-item', 'has-sub', 'active' => request()->is(['employee', 'employee/*'])])>
                    <a href="#" class='sidebar-link'>
                        <span>Employee</span>
                    </a>
                    <ul @class(['submenu', 'active' => request()->is(['employee', 'employee/*'])])>
                        @can('view-department-employee')
                            <li @class(['submenu-item', 'active' => request()->is('department-employee')])>
                                <a href="{{ route('department-employee.index') }}">Department Employee</a>
                            </li>
                        @endcan

                        @can('view-all-employee')
                            <li @class(['submenu-item', 'active' => request()->is('all-employee')])>
                                <a href="{{ route('all-employee.index') }}">All Employee</a>
                            </li>
                        @endcan

                        @can('create-employee')
                            <li @class(['submenu-item', 'active' => request()->is('employee/create')])>
                                <a href="{{ route('employee.create') }}">Add</a>
                            </li>
                        @endcan
                    </ul>
                </li>
                @endcanany

                <li @class(['sidebar-item', 'has-sub', 'active' => request()->is(['my-information', 'change-password'])])>
                    <a href="#" class='sidebar-link'>
                        <span>Account</span>
                    </a>
                    <ul @class(['submenu', 'active' => request()->is(['my-information', 'change-password'])])>
                        <li @class(['submenu-item', 'active' => request()->is('my-information')])>
                            <a href="{{ route('my-information.index') }}">My Information</a>
                        </li>
                        <li @class(['submenu-item', 'active' => request()->is('change-password')])>
                            <a href="{{ route('change-password.index') }}">Change Password</a>
                        </li>
                        <li class="submenu-item">
                            <a href="javascript:void(0)" onclick="document.getElementById('form-logout').submit();">Sign Out</a>
                            <form id="form-logout" action="{{ route('logout') }}" method="POST">
                                @csrf
                            </form>
                        </li>
                    </ul>
                </li>

                @can('authorize')
                    <li @class(['sidebar-item', 'active' => request()->is('authorize')])>
                        <a href="{{ route('authorize.index') }}" class='sidebar-link'>
                            <span>Authorize</span>
                        </a>
                    </li>
                @endcan
            </ul>
        </div>
        <button class="sidebar-toggler btn x"><i data-feather="x"></i></button>
    </div>
</div>