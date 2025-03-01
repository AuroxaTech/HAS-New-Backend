<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="#" class="brand-link">
        <img src="{{asset('assets/img/AdminLTELogo.png') }}" alt="AdminLTE Logo"
            class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light">Has Backend</span>
    </a>
    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user (optional) -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class
								with font-awesome or any other icon font library -->
                <li class="nav-item">
                    <a href="{{route('admin.dashboard')}}" class="nav-link">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>Dashboard</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{route('admin.landlord')}}" class="nav-link">
                        <i class="nav-icon  fas fa-building"></i>
                        <p>Landlords</p>
                    </a>
                </li> 
                <li class="nav-item">
                    <a href="{{route('admin.service_provider')}}" class="nav-link">
                        <i class="nav-icon  fas fa-briefcase"></i>
                        <p>Service Providers</p>
                    </a>
                </li> 
                <li class="nav-item">
                    <a href="{{route('admin.tenant')}}" class="nav-link">
                        <i class="nav-icon  fas fa-key"></i>
                        <p>Tenants</p>
                    </a>
                </li> 

                <li class="nav-item">
                    <a href="{{route('admin.visitor')}}" class="nav-link">
                        <i class="nav-icon  fas fa-users"></i>
                        <p>Visitors</p>
                    </a>
                </li> 
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>